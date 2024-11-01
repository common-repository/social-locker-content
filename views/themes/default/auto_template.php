<div id='<?php echo $locker_id . '-locker_popup' ?>' style='padding:10px;' class="wpsclp_responsive_locker_lightbox mfp-hide">
<div id="locker_<?php echo $locker_id ?>" data-locker_options="<?php echo esc_attr(json_encode( $options )); ?>" data-id="<?php echo $locker_id ?>" class="wpsclp_locker" data-theme="default" data-type="popup">
  <h3 class="wpsclp_header"><?php echo esc_html( $options['header_msg'] ) ?></h3>
  <p class="wpsclp_locker_msg"><?php echo $options['message'] ?></p>
  <div class="wpsclp_btns" id="wpsclp_btns_<?php echo $locker_id ?>"></div>
</div>
</div>

<script>wpsclp_show_content_g_plus_<?php echo esc_js( $locker_id ) ?> = function(o) {var locker_id = <?php echo esc_js( $locker_id ) ?>;wpsclp_show_content(locker_id);}</script>