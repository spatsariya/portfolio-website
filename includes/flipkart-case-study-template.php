<?php
/**
 * Detailed Flipkart case studies using real, source-matched visual assets.
 * Summaries are newly written; outcomes are collaborative/project-level.
 */
$caseStudies = require __DIR__ . '/flipkart-case-studies.php';
$deepDives = require __DIR__ . '/flipkart-deep-dive.php';
if (!isset($caseStudyKey, $caseStudies[$caseStudyKey], $deepDives[$caseStudyKey])) {
    http_response_code(404);
    exit('Case study not found.');
}
$study = $caseStudies[$caseStudyKey];
$details = $deepDives[$caseStudyKey];
$routes = [
    '2gud' => '/flipkart-2gud',
    'supercoin' => '/flipkart-supercoin',
    'refurbished' => '/flipkart-refurbished',
    'flipkart-video' => '/flipkart-video',
];
$esc = static function ($value) {
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
};
$seoIsHomepage = false;
$seoCanonicalEnabled = true;
$seoTitle = $study['title'] . ' | Flipkart Product Design Case Study | Shivam Patsariya';
$seoDescription = $details['overview'];
$seoCanonical = 'https://imshivam.com' . $routes[$caseStudyKey];
$pageStylesheet = 'css/flipkart-case-studies.css';
include __DIR__ . '/header.php';
?>
<div class="fk-case fk-case--<?php echo $esc($caseStudyKey); ?>">
  <div class="fk-container">
    <nav class="fk-breadcrumbs" aria-label="Breadcrumb">
      <a href="/#projects">Projects</a>
      <span aria-hidden="true">/</span>
      <a href="/product-design#flipkart-work">Flipkart</a>
      <span aria-hidden="true">/</span>
      <span aria-current="page"><?php echo $esc($study['title']); ?></span>
    </nav>
  </div>
  <header class="fk-opening">
    <div class="fk-container">
      <span class="fk-eyebrow">Product design · <?php echo $esc($study['title']); ?></span>
      <h1><?php echo $esc($details['focus']); ?></h1>
      <div class="fk-info-row">
        <div class="fk-info"><span>Project</span><strong><?php echo $esc($study['title']); ?></strong></div>
        <div class="fk-info"><span>Project period</span><strong><?php echo $esc($details['period']); ?></strong></div>
        <div class="fk-info"><span>Focus</span><strong><?php echo $esc($study['eyebrow']); ?></strong></div>
      </div>
      <div class="fk-project-image">
        <img src="<?php echo $esc($details['heroImage']); ?>" alt="<?php echo $esc($study['title']); ?> project cover" fetchpriority="high" decoding="async">
      </div>
      <div class="fk-overview">
        <h2>Project overview</h2>
        <p><?php echo $esc($details['overview']); ?></p>
      </div>
      <?php if (!empty($study['metrics'])): ?>
      <div class="fk-highlights" aria-label="Reported project outcomes">
      <?php foreach ($study['metrics'] as $metric): ?>
        <div><strong><?php echo $esc($metric[0]); ?></strong><span><?php echo $esc($metric[1]); ?></span></div>
      <?php endforeach; ?>
      </div>
      <?php endif; ?>
    </div>
  </header>

  <div class="fk-narrative" id="case-study-content">
  <?php foreach ($details['chapters'] as $idx => $chapter): ?>
    <section class="fk-section" id="section-<?php echo $idx + 1; ?>" aria-labelledby="fk-heading-<?php echo $idx + 1; ?>">
      <div class="fk-container">
        <span class="fk-section-label"><?php echo $esc($chapter['kicker']); ?></span>
        <h2 id="fk-heading-<?php echo $idx + 1; ?>"><?php echo $esc($chapter['title']); ?></h2>
        <div class="fk-prose">
        <?php foreach ($chapter['paragraphs'] as $paragraph): ?>
          <p><?php echo $esc($paragraph); ?></p>
        <?php endforeach; ?>
        </div>

        <?php if (!empty($chapter['points'])): ?>
          <ul class="fk-points" aria-label="Key findings">
            <?php foreach ($chapter['points'] as $point): ?>
              <li><?php echo $esc($point); ?></li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>

        <?php if (!empty($chapter['images'])): ?>
          <div class="fk-visual-set fk-visual-set--<?php echo $esc($chapter['imageLayout'] ?? 'wide'); ?>">
            <?php foreach ($chapter['images'] as $im): ?>
              <figure class="fk-visual">
                <div class="fk-visual-inner">
                  <img src="<?php echo $esc($im['url']); ?>" alt="<?php echo $esc($im['caption']); ?>" loading="lazy" decoding="async">
                </div>
                <figcaption><?php echo $esc($im['caption']); ?></figcaption>
              </figure>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>

        <?php if (!empty($chapter['quote'])): ?>
          <blockquote class="fk-key-learning"><?php echo $esc($chapter['quote']); ?></blockquote>
        <?php endif; ?>
      </div>
    </section>
  <?php endforeach; ?>
  </div>

  <div class="fk-container">
    <p class="fk-outcome-note">Numbers shown above are reported results for collaborative product initiatives.</p>
    <aside class="fk-more-projects">
      <span class="fk-eyebrow">Explore more work</span>
      <h2>Other Flipkart projects.</h2>
      <div class="fk-other-list">
        <?php foreach ($caseStudies as $slug => $other): ?>
          <?php if ($slug === $caseStudyKey) continue; ?>
          <a href="<?php echo $esc($routes[$slug]); ?>">
            <span><?php echo $esc($other['eyebrow']); ?></span>
            <strong><?php echo $esc($other['title']); ?></strong>
            <span class="fk-arrow" aria-hidden="true">↗</span>
          </a>
        <?php endforeach; ?>
      </div>
      <a class="fk-back" href="/#projects">← Back to projects</a>
    </aside>
  </div>
</div>
<?php include __DIR__ . '/footer.php'; ?>
