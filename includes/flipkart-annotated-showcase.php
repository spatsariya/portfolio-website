<?php
/**
 * Render a screenshot with independent, accessible annotations.
 * Expected scope: $chapter, $idx, $screenConfig, $esc.
 */
$mode = $screenConfig['mode'] ?? 'gallery';
if ($mode === 'annotated'):
    $primaryIndex = (int) ($screenConfig['screen'] ?? 0);
    if (!isset($chapter['images'][$primaryIndex])) {
        return;
    }
    $primary = $chapter['images'][$primaryIndex];
?>
<div class="fk-annotation-board" aria-label="Annotated product interface">
  <div class="fk-annotation-column fk-annotation-column--left">
    <?php foreach ($screenConfig['left'] ?? [] as $callout): ?>
      <div class="fk-annotation" style="--note-top:<?php echo max(0, min(90, (int) ($callout['top'] ?? 20))); ?>%">
        <h3><?php echo $esc($callout['title']); ?></h3>
        <p><?php echo $esc($callout['description']); ?></p>
      </div>
    <?php endforeach; ?>
  </div>
  <figure class="fk-annotation-screen">
    <img src="<?php echo $esc($primary['url']); ?>" alt="<?php echo $esc($primary['caption']); ?>" loading="lazy" decoding="async">
    <figcaption><?php echo $esc($primary['caption']); ?></figcaption>
  </figure>
  <div class="fk-annotation-column fk-annotation-column--right">
    <?php foreach ($screenConfig['right'] ?? [] as $callout): ?>
      <div class="fk-annotation" style="--note-top:<?php echo max(0, min(90, (int) ($callout['top'] ?? 20))); ?>%">
        <h3><?php echo $esc($callout['title']); ?></h3>
        <p><?php echo $esc($callout['description']); ?></p>
      </div>
    <?php endforeach; ?>
  </div>
</div>
<?php
    $extraImages = array_values(array_filter($chapter['images'], static function ($imageIndex) use ($primaryIndex) {
        return $imageIndex !== $primaryIndex;
    }, ARRAY_FILTER_USE_KEY));
    if ($extraImages):
?>
  <div class="fk-gallery-heading">
    <h3><?php echo $esc($screenConfig['extrasTitle'] ?? 'Additional design states'); ?></h3>
    <?php if (!empty($screenConfig['extrasIntro'])): ?>
      <p><?php echo $esc($screenConfig['extrasIntro']); ?></p>
    <?php endif; ?>
  </div>
  <div class="fk-curated-gallery fk-curated-gallery--<?php echo min(4,count($extraImages)); ?>">
    <?php foreach ($extraImages as $image): ?>
      <figure class="fk-curated-visual">
        <img src="<?php echo $esc($image['url']); ?>" alt="<?php echo $esc($image['caption']); ?>" loading="lazy" decoding="async">
        <figcaption><?php echo $esc($image['caption']); ?></figcaption>
      </figure>
    <?php endforeach; ?>
  </div>
<?php
    endif;
elseif ($mode === 'gallery'):
?>
  <div class="fk-gallery-heading">
    <h3><?php echo $esc($screenConfig['title'] ?? 'Experience details'); ?></h3>
    <?php if (!empty($screenConfig['intro'])): ?>
      <p><?php echo $esc($screenConfig['intro']); ?></p>
    <?php endif; ?>
  </div>
  <div class="fk-curated-gallery fk-curated-gallery--<?php echo min(4,count($chapter['images'])); ?>">
    <?php foreach ($chapter['images'] as $imageIndex => $image): ?>
    <?php $label = $screenConfig['labels'][$imageIndex] ?? ['title'=>$image['caption'], 'description'=>'']; ?>
      <figure class="fk-curated-visual">
        <img src="<?php echo $esc($image['url']); ?>" alt="<?php echo $esc($image['caption']); ?>" loading="lazy" decoding="async">
        <figcaption>
          <strong><?php echo $esc($label['title']); ?></strong>
          <?php if (!empty($label['description'])): ?><span><?php echo $esc($label['description']); ?></span><?php endif; ?>
        </figcaption>
      </figure>
    <?php endforeach; ?>
  </div>
<?php endif; ?>
