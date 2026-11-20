const { chromium } = require(process.env.PLAYWRIGHT_PATH || 'playwright');
const fs = require('fs');
const path = require('path');

(async () => {
  const browser = await chromium.launch({ headless: true, channel: 'chrome', args: ['--no-sandbox'] });
  fs.mkdirSync('qa-screenshots', { recursive: true });
  const projects = {
    '2gud': '#section-6',
    'supercoin': '#section-7',
    'refurbished': '#section-5',
    'video': '#section-5'
  };
  let failures = [];

  for (const [slug, keySection] of Object.entries(projects)) {
    for (const [viewportName, viewport] of [
      ['desktop', { width: 1440, height: 900 }],
      ['mobile', { width: 390, height: 844 }]
    ]) {
      const page = await browser.newPage({ viewport, deviceScaleFactor: 1 });
      try {
        await page.goto('http://127.0.0.1:8133/flipkart-' + slug + '.php', {
          waitUntil: 'domcontentloaded', timeout: 25000
        });
        await page.locator('.fk-case h1').waitFor();
        const count = await page.locator('.fk-section').count();
        if (count < 7) throw new Error('Only ' + count + ' sections rendered');

        const hero = page.locator('.fk-project-image img');
        await hero.evaluate(async img => {
          if (img.complete) return;
          await Promise.race([
            img.decode().catch(() => {}),
            new Promise(resolve => setTimeout(resolve, 15000))
          ]);
        });
        const heroLoaded = await hero.evaluate(img => img.complete && img.naturalWidth > 0);
        if (!heroLoaded) throw new Error('Cover image did not load');

        const width = await page.evaluate(() => ({
          viewport: window.innerWidth,
          actual: document.documentElement.scrollWidth
        }));
        if (width.actual > width.viewport + 2) {
          throw new Error('Horizontal overflow ' + width.actual + ' > ' + width.viewport);
        }

        await page.screenshot({
          path: path.join('qa-screenshots', slug + '-' + viewportName + '-hero.png'),
          fullPage: false
        });

        const section = page.locator(keySection);
        await section.scrollIntoViewIfNeeded();
        const images = section.locator('.fk-visual img');
        await images.first().scrollIntoViewIfNeeded();
        // Lazy images not yet scrolled into view can appear as empty panels in captures.
        // Promote only this one representative gallery to eager and wait for every image.
        await section.evaluate(async el => {
          const imgs = Array.from(el.querySelectorAll('.fk-visual img'));
          await Promise.all(imgs.map(async img => {
            img.loading = 'eager';
            await Promise.race([
              img.decode().catch(() => {}),
              new Promise(resolve => setTimeout(resolve, 20000))
            ]);
          }));
        });
        const failedImages = await images.evaluateAll(imgs =>
          imgs.filter(img => !img.complete || img.naturalWidth === 0)
              .map(img => img.currentSrc || img.src)
        );
        if (failedImages.length) {
          throw new Error('Source images did not load in ' + keySection + ': ' + failedImages.join(', '));
        }

        await page.screenshot({
          path: path.join('qa-screenshots', slug + '-' + viewportName + '-visual.png'),
          fullPage: false
        });
        console.log('PASS', slug, viewportName, count + ' chapters', 'no overflow', 'images load');
      } catch (err) {
        failures.push(slug + '/' + viewportName + ': ' + err.message);
        console.error('FAIL', slug, viewportName, err);
      } finally {
        await page.close();
      }
    }
  }

  await browser.close();
  if (failures.length) {
    console.error(failures.join('\n'));
    process.exit(1);
  }
})().catch(err => { console.error(err); process.exit(1); });
