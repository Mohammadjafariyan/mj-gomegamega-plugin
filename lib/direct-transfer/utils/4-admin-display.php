<?php


/*------------------------------------------------------------------*/
// Display Bank Information in order details page in admin
/*------------------------------------------------------------------*/
function display_custom_data_on_admin_order($order)
{
	$Bank_Reference_Number = get_post_meta($order->get_id(), 'Bank_Reference_Number', true);
	if (!empty($Bank_Reference_Number)) {
		echo '<p><strong>' . __('Bank Reference Number') . ':</strong> <br/>' . $Bank_Reference_Number . '</p>';
	}

	$Bank_Reference_Description = get_post_meta($order->get_id(), 'Bank_Reference_Description', true);
	if (!empty($Bank_Reference_Description)) {
		echo '<p><strong>' . __('Bank Reference Description') . ':</strong><br/> ' . $Bank_Reference_Description . '</p>';
	}
	$Bank_Reference__file = get_post_meta($order->get_id(), 'Bank_Reference__file', true);
	if (!empty($Bank_Reference__file)) {
		echo '<p><strong>' . __('Bank Reference File') . ':</strong> <br/>' . '</p>';

		?>
		<a target="_blank"
		   href="<?php echo esc_attr(get_post_meta($order->get_id(), 'Bank_Reference__file', true)); ?>">
			<img width="300"
				 src="<?php echo esc_attr(get_post_meta($order->get_id(), 'Bank_Reference__file', true)); ?>"/>
		</a>
		<?php

	}
}

add_action('woocommerce_admin_order_data_after_billing_address', 'display_custom_data_on_admin_order', 10, 1);

/*------------------------------------------------------------------*/
// Display Bank Information in order details page in admin END
/*------------------------------------------------------------------*/

