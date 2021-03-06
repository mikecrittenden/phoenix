<?php
/*
 * Sanitize mobile numbers on user accounts from ages ago.
 *
 *
 *
 * drush --script-path=../scripts php-script sanitize-mobile-numbers.php
 *
 */

$wild_typers = db_query('SELECT entity_id as uid, field_mobile_value as mobile
              FROM field_data_field_mobile
              WHERE field_mobile_value NOT REGEXP(\'^[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]$\')');
//                                                    ^ whaaa? drupal removes all brackets w/ no way to opt-out, so
//                                                      it seems like we have to repeat the [0-9] manually 10 times.

foreach($wild_typers as $wilder) {
  if ($wilder->mobile) {
    $user = user_load($wilder->uid);
    $original_mobile = $wilder->mobile;
    $fresh_and_clean_digits = dosomething_user_clean_mobile_number(preg_replace('[^0-9]', '', $original_mobile));

    if ($fresh_and_clean_digits) {
      print 'Updated user ' . $user->uid . '(' . $original_mobile . ' --> ' . $fresh_and_clean_digits . ')' . PHP_EOL;
      $edit = ['field_mobile' => [ LANGUAGE_NONE => [ 0 => [ 'value' => $fresh_and_clean_digits ] ] ] ];
    }
    else {
      print 'Could not salvage ' . $wilder->uid . ' (' . $wilder->mobile . ')' . PHP_EOL;
      $edit = ['field_mobile' => [ LANGUAGE_NONE => [] ] ];

      // If the user doesn't have a real email, set them a "invalid" placeholder.
      if (preg_match('/@mobile(\.import)?$/', $user->mail)) {
        $edit['mail'] = 'bad-mobile-' . $user->uid . '@dosomething.invalid';
      }
    }

    // Update the `field_mobile` for that user (to either sanitize or remove it).
    $user = user_save($user, $edit);

    // Now, update (or create) the corresponding profile in Northstar by Drupal ID.
    dosomething_northstar_update_user($user);
  }
}

print 'done';
