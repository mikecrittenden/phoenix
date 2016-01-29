<?php

/**
 * Generates info bar footer.
 **/
?>

<?php if (isset($zendesk_form) || isset($formatted_partners) || isset($contact_us_email)): ?>
<footer class="info-bar">
  <div class="wrapper">
    <?php if (isset($formatted_partners)): ?>
      <?php print t('In partnership with'); ?> <?php print $formatted_partners; ?>
    <?php endif; ?>

    <?php if (isset($contact_us_email)): ?>
      <div class="info-bar__secondary">
        <?php print t('Questions? Email:'); ?> <?php print $contact_us_email; ?>
      </div>
    <?php elseif (isset($zendesk_form)): ?>
      <div class="info-bar__secondary">
        <?php print t('Questions?'); ?> <a href="#" data-modal-href="#modal-contact-form"><?php print t('Contact Us'); ?></a>
        <div data-modal id="modal-contact-form" class="modal--contact" role="dialog">
          <h2 class="heading -banner"><?php print t('Contact Us'); ?></h2>
          <div class="modal__block">
            <?php if($FAQs): ?>
              <?php $zendesk_form_header = $zendesk_form_header . '<p>Or get your question answered right away by first <a href="#" data-modal-href="#modal-faq">checking our FAQs</a>  which are updated regularly.</p>'; ?>
            <?php endif; ?>
            <p><?php print $zendesk_form_header; ?></p>
          </div>
          <div class="modal__block">
            <?php print render($zendesk_form); ?>
          </div>
        </div>
      </div>
    <?php endif; ?>
  </div>
</footer>
<?php endif; ?>
