<?php
/**
 * Returns the HTML for Grouped Campaigns.
 *
 * Available Variables
 * - $nid: Node ID for grouped campaigns page (integer).
 * - $title: Title of grouped campaigns page (string).
 * - $subtitle: Subtitle of grouped campaigns page (string).
 * - $signup_button: Render array for outputting Signup form button (array).
 * - $call_to_action: Call To Action of grouped campaigns page (string).
 * - $scholarship: Scholarship amount (string).
 * - $partners: Array of partners for grouped campaigns (array).
 * - $partner_info: Array of information regarding partners for grouped campaigns (array).
 */

// krumo($variables);
?>

<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

  <header role="banner" class="-hero">
    <div class="wrapper">
      <h1 class="__title"><?php print $title; ?></h1>
      <?php if (isset($signup_button)): ?>
        <h2 class="__subtitle"><?php print $call_to_action; ?></h2>
        <?php print render($signup_button); ?>
      <?php endif; ?>

      <?php if (isset($scholarship)): ?>
        <div class="scholarship-callout -action -below">
          <p class="copy"><?php print $scholarship; ?></p>
        </div>
      <?php endif; ?>
    </div>
  </header>


  <?php if (isset($intro)): ?>
    <section class="container intro">
      <div class="wrapper">
        <?php if (isset($intro_title)): ?>
          <h2 class="__title"><?php print $intro_title; ?></h2>
        <?php endif; ?>

        <div class="__content<?php if (isset($intro_image) || isset($intro_video)): print " -columned"; endif; ?>">
          <?php print $intro; ?>

          <?php if (isset($modals)): ?>
            <?php print $modals; ?>
          <?php endif; ?>
        </div>

        <?php if (isset($intro_image) || isset($intro_video)): ?>
        <aside class="-columned">
          <?php if (isset($intro_video)): ?>
            <div class="video">
              <?php print $intro_video; ?>
            </div>
          <?php elseif (isset($intro_image)): ?>
            <?php print $intro_image; ?>
          <?php endif; ?>
        </aside>
        <?php endif; ?>
      </div>
    </section>
  <?php endif; ?>

  <section>
    <?php if (isset($pre_launch_copy)): ?>
    <div class="pre-launch-wrapper">
      <div class="pre-launch">
        <?php if (isset($pre_launch_title)): ?>
          <h2><?php print $pre_launch_title; ?></h2>
        <?php endif; ?>
        <p><?php print $pre_launch_copy; ?></p>
      </div>
    </div>
    <?php endif; ?>

    <?php if (isset($post_signup_copy)): ?>
    <div class="post-signup-wrapper">
      <div class="post-signup">
        <?php if (isset($post_signup_title)): ?>
          <h2><?php print $post_signup_title; ?></h2>
        <?php endif; ?>
        <p><?php print $post_signup_copy; ?></p>
      </div>
    </div>
    <?php endif; ?>
  </section>


    <?php if (isset($additional_text)): ?>
    <div class="additional-text-wrapper">
      <div class="additional-text">
        <?php if (isset($additional_text_title)): ?>
          <h2><?php print $additional_text_title; ?></h2>
        <?php endif; ?>
        <p><?php print $additional_text; ?></p>
        <?php if (isset($additional_text_image)): ?>
          <?php print $additional_text_image; ?>
        <?php endif; ?>

  <?php if (isset($post_signup_title) || isset($post_signup_body)): ?>
    <section class="container">
      <div class="wrapper">
        <?php if (isset($post_signup_title)): ?>
        <h2 class="__title"><?php print $post_signup_title; ?></h2>
        <?php endif; ?>

        <?php if (isset($post_signup_body)): ?>
          <div class="__content">
            <?php print $post_signup_body; ?>
          </div>
        <?php endif; ?>
      </div>
    </section>
  <?php endif; ?>


  <?php if (isset($additional_text) && isset($campaigns['published'])): ?>
    <section class="container additional-text">
      <div class="wrapper">
        <?php if (isset($additional_text_title)): ?>
          <h2><?php print $additional_text_title; ?></h2>
        <?php endif; ?>
        <div class="__content">
          <?php print $additional_text; ?>
        </div>
      </div>
    </section>
  <?php endif; ?>


  <?php if (!empty($campaigns)): ?>
    <?php // @TODO: Need to add a new class for this section. ?>
    <section class="container">
      <ul class="gallery">

        <?php if (isset($campaigns['published'])): ?>
          <?php foreach ($campaigns['published'] as $published_campaign): ?>
            <li class="campaign -published">
              <?php if (isset($published_campaign['image'])): ?>
                <?php print $published_campaign['image']; ?>
              <?php endif; ?>
              <?php if (isset($published_campaign['title'])): ?>
                  <h3 class="title"><?php print $published_campaign['title']; ?></h3>
              <?php endif; ?>
              <?php if (isset($published_campaign['call_to_action'])): ?>
                <div class="campaign-call-to-action"><?php print $published_campaign['call_to_action']; ?></div>
              <?php endif; ?>
            </li>
          <?php endforeach; ?>
        <?php endif; ?>

        <?php if (isset($campaigns['unpublished'])): ?>
          <?php foreach ($campaigns['unpublished'] as $unpublished_campaign): ?>
            <li class="campaign -unpublished">
              <?php if (isset($unpublished_campaign['image'])): ?>
                <?php print $unpublished_campaign['image']; ?>
              <?php endif; ?>
              <?php if (isset($unpublished_campaign['title'])): ?>
                  <h3 class="title"><?php print $unpublished_campaign['title']; ?></h3>
              <?php endif; ?>
              <?php if (isset($unpublished_campaign['call_to_action'])): ?>
                <div class="campaign-call-to-action"><?php print $unpublished_campaign['call_to_action']; ?></div>
              <?php endif; ?>
            </li>
          <?php endforeach; ?>
        <?php endif; ?>

      </ul>
    </section>
  <?php endif; ?>


  <?php if (!empty($galleries)): ?>
    <?php // @TODO: Need to add a new class for this section. ?>
    <section class="container">
      <div class="wrapper">

        <?php foreach ($galleries as $gallery): ?>
          <?php if (isset($gallery['title'])): ?>
            <h2 class="__title"><?php print $gallery['title']; ?></h2>
          <?php endif; ?>
          <ul class="gallery">
            <?php foreach ($gallery['items'] as $gallery_item): ?>
              <li class="">
                <?php if (isset($gallery_item['image'])): ?>
                  <?php print $gallery_item['image']; ?>
                <?php endif; ?>
                <?php if (isset($gallery_item['image_title'])): ?>
                    <h3 class="__title"><?php print $gallery_item['image_title']; ?></h3>
                <?php endif; ?>
                <?php if (isset($gallery_item['image_description'])): ?>
                  <div class="__description"><?php print $gallery_item['image_description']; ?></div>
                <?php endif; ?>
              </li>
            <?php endforeach; ?>
          </ul>
        <?php endforeach; ?>

      </div>
    </section>
  <?php endif; ?>
<?php

// @todo: Modalize and link to me.
// Or preprocess me if you don't liek the $content['zendesk_form'].
print render($content['zendesk_form']);
?>
</article>
