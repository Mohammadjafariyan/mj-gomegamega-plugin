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
					<td><label><?php _e('شماره پیگیری پرداخت بانکی:', 'mj_gomegamega_plugin'); ?></label></td>
					<td>
						<label><?php echo esc_attr(get_post_meta($order->get_id(), 'Bank_Reference_Number', true)); ?></label>
					</td>
				</tr>
				<tr>
					<td><label><?php _e('توضیحات :', 'mj_gomegamega_plugin'); ?></label></td>
					<td>
						<label><?php echo esc_attr(get_post_meta($order->get_id(), 'Bank_Reference_Description', true)); ?></label>
					</td>
				</tr>
				<tr>
					<td><label><?php _e('تصویر رسید پرداخت بانکی:', 'mj_gomegamega_plugin'); ?></label></td>
					<td>
						<?php if (get_post_meta($order->get_id(), 'Bank_Reference__file', true)) { ?>
							<a target="_blank"
							   href="<?php echo esc_attr(get_post_meta($order->get_id(), 'Bank_Reference__file', true)); ?>">
								<img width="300"
									 src="<?php echo esc_attr(get_post_meta($order->get_id(), 'Bank_Reference__file', true)); ?>"/>
							</a>
						<?php } ?>
					</td>
				</tr>

				</tbody>
			</table>
		</div>
		<?php
	} else {
		?>

		<div class="custom-order-detail-field">
			<h2 class=""><?php _e('ثبت رسید پرداخت', 'mj_gomegamega_plugin'); ?></h2>
			<p><?php _e('لطفا مبلغ سفارش را به روش دلخواه ( مراجعه حضوری در بانک و واریز به شماره حساب ، کارت به کارت ، پایا ، سانتا ) واریز نموده و رسید پرداخت را وارد نمایید', 'mj_gomegamega_plugin'); ?></p>
			<p><?php _e('می توانید شماره پیگیری یا متن رسید و یا تصویر رسید پرداخت را وارد کنید', 'mj_gomegamega_plugin'); ?></p>
			<p><?php _e('بعد از ثبت رسید پرداخت، همکاران پشتیبانی وضعیت پرداخت را بررسی کرده و سفارش شما تایید خواهد شد ', 'mj_gomegamega_plugin'); ?></p>

			<form method="post" enctype="multipart/form-data">
				<input name="order_id" type="hidden" value="<?php echo esc_attr($order->get_id()); ?>">
				<table class="mj_bank_ref_table">
					<tbody>
					<tr>
						<td>
							<label
								for="Bank_Reference_Number"><?php _e('شماره پیگیری رسید پرداخت:', 'mj_gomegamega_plugin'); ?></label>
						</td>
						<td>
							<input maxlength="100" type="text" name="Bank_Reference_Number" id="Bank_Reference_Number"
								   value="<?php echo esc_attr(get_post_meta($order->get_id(), 'Bank_Reference_Number', true)); ?>"/>

						</td>
						<td>

						</td>
					</tr>
					<tr>
						<td>
							<label
								for="Bank_Reference_Description"><?php _e('توضیحات:', 'mj_gomegamega_plugin'); ?></label>
						</td>
						<td>
							<textarea maxlength="500" type="text" name="Bank_Reference_Description"
									  id="Bank_Reference_Description"><?php echo esc_attr(get_post_meta($order->get_id(), 'Bank_Reference_Description', true)); ?></textarea>

						</td>
						<td>

						</td>
					</tr>
					<tr>
						<td>
							<label
								for="Bank_Reference__file"><?php _e('تصویر رسید پرداخت:', 'mj_gomegamega_plugin'); ?></label>
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
