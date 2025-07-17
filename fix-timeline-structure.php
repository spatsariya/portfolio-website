<?php
/**
 * Script to add timeline-expandable structure to all experience and education entries
 */

// Read the index.php file
$content = file_get_contents('index.php');

// Fix Virgin Plus entry
$content = preg_replace(
    '/(<h4>Virgin Plus \(Bell Canada\)<\/h4>\s*<p>.*?<\/p>)\s*(<ul class="timeline-list">.*?<\/ul>)/s',
    '$1
                    <div class="timeline-expandable">
                        $2
                        <button class="timeline-toggle" data-aos="fade-up" data-aos-delay="300">
                            <span class="toggle-text">View more</span>
                            <img src="icons/chevron-down.svg" alt="Expand" class="toggle-icon">
                        </button>
                    </div>',
    $content
);

// Fix Media.net entry
$content = preg_replace(
    '/(<h4>Media\.net<\/h4>\s*<p>.*?<\/p>)\s*(<ul class="timeline-list">.*?<\/ul>)/s',
    '$1
                    <div class="timeline-expandable">
                        $2
                        <button class="timeline-toggle" data-aos="fade-up" data-aos-delay="300">
                            <span class="toggle-text">View more</span>
                            <img src="icons/chevron-down.svg" alt="Expand" class="toggle-icon">
                        </button>
                    </div>',
    $content
);

// Fix Accenture entry
$content = preg_replace(
    '/(<h4>Accenture, ATCi<\/h4>\s*<p>.*?<\/p>)\s*(<ul class="timeline-list">.*?<\/ul>)/s',
    '$1
                    <div class="timeline-expandable">
                        $2
                        <button class="timeline-toggle" data-aos="fade-up" data-aos-delay="300">
                            <span class="toggle-text">View more</span>
                            <img src="icons/chevron-down.svg" alt="Expand" class="toggle-icon">
                        </button>
                    </div>',
    $content
);

// Fix NIMS University entry
$content = preg_replace(
    '/(<h4>NIMS University, Jaipur<\/h4>\s*<p>.*?<\/p>)\s*(<ul class="timeline-list">.*?<\/ul>)/s',
    '$1
                    <div class="timeline-expandable">
                        $2
                        <button class="timeline-toggle" data-aos="fade-up" data-aos-delay="300">
                            <span class="toggle-text">View more</span>
                            <img src="icons/chevron-down.svg" alt="Expand" class="toggle-icon">
                        </button>
                    </div>',
    $content
);

// Fix Flipkart entry
$content = preg_replace(
    '/(<h4>Flipkart<\/h4>\s*<p>.*?<\/p>)\s*(<ul class="timeline-list">.*?<\/ul>)/s',
    '$1
                    <div class="timeline-expandable">
                        $2
                        <button class="timeline-toggle" data-aos="fade-up" data-aos-delay="300">
                            <span class="toggle-text">View more</span>
                            <img src="icons/chevron-down.svg" alt="Expand" class="toggle-icon">
                        </button>
                    </div>',
    $content
);

// Fix NextGen Invent entry
$content = preg_replace(
    '/(<h4>NextGen Invent Corporation<\/h4>\s*<p>.*?<\/p>)\s*(<ul class="timeline-list">.*?<\/ul>)/s',
    '$1
                    <div class="timeline-expandable">
                        $2
                        <button class="timeline-toggle" data-aos="fade-up" data-aos-delay="300">
                            <span class="toggle-text">View more</span>
                            <img src="icons/chevron-down.svg" alt="Expand" class="toggle-icon">
                        </button>
                    </div>',
    $content
);

// Fix education entries - Fleming College
$content = preg_replace(
    '/(<h3>Fleming College.*?<\/h3>\s*<p>.*?<\/p>)\s*(<ul class="timeline-list">.*?<\/ul>)/s',
    '$1
                    <div class="timeline-expandable">
                        $2
                        <button class="timeline-toggle" data-aos="fade-up" data-aos-delay="300">
                            <span class="toggle-text">View more</span>
                            <img src="icons/chevron-down.svg" alt="Expand" class="toggle-icon">
                        </button>
                    </div>',
    $content
);

// Fix education entries - Jiwaji University
$content = preg_replace(
    '/(<h3>Jiwaji University.*?<\/h3>\s*<p>.*?<\/p>)\s*(<ul class="timeline-list">.*?<\/ul>)/s',
    '$1
                    <div class="timeline-expandable">
                        $2
                        <button class="timeline-toggle" data-aos="fade-up" data-aos-delay="300">
                            <span class="toggle-text">View more</span>
                            <img src="icons/chevron-down.svg" alt="Expand" class="toggle-icon">
                        </button>
                    </div>',
    $content
);

// Write back to file
file_put_contents('index.php', $content);
echo "Timeline structure updated successfully!\n";
echo "Added expandable structure to all missing timeline entries.\n";
?>
