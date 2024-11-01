<div id='<?php echo $locker_id . '-locker_popup' ?>' style='padding:10px;' class="wpsclp_responsive_locker_lightbox mfp-hide">
	<div id="locker_<?php echo $locker_id ?>" data-locker_options="<?php echo esc_attr(json_encode( $options )); ?>" data-id="<?php echo $locker_id ?>" class="wpsclp_locker wpsclp_theme2" data-theme="theme2" data-type="popup">
  <h3 class="wpsclp_header"><?php echo esc_html( $options['header_msg'] ) ?></h3>
  <p class="wpsclp_locker_msg"><?php echo $options['message'] ?></p>
  <div class="wpsclp_btns" id="wpsclp_btns_<?php echo $locker_id ?>">
  	
  	<div class="wpsclp_btn wpsclp_btn_googleplus" data-locker_id="<?php echo $locker_id ?>"></div>
    <div class="wpsclp_btn wpsclp_btn_twitter" data-locker_id="<?php echo $locker_id ?>"></div>
  	<div class="wpsclp_btn wpsclp_btn_facebook" data-locker_id="<?php echo $locker_id ?>"></div>
  	<div class="wpsclp_btn wpsclp_btn_linkedin" data-locker_id="<?php echo $locker_id ?>"></div>
  </div>
</div>
</div>