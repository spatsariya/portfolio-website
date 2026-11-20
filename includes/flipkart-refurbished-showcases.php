<?php
/** Scoped visual case-study boards for the four Refurbished design solutions. */
if ($idx === 4):
    $blue = $chapter['images'][0];
    $green = $chapter['images'][1];
?>
<div class="fk-design-board fk-design-board--compare" aria-label="Annotated comparison between refurbished and regular search results">
    <div class="fk-board-callouts fk-board-callouts--left">
        <div class="fk-board-callout"><h3>Badge on the image</h3><p>Condition is visible directly on the product thumbnail.</p></div>
        <div class="fk-board-callout"><h3>Clear title</h3><p>The product title explicitly says it is refurbished.</p></div>
    </div>
    <figure class="fk-board-figure fk-visual fk-phone-green">
        <img src="<?php echo $esc($green['url']); ?>" alt="<?php echo $esc($green['caption']); ?>" loading="lazy" decoding="async">
        <figcaption>Category search / refurbished</figcaption>
    </figure>
    <figure class="fk-board-figure fk-visual fk-phone-blue">
        <img src="<?php echo $esc($blue['url']); ?>" alt="<?php echo $esc($blue['caption']); ?>" loading="lazy" decoding="async">
        <figcaption>Regular app search / new</figcaption>
    </figure>
    <div class="fk-board-callouts fk-board-callouts--right">
        <div class="fk-board-callout"><h3>Condition tag</h3><p>Shoppers can distinguish new and refurbished products at a glance.</p></div>
    </div>
</div>
<?php elseif ($idx === 5): ?>
<div class="fk-design-board fk-design-board--education" aria-label="Refurbished product education and details">
    <?php
    $notes = [
        ['Explaining refurbishment', 'A short explanation appears early in the product details journey.'],
        ['Autoplay education', 'A process video explains how a refurbished device is restored and inspected.'],
        ['More about condition', 'The product grade and quality information help users assess what they are buying.']
    ];
    foreach ($chapter['images'] as $n => $im):
    ?>
    <figure class="fk-board-figure fk-visual">
        <div class="fk-edu-image"><img src="<?php echo $esc($im['url']); ?>" alt="<?php echo $esc($im['caption']); ?>" loading="lazy" decoding="async"></div>
        <figcaption><strong><?php echo $esc($notes[$n][0]); ?></strong><span><?php echo $esc($notes[$n][1]); ?></span></figcaption>
    </figure>
    <?php endforeach; ?>
</div>
<?php elseif ($idx === 6): ?>
<div class="fk-design-board fk-design-board--confirm" aria-label="Refurbished cart confirmation and reassurance">
    <div class="fk-board-callout"><h3>Purchase confirmation</h3><p>A bottom sheet explicitly confirms that the customer chose a refurbished device.</p></div>
    <figure class="fk-board-figure fk-visual">
        <img src="<?php echo $esc($chapter['images'][0]['url']); ?>" alt="<?php echo $esc($chapter['images'][0]['caption']); ?>" loading="lazy" decoding="async">
        <figcaption>Cart / confirmation</figcaption>
    </figure>
    <div class="fk-board-callout"><h3>Reasons to believe</h3><p>Quality checks, warranty coverage and clear purchase terms reinforce trust.</p></div>
</div>
<?php elseif ($idx === 7): ?>
<div class="fk-design-board fk-design-board--trust" aria-label="Trust details and refurbishment education">
    <?php foreach ($chapter['images'] as $n => $im): ?>
      <figure class="fk-board-figure fk-visual">
        <img src="<?php echo $esc($im['url']); ?>" alt="<?php echo $esc($im['caption']); ?>" loading="lazy" decoding="async">
        <figcaption><?php echo $n === 0 ? 'Warranty, checks, returns and pricing comparison' : 'Refurbishment process, education and quality standards'; ?></figcaption>
      </figure>
    <?php endforeach; ?>
</div>
<?php endif; ?>
