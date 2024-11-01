<div id="locker_<?php echo $locker_id ?>" data-locker_options="<?php echo esc_attr(json_encode( $options )); ?>" data-id="<?php echo $locker_id ?>" class="wpsclp_locker wpsclp_theme2" data-theme="theme2" data-type="shortcode">
  <h3 class="wpsclp_header"><?php echo esc_html( $options['header_msg'] ) ?></h3>
  <p class="wpsclp_locker_msg"><?php echo $options['message'] ?></p>
  <div class="wpsclp_btns" id="wpsclp_btns_<?php echo $locker_id ?>">
  	
  	<div class="wpsclp_btn wpsclp_btn_googleplus" data-locker_id="<?php echo $locker_id ?>"></div>
    <div class="wpsclp_btn wpsclp_btn_twitter" data-locker_id="<?php echo $locker_id ?>"></div>
  	<div class="wpsclp_btn wpsclp_btn_facebook" data-locker_id="<?php echo $locker_id ?>"></div>
  	<div class="wpsclp_btn wpsclp_btn_linkedin" data-locker_id="<?php echo $locker_id ?>"></div>
  </div>
</div>

<div id="locker_content_<?php echo $locker_id ?>" class="wpsclp_content">
    <?php echo $content; ?>
</div>

<script>wpsclp_show_content_g_plus_<?php echo esc_js( $locker_id ) ?> = function(o) {var locker_id = <?php echo esc_js( $locker_id ) ?>;wpsclp_show_content(locker_id);}</script>