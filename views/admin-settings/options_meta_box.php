<table class="wpsclp_input widefat" id="wpsclp_locker_options">

	<tbody>
		
		<?php do_action( 'wpsclp_options_meta_box_start', $locker_id ); ?>

		<tr id="status">
			
			<td class="label">
				<label>
					<?php _e( 'Enable Lightbox/Popup locker', 'wpsclp' ); ?>
				</label>
				<p class="description">
					<?php if ( ! defined('WPSCLP_PREMIUM_FUNCTIONALITY') ): ?>
						<?php _e( 'Pro version feature', 'wpsclp' ); ?>
					<?php endif; ?>
				</p>
			</td>
			<td>
				<input <?php checked( $options['enabled'], true ) ?> type="checkbox" value="yes" id="ibtn-enable" name="options[enabled]" />
			</td>
			 
		</tr>

		<tr id="theme">
			
			<td class="label">
				<label>
					<?php _e( 'Theme', 'wpsclp' ); ?>
				</label>
				<p class="description"></p>
			</td>
			<td>
				<select name="options[theme]">
					
					<?php foreach ( $themes as $theme ): ?>
						<option value="<?php echo $theme->id() ?>" <?php selected( $theme->id(), $active_theme ) ?>>
							<?php echo $theme->name() ?>
						</option>
					<?php endforeach; ?>
					
					<?php do_action( 'wpsclp_html_theme_select' ) ?>
				</select>
			</td>
			
		</tr>

		<tr id="delay_time">
			
			<td class="label">
				<label>
					<?php _e( 'Delay Time', 'wpsclp' ); ?>
				</label>
				<p class="description"><?php _e( 'Display the locker popup after the miliseconds you set', 'wpsclp' ); ?></p>
			</td>
			<td>
				<label>
					<input type="text" value="<?php echo $options['delay_time'] ?>" name="options[delay_time]" placeholder="Enter time in miliseconds" /> ms
				</label>
			</td>
			
		</tr>

		<tr id="mask_color">
			
			<td class="label">
				<label>
					<?php _e( 'Mask Color', 'wpsclp' ); ?>
				</label>
				<p class="description"></p>
			</td>
			<td>
				<label>
					<input type="text" id="mask_color_field" value="<?php echo $options['mask_color'] ?>" name="options[mask_color]" placeholder="Enter the mask color" />
				</label>
				<div id="mask_colorpicker"></div>
			</td>
			
		</tr>

		<tr id="border_color">
			
			<td class="label">
				<label>
					<?php _e( 'Border Color', 'wpsclp' ); ?>
				</label>
				<p class="description"></p>
			</td>
			<td>
				<label>
					<input type="text" id="border_color_field" value="<?php echo $options['border_color'] ?>" name="options[border_color]" placeholder="Enter the border color" />
				</label>
				<div id="border_colorpicker"></div>
			</td>
			
		</tr>

		<tr id="transition">
			
			<td class="label">
				<label>
					<?php _e( 'Transition', 'wpsclp' ); ?>
				</label>
				<p class="description"><?php _e( 'Set the transition effect', 'wpsclp' ) ?></p>
			</td>
			<td>
				<select name="options[transition]">
					
					<option value="elastic" <?php selected( 'elastic', $options['transition'] ) ?>>
							<?php _e( 'Elastic', 'wpsclp' ) ?>
					</option>

					<option value="fade" <?php selected( 'fade', $options['transition'] ) ?>>
							<?php _e( 'Fade', 'wpsclp' ) ?>
					</option>

					<option value="none" <?php selected( 'none', $options['transition'] ) ?>>
							<?php _e( 'None', 'wpsclp' ) ?>
					</option>
					
					<?php do_action( 'wpsclp_html_transition_select' ) ?>
				</select>
			</td>
			
		</tr>

		<?php do_action( 'wpsclp_options_meta_box_before_rules', $locker_id ); ?>

		<tr id="rules">
			
			<td class="label">
				<label>
					<?php _e( 'Rules', 'wpsclp' ); ?>
				</label>
				<p class="description"><?php _e( 'Apply rules to your locker', 'wpsclp' ) ?></p>
			</td>
			<td>
				<p>
					<label>
							<input type="checkbox" <?php checked( $options['rules']['show_on_homepage'], true ) ?> name="options[rules][show_on_homepage]" value="true" /> <?php _e( 'Show on homepage', 'wpsclp' ) ?>
					</label>
				</p>

				<p>
					<label>
							<input type="checkbox" <?php checked( $options['rules']['show_only_on_homepage'], true ) ?> name="options[rules][show_only_on_homepage]" value="true" /> <?php _e( 'Show <strong>only</strong> on homepage', 'wpsclp' ) ?>
					</label>
				</p>

				<p>
					<label>
							<input type="checkbox" <?php checked( $options['rules']['show_to_logged_in_users'], true ) ?> name="options[rules][show_to_logged_in_users]" value="true" /> <?php _e( 'Show to logged-in users', 'wpsclp' ) ?>
					</label>
				</p>

				<p>
					<label>
							<input type="checkbox" <?php checked( $options['rules']['hide_on_mobile_devices'], true ) ?> name="options[rules][hide_on_mobile_devices]" value="true" /> <?php _e( 'Hide on mobile devices', 'wpsclp' ) ?>
					</label>
				</p>

				<p>
					<label>
							<input type="checkbox" <?php checked( $options['rules']['show_only_to_search_engine_visitors'], true ) ?> name="options[rules][show_only_to_search_engine_visitors]" value="true" /> <?php _e( 'Show only to search engine visitors', 'wpsclp' ) ?>
					</label>
				</p>
				
				<p>
					<label>
							<input type="checkbox" <?php checked( $options['rules']['use_cookies'], true ) ?> name="options[rules][use_cookies]" value="true" /> 
							<?php _e( 'Use Cookies', 'wpsclp' ) ?>
					</label>
				</p>

				<p>
					<label>
						<input type="text" value="<?php echo $options['rules']['cookie_expiration_time'] ?>" name="options[rules][cookie_expiration_time]" placeholder="Cookie Expiration Time" /> <?php _e( 'Days', 'wpsclp' ) ?>
					</label>
				</p>

				<!--<p>
					<label>
							<input type="checkbox" <?php checked( $options['rules']['counter'], true ) ?> name="options[rules][counter]" value="true" /> 
							<?php _e( 'Social Counter', 'wpsclp' ) ?>
					</label>
				</p> -->

				<p>
					<label>
							<input type="checkbox" <?php checked( $options['rules']['google_plus'], true ) ?> name="options[rules][google_plus]" value="true" /> 
							<?php _e( 'Google Plus', 'wpsclp' ) ?>
					</label>
				</p>

				<p>
					<label>
							<input type="checkbox" <?php checked( $options['rules']['facebook'], true ) ?> name="options[rules][facebook]" value="true" /> 
							<?php _e( 'Facebook', 'wpsclp' ) ?>
					</label>
				</p>

				<p>
					<label>
							<input type="checkbox" <?php checked( $options['rules']['twitter'], true ) ?> name="options[rules][twitter]" value="true" /> 
							<?php _e( 'Twitter', 'wpsclp' ) ?>
					</label>
				</p>

				<p>
					<label>
							<input type="checkbox" <?php checked( $options['rules']['linkedin'], true ) ?> name="options[rules][linkedin]" value="true" /> 
							<?php _e( 'Linkedin', 'wpsclp' ) ?>
					</label>
				</p>

			</td>
			
		</tr>


		<?php do_action( 'wpsclp_options_meta_box_end', $locker_id, $options ); ?>



	</tbody>

</table>