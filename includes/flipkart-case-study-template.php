<?php
if (!isset($caseStudyKey) || !is_string($caseStudyKey)) {
    http_response_code(404);
    exit('Case study not found.');
}
$caseStudies = require __DIR__ . '/flipkart-case-studies.php';
if (!isset($caseStudies[$caseStudyKey])) {
    http_response_code(404);
    exit('Case study not found.');
}
$study = $caseStudies[$caseStudyKey];
$seoIsHomepage = false;
$seoCanonicalEnabled = true;
$seoTitle = $study['title'] . ' | Product design case study | Shivam Patsariya';
$seoDescription = $study['summary'];
$caseStudyRoute = $caseStudyKey === 'flipkart-video' ? 'flipkart-video' : 'flipkart-' . $caseStudyKey;
$seoCanonical = 'https://imshivam.com/' . $caseStudyRoute;
$pageStylesheet = 'css/flipkart-case-studies.css';
$e = static function ($str) { return htmlspecialchars((string) $str, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); };
include __DIR__ . '/header.php';
?>
<div class="fk-study">
  <div class="fk-shell">
    <nav class="fk-breadcrumb" aria-label="Breadcrumb">
      <a href="/#projects">← Selected work</a><span aria-hidden="true">/</span>
      <a href="/product-design#flipkart-work">Flipkart collection</a><span aria-hidden="true">/</span>
      <span aria-current="page"><?php echo $e($study['title']); ?></span>
    </nav>
  </div>
  <header class="fk-hero">
    <div class="fk-shell fk-hero-grid">
      <div class="fk-hero-copy">
        <span class="fk-kicker">Flipkart ecosystem <span aria-hidden="true">/</span> <?php echo $e($study['eyebrow']); ?></span>
        <h1><?php echo $e($study['headline']); ?></h1>
        <p><?php echo $e($study['summary']); ?></p>
        <div class="fk-hero-actions">
          <a class="fk-button" href="#overview">Explore the story <span aria-hidden="true">↓</span></a>
          <a class="fk-text-link" href="<?php echo $e($study['source']); ?>" target="_blank" rel="noopener noreferrer">Original reference <span aria-hidden="true">↗</span></a>
        </div>
      </div>
      <div class="fk-hero-art" aria-hidden="true">
        <span class="fk-art-index"><?php echo $e(strtoupper($caseStudyKey)); ?></span>
        <div class="fk-art-device">
          <div class="fk-device-top"></div>
          <div class="fk-device-hero"></div>
          <div class="fk-device-line"></div>
          <div class="fk-device-tiles"><i></i><i></i><i></i></div>
          <div class="fk-device-line fk-device-line-short"></div>
          <div class="fk-device-tiles"><i></i><i></i><i></i></div>
        </div>
        <span class="fk-art-note">Product experience / mobile-first</span>
      </div>
    </div>
  </header>
  <div class="fk-shell">
    <div class="fk-stats" aria-label="Reported project outcomes">
      <?php foreach ($study['metrics'] as $metric): ?>
        <div><strong><?php echo $e($metric[0]); ?></strong><span><?php echo $e($metric[1]); ?></span></div>
      <?php endforeach; ?>
    </div>
    <p class="fk-source-note">Figures shown here are reported in a published <a href="<?php echo $e($study['source']); ?>" target="_blank" rel="noopener noreferrer">team case study by Rishi Vaths</a>. They have not been independently verified and should not be interpreted as outcomes attributable to one designer.</p>

    <section class="fk-editorial fk-overview" id="overview" aria-labelledby="fk-overview-title">
      <div class="fk-section-side"><span>01 / Context</span><span class="fk-section-index">The problem</span></div>
      <div class="fk-section-body">
        <p class="fk-kicker">Why this mattered</p>
        <h2 id="fk-overview-title"><?php echo $e($study['title']); ?></h2>
        <p class="fk-lead"><?php echo $e($study['challenge']); ?></p>
        <p><?php echo $e($study['context']); ?></p>
      </div>
    </section>

    <section class="fk-editorial" aria-labelledby="fk-research-title">
      <div class="fk-section-side"><span>02 / Discovery</span><span class="fk-section-index">Evidence first</span></div>
      <div class="fk-section-body">
        <p class="fk-kicker">Research & insights</p>
        <h2 id="fk-research-title">Understanding the real friction.</h2>
        <ol class="fk-insights">
          <?php foreach ($study['discovery'] as $i => $insight): ?>
            <li><span><?php echo $e(sprintf('%02d', $i + 1)); ?></span><p><?php echo $e($insight); ?></p></li>
          <?php endforeach; ?>
        </ol>
      </div>
    </section>

    <section class="fk-design-section" aria-labelledby="fk-design-title">
      <div class="fk-editorial fk-design-intro">
        <div class="fk-section-side"><span>03 / Experience</span><span class="fk-section-index">Design direction</span></div>
        <div class="fk-section-body">
          <p class="fk-kicker">What changed</p>
          <h2 id="fk-design-title">Less friction. More purpose.</h2>
          <p>Four experience decisions from the wider product effort, summarized from the published reference.</p>
        </div>
      </div>
      <div class="fk-solution-grid">
        <?php foreach ($study['approach'] as $i => $step): ?>
          <article class="fk-solution"><span><?php echo $e(sprintf('%02d', $i + 1)); ?> / Design move</span><h3><?php echo $e($step['title']); ?></h3><p><?php echo $e($step['body']); ?></p></article>
        <?php endforeach; ?>
      </div>
    </section>

    <section class="fk-visuals" aria-labelledby="fk-visuals-title">
      <p class="fk-kicker">04 / Visual archive</p>
      <h2 id="fk-visuals-title">A closer look at the experience.</h2>
      <p>Selected original images are referenced from the published third-party case study. Image copyrights remain with their respective owners; these are collaborative product examples, not a claim of sole creation.</p>
      <div class="fk-gallery">
      <?php foreach ($study['gallery'] as $i => $image): ?>
        <figure>
          <div class="fk-image-frame">
            <img src="<?php echo $e($image['url']); ?>" alt="<?php echo $e($image['alt']); ?>" loading="lazy" decoding="async" referrerpolicy="no-referrer" width="1200" height="900">
          </div>
          <figcaption><span><?php echo $e(sprintf('%02d', $i + 1)); ?></span><?php echo $e($image['caption']); ?></figcaption>
        </figure>
      <?php endforeach; ?>
      </div>
    </section>

    <section class="fk-editorial fk-outcome" aria-labelledby="fk-outcome-title">
      <div class="fk-section-side"><span>05 / Outcome</span><span class="fk-section-index">What it taught us</span></div>
      <div class="fk-section-body">
        <p class="fk-kicker">Published outcomes</p>
        <h2 id="fk-outcome-title">Impact beyond the screens.</h2>
        <p class="fk-lead"><?php echo $e($study['outcome']); ?></p>
        <blockquote><?php echo $e($study['lesson']); ?></blockquote>
      </div>
    </section>
    <aside class="fk-attribution">
      <div><strong>About this case study</strong><p>This is an independently rewritten portfolio overview of a collaborative Flipkart product initiative. The linked reference was authored by Rishi Vaths and includes his own first-person process and contributions. Individual design responsibilities should be credited to the appropriate team members.</p></div>
      <a href="<?php echo $e($study['source']); ?>" target="_blank" rel="noopener noreferrer">Read the original case study <span aria-hidden="true">↗</span></a>
    </aside>
    <div class="fk-next">
      <span class="fk-kicker">More from the Flipkart ecosystem</span>
      <div class="fk-next-grid">
        <?php foreach ($caseStudies as $key => $other): if ($key === $caseStudyKey) continue; ?>
          <a href="/<?php echo $e($key === 'flipkart-video' ? 'flipkart-video' : 'flipkart-' . $key); ?>"><small><?php echo $e($other['eyebrow']); ?></small><strong><?php echo $e($other['title']); ?></strong><span aria-hidden="true">↗</span></a>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>
<?php include __DIR__ . '/footer.php'; ?>
