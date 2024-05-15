<?php



/*------------------------------------------------------------------*/
// Add custom dashboard section
/*------------------------------------------------------------------*/
function custom_dashboard_section()
{

	$current_user = wp_get_current_user();
	$customer_orders = wc_get_orders(array(
		'customer' => $current_user->ID,
		'limit' => -1,
	));
// Get the count of not completed orders

	$not_completed_count = 0;

// Iterate through orders
	foreach ($customer_orders as $order) {
		// Get order status
		$status = $order->get_status();

		// Check if order status is not "completed"
		if ($status !== 'completed') {
			$not_completed_count++;
		}
	}

	// dont display if table will be empty
	if ($not_completed_count === 0) {
		return;
	}

	?>
	<div class="custom-dashboard-section">
		<h2><?php _e('سفارشات شما', 'mj_gomegamega_plugin'); ?></h2>
		<?php


		?>
		<table class="table">
			<thead>
			<tr>
				<th>#</th>
				<th><?php _e('توضیحات', 'mj_gomegamega_plugin'); ?></th>
			</tr>
			</thead>
			<tbody>
			<?php
			foreach ($customer_orders as $order) {

				?>


				<!-- Table -->
				<tr>
					<td><?php echo '#' . $order->get_id() ?></td>
					<td> <?php

						if ($order->get_status() !== 'completed') {
							if (
								!get_post_meta($order->get_id(), 'Bank_Reference_Number', true)
								&&
								!get_post_meta($order->get_id(), 'Bank_Reference_Description', true)
								&&
								!get_post_meta($order->get_id(), 'Bank_Reference__file', true)

							) {
								printf('<p style="color:red"><a href="%s">%s</a></p>', 'view-order/1380/' . esc_url($order->get_id()), sprintf(__('رسید پرداخت بانکی مربوط به سفارش #%s ثبت نشده است ، جهت ثبت کلیک نمایید ', 'mj_gomegamega_plugin'), $order->get_order_number()));

							} else {
								printf('<p ><a href="%s">%s</a></p>', 'view-order/1380/' . esc_url($order->get_id()), sprintf(__('رسید پرداخت بانکی مربوط به سفارش #%s ثبت شده است و منتظر تایید توسط پشتیبانی می باشد ، جهت نمایش سفارش کلیک نمایید ', 'mj_gomegamega_plugin'), $order->get_order_number()));
							}

						}

						?>
					</td>
				</tr>


				<?php

			}
			?>
			</tbody>
		</table>
	</div>
	<?php
}

add_action('woocommerce_account_dashboard', 'custom_dashboard_section');

/*------------------------------------------------------------------*/
// Add custom dashboard section END
/*------------------------------------------------------------------*/


