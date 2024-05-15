<?php


/*------------------------------------------------------------------*/
// Form :Add custom field to order detail page
/*------------------------------------------------------------------*/
function custom_order_detail_field($order)
{

	if ($order && $order->get_status() === 'completed') {
		// Order is completed
		?>
		<div class="custom-order-detail-field">
			<table>
				<tbody>
				<tr>
					<td><label><?php _e('Bank Reference Number:', 'mj_gomegamega_plugin'); ?></label></td>
					<td>
						<label><?php echo esc_attr(get_post_meta($order->get_id(), 'Bank_Reference_Number', true)); ?></label>
					</td>

				</tr>
				</tbody>
			</table>
		</div>
		<?php
	} else {
		?>

		<div class="custom-order-detail-field">
			<h2><?php _e('Bank Reference Number', 'mj_gomegamega_plugin'); ?></h2>
			<form method="post" enctype="multipart/form-data">
				<input name="order_id" type="hidden" value="<?php echo esc_attr($order->get_id()); ?>">
				<table class="mj_bank_ref_table">
					<tbody>
					<tr>
						<td>
							<label
								for="Bank_Reference_Number"><?php _e('Enter Bank Reference Number:', 'mj_gomegamega_plugin'); ?></label>
						</td>
						<td>
							<input type="text" name="Bank_Reference_Number" id="Bank_Reference_Number"
								   value="<?php echo esc_attr(get_post_meta($order->get_id(), 'Bank_Reference_Number', true)); ?>"/>

						</td>
						<td>

						</td>
					</tr>
					<tr>
						<td>
							<label
								for="Bank_Reference_Description"><?php _e('Enter Description:', 'mj_gomegamega_plugin'); ?></label>
						</td>
						<td>
							<textarea type="text" name="Bank_Reference_Description"
									  id="Bank_Reference_Description"><?php echo esc_attr(get_post_meta($order->get_id(), 'Bank_Reference_Description', true)); ?></textarea>

						</td>
						<td>

						</td>
					</tr>
					<tr>
						<td>
							<label
								for="Bank_Reference__file"><?php _e('Upload Bank File:', 'mj_gomegamega_plugin'); ?></label>
						</td>
						<td>
							<?php if (get_post_meta($order->get_id(), 'Bank_Reference__file', true)) { ?>
								<a target="_blank"
								   href="<?php echo esc_attr(get_post_meta($order->get_id(), 'Bank_Reference__file', true)); ?>">
									<img width="300"
										 src="<?php echo esc_attr(get_post_meta($order->get_id(), 'Bank_Reference__file', true)); ?>"/>
								</a>
							<?php } ?>

							<input type="file" name="Bank_Reference__file" id="Bank_Reference__file"/>

						</td>
						<td>
							<input type="submit" name="submit_custom_data"
								   value="<?php _e('Submit', 'mj_gomegamega_plugin'); ?>"/>
							<?php wp_nonce_field('save_custom_data', 'custom_data_nonce'); ?>

						</td>
					</tr>
					</tbody>
				</table>
			</form>

		</div>
		<?php
	}


}

add_action('woocommerce_order_details_after_order_table', 'custom_order_detail_field', 10, 1);


/*------------------------------------------------------------------*/
// Add custom field to order detail page END
/*------------------------------------------------------------------*/
