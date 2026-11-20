<?php
/**
 * Detailed Flipkart project case studies.
 * Original narrative summaries of collaborative projects, illustrated with project imagery.
 */
if (!isset($caseStudyKey) || !is_string($caseStudyKey)) {
    http_response_code(404);
    exit('Case study not found.');
}
$caseStudies = require __DIR__ . '/flipkart-case-studies.php';
$detailedStudies = require __DIR__ . '/flipkart-deep-dive.php';
if (!isset($caseStudies[$caseStudyKey], $detailedStudies[$caseStudyKey])) {
    http_response_code(404);
    exit('Case study not found.');
}
$study = $caseStudies[$caseStudyKey];
$details = $detailedStudies[$caseStudyKey];
$seoIsHomepage = false;
$seoCanonicalEnabled = true;
$seoTitle = $study['title'] . ' | Product Design Case Study | Shivam Patsariya';
$seoDescription = $details['overview'];
$caseStudyRoute = $caseStudyKey === 'flipkart-video' ? 'flipkart-video' : 'flipkart-' . $caseStudyKey;
$seoCanonical = 'https://imshivam.com/' . $caseStudyRoute;
$pageStylesheet = 'css/flipkart-case-studies.css';
$e = static function ($value) {
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
};
$routes = [
    '2gud' => '/flipkart-2gud',
    'supercoin' => '/flipkart-supercoin',
    'refurbished' => '/flipkart-refurbished',
    'flipkart-video' => '/flipkart-video',
];
include __DIR__ . '/header.php';
?>
<div class="fk-longform">
    <div class="fk-wrap">
        <nav class="fk-crumbs" aria-label="Breadcrumb">
            <a href="/#projects">← Selected work</a>
            <span aria-hidden="true">/</span>
            <a href="/product-design#flipkart-work">Flipkart collection</a>
            <span aria-hidden="true">/</span>
            <span aria-current="page"><?php echo $e($study['title']); ?></span>
        </nav>
    </div>

    <header class="fk-story-hero">
        <div class="fk-wrap fk-story-head">
            <div class="fk-story-intro">
                <p class="fk-overline">Flipkart ecosystem <span aria-hidden="true">/</span> Product design case study</p>
                <h1><?php echo $e($details['focus']); ?></h1>
                <p class="fk-opening"><?php echo $e($details['overview']); ?></p>
                <a class="fk-scroll-link" href="#the-story">Explore the project <span aria-hidden="true">↓</span></a>
            </div>
            <div class="fk-story-facts" aria-label="Project at a glance">
                <div><span>Project</span><strong><?php echo $e($study['title']); ?></strong></div>
                <div><span>Experience</span><strong><?php echo $e($study['eyebrow']); ?></strong></div>
                <div><span>What this covers</span><strong>Problem · Research · Strategy · Interface · Outcomes</strong></div>
            </div>
        </div>
    </header>

    <div class="fk-wrap">
        <div class="fk-metrics" aria-label="Published project results">
            <?php foreach ($study['metrics'] as $metric): ?>
                <div><strong><?php echo $e($metric[0]); ?></strong><span><?php echo $e($metric[1]); ?></span></div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="fk-story-content" id="the-story">
        <?php foreach ($details['chapters'] as $chapterNumber => $chapter): ?>
        <section class="fk-chapter <?php echo !empty($chapter['images']) ? 'fk-chapter--with-images' : ''; ?>" id="chapter-<?php echo $e($chapterNumber + 1); ?>" aria-labelledby="fk-chapter-title-<?php echo $e($chapterNumber + 1); ?>">
            <div class="fk-wrap">
                <div class="fk-chapter-heading">
                    <p class="fk-chapter-label"><?php echo $e($chapter['kicker']); ?></p>
                    <div class="fk-chapter-lead">
                        <h2 id="fk-chapter-title-<?php echo $e($chapterNumber + 1); ?>"><?php echo $e($chapter['title']); ?></h2>
                        <?php foreach ($chapter['paragraphs'] as $paragraph): ?>
                            <p><?php echo $e($paragraph); ?></p>
                        <?php endforeach; ?>
                    </div>
                </div>

                <?php if (!empty($chapter['images'])): ?>
                <div class="fk-screens">
                    <?php foreach ($chapter['images'] as $image): ?>
                        <figure class="fk-screenshot">
                            <img src="<?php echo $e($image['url']); ?>" alt="<?php echo $e($image['caption']); ?>" loading="lazy" decoding="async" referrerpolicy="no-referrer">
                            <figcaption><?php echo $e($image['caption']); ?></figcaption>
                        </figure>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <?php if (!empty($chapter['points'])): ?>
                    <ul class="fk-notes" aria-label="Experience details">
                        <?php foreach ($chapter['points'] as $pointIndex => $point): ?>
                        <li><span><?php echo $e(sprintf('%02d', $pointIndex + 1)); ?></span><p><?php echo $e($point); ?></p></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

                <?php if (!empty($chapter['quote'])): ?>
                    <blockquote class="fk-pullquote"><?php echo $e($chapter['quote']); ?></blockquote>
                <?php endif; ?>
            </div>
        </section>
        <?php endforeach; ?>
    </div>

    <div class="fk-wrap">
        <p class="fk-metric-context">Project metrics describe published team-level outcomes and are not presented as the impact of a single contributor. Case studies describe collaborative initiatives.</p>
        <section class="fk-other-work" aria-labelledby="fk-other-work-heading">
            <div class="fk-other-heading">
                <p class="fk-overline">Selected product work</p>
                <h2 id="fk-other-work-heading">Explore more from Flipkart.</h2>
            </div>
            <div class="fk-other-grid">
                <?php foreach ($caseStudies as $slug => $other): if ($slug === $caseStudyKey) continue; ?>
                <a href="<?php echo $e($routes[$slug]); ?>">
                    <span><?php echo $e($other['eyebrow']); ?></span>
                    <strong><?php echo $e($other['title']); ?></strong>
                    <span class="fk-link-icon" aria-hidden="true">↗</span>
                </a>
                <?php endforeach; ?>
            </div>
            <a class="fk-back-link" href="/product-design#flipkart-work">← View all product design projects</a>
        </section>
    </div>
</div>
<?php include __DIR__ . '/footer.php'; ?>
