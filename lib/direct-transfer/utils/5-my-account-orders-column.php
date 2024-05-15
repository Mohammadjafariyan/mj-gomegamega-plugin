<?php






/*------------------------------------------------------------------*/
// Add custom column to My Account orders table
/*------------------------------------------------------------------*/
function custom_my_account_orders_column( $columns ) {
	$order_actions  = $columns['order-actions']; // Save Order actions
	unset($columns['order-actions']); // Remove Order actions

	// Add your custom column key / label
	$columns['payment_status'] = __('وضعیت رسید پرداخت ', 'mj_gomegamega_plugin');

	// Add back previously saved "Order actions"
	$columns['order-actions'] = $order_actions;

	return $columns;
}
add_filter( 'woocommerce_my_account_my_orders_columns', 'custom_my_account_orders_column' );

// Populate data for custom column
function custom_my_account_orders_column_content( $order ) {
	// Get custom data for the order

	if (!get_post_meta($order->get_id(), 'Bank_Reference_Number', true)
		&&
		!get_post_meta($order->get_id(), 'Bank_Reference_Description', true)
		&&
		!get_post_meta($order->get_id(), 'Bank_Reference__file', true)) {

		echo '<span style="color:orange">در انتظار ثبت رسید</span>';

	} else {
		echo '<span >رسید ثبت شده</span>';

	}

}
add_action( 'woocommerce_my_account_my_orders_column_payment_status', 'custom_my_account_orders_column_content' );


/*------------------------------------------------------------------*/
// Add custom column to My Account orders table END
/*------------------------------------------------------------------*/
