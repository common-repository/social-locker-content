<table class="wpsclp_input widefat" id="wpsclp_locker_options">

	<tbody>
		
		<?php do_action( 'wpsclp_social_meta_box_start', $locker_id ); ?>

		<tr id="url_to_share">
			
			<td class="label">
				<label>
					<?php _e( 'URL to share', 'wpsclp' ); ?>
				</label>
				<p class="description"><?php _e( 'Enter url to like, to tweet or leave this field empty to use current page url', 'wpsclp' ); ?></p>
			</td>
			<td>
				<label>
					<input type="url" value="<?php echo $options['url_to_share'] ?>" name="options[url_to_share]" placeholder="http://example.com" />
				</label>
			</td>
			
		</tr>

		<tr id="header_msg">
			
			<td class="label">
				<label>
					<?php _e( 'Header', 'wpsclp' ); ?>
				</label>
				<p class="description"><?php _e( '', 'wpsclp' ); ?></p>
			</td>
			<td>
				<label>
					<input type="text" value="<?php echo $options['header_msg'] ?>" name="options[header_msg]" placeholder="The content is locked" />
				</label>
			</td>
			
		</tr>

		<tr id="content">
			
			<td class="label">
				<label>
					<?php _e( 'Message', 'wpsclp' ); ?>
				</label>
				<p class="description"><?php _e( 'Message will appear under the header', 'wpsclp' ); ?></p>
			</td>
			<td>
				<label>
					<?php if ( function_exists( 'wp_editor' ) ): ?>

						<?php wp_editor( $options['message'], 'lockermessage', array( 'textarea_rows' => 5, 'textarea_name' => 'options[message]' ) ) ?>

					<?php else: ?>

						<textarea id="lockermessage" name="options[message]"><?php echo $options['message'] ?></textarea>
					
					<?php endif; ?>
				</label>
			</td>
			
		</tr>

		<tr id="share_txt">
			
			<td class="label">
				<label>
					<?php _e( 'Share Text', 'wpsclp' ); ?>
				</label>
				<p class="description"><?php _e( '', 'wpsclp' ); ?></p>
			</td>
			<td>
				<label>
					<input type="text" value="<?php echo $options['share_txt'] ?>" name="options[share_txt]" placeholder="" />
				</label>
			</td>
			
		</tr>


		<?php do_action( 'wpsclp_social_meta_box_end', $locker_id, $options ); ?>



	</tbody>

</table>