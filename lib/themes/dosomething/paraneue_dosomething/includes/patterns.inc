<?php
/**
 * @file
 * Functions for themeing Neue patterns.
 */

/**
 * Function that themes an item, based on a pattern from neue, that can then go into a gallery.
 *
 * @param array $content
 *   An associative array of content, can contain:
 *   - $content['title']: Used as a heading (string).
 *   - $content['description']: (string).
 *   - $content['impact']: Reportback impact (string).
 *   - $content['image']: Image markup to display (string).
 *   - $content['url']: Url to link to (string).
 * @param string $type
 *   The pattern that the content should be themed by.
 * @param boolean $use_default
 *   If the template should use a default image if it can't find one.
 * @param array $classes_array
 *   Array of classes to add to the gallery item template.
 *
 * @return string
 */
function paraneue_dosomething_get_gallery_item($content, $type = 'figure', $use_default = TRUE, $classes_array = array()) {
  // If no image is provided and we want to use a default, then set the default image here.
  if (empty($content['image']) && $use_default) {
    $content['image'] = "<img src='/" . path_to_theme() . "/bower_components/neue/dist/assets/images/apple-touch-icon-precomposed.png' />";
  }

  $variables = array(
    'content' => $content,
  );
  if (isset($classes_array)) {
    $variables['classes'] = implode(' ', $classes_array);
  }

  $tpl = 'paraneue_' . $type;
  return theme($tpl, $variables);
}

/**
 * Function that returns a <ul> representing a gallery.
 *
 * @param array $content
 *   An array of themed content to go into each <li>.
 * @param string $layout
 *   The type of gallery.
 * @param array $classes_array
 *   Any additional classes to add to the <ul>.
 *
 * @return string
 */
function paraneue_dosomething_get_gallery($content, $layout = 'triad', $classes_array = array()) {
  if (empty($content)) {
    return '';
  }
  $items = array();
  foreach ($content as $delta => $item) {
    $items[$delta]['content'] = $item;
    // Get the class to apply to this <li>.
    $class = paraneue_dosomething_get_gallery_item_order_class($delta, $layout);
    if ($class) {
      $items[$delta]['class'] = $class;
    }
  }
  $classes = NULL;
  if (!empty($classes_array)) {
    $classes = implode(' ', $classes_array);
  }
  // Prepare variables to send to gallery theme functions.
  $variables = array(
    'items' => $items,
    'layout' => $layout,
    'classes' => $classes,
  );
  return theme('paraneue_gallery', $variables);
}