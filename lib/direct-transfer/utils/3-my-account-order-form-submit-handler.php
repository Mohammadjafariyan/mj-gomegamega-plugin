<?php

/*------------------------------------------------------------------*/
// Save Bank Reference Number to order
/*------------------------------------------------------------------*/
function save_custom_data_to_order()
{
	if (isset($_POST['order_id'])) {

		if (isset($_POST['submit_custom_data']) && wp_verify_nonce($_POST['custom_data_nonce'], 'save_custom_data')) {

			$Bank_Reference_Number = isset($_POST['Bank_Reference_Number']) ? sanitize_text_field($_POST['Bank_Reference_Number']) : '';
			$Bank_Reference_Description = isset($_POST['Bank_Reference_Description']) ? sanitize_text_field($_POST['Bank_Reference_Description']) : '';
			$order_id = isset($_POST['order_id']) ? intval(sanitize_text_field($_POST['order_id'])) : '';


			/*----------------VALIDATION----------------*/
			$order = wc_get_order($order_id);
			if ($order && $order->get_user_id() === get_current_user_id()) {
				// Update order meta with the submitted data

				// Provide feedback to the user (optional)
				// You can redirect or display a success message
				// For example:
				// wp_redirect( add_query_arg( 'custom_data_updated', 'true', get_permalink( $order_id ) ) );
				// exit();
			} else {
				// Handle error: Order does not belong to the current user
				return;
			}


			/*----------------FILE UPLOAD----------------*/
			if ($_FILES['Bank_Reference__file'] && $_FILES['Bank_Reference__file']['tmp_name']) {

				// Check file size
				$max_file_size = 20 * 1024 * 1024; // 20 MB (adjust as needed)
				if ($_FILES['Bank_Reference__file']['size'] > $max_file_size) {
					wp_die(__('The file you are trying to upload is too large. Please try again with a smaller file.', 'mj_gomegamega_plugin'));
				}


				$upload = wp_upload_bits($_FILES['Bank_Reference__file']['name'], null,
					file_get_contents($_FILES['Bank_Reference__file']['tmp_name']));
				if (isset($upload['error']) && $upload['error'] != 0) {
					wp_die(__('There was an error uploading your file. Please try again.', 'mj_gomegamega_plugin'));
				} else {
					// Update order meta with the uploaded file URL
					update_post_meta($order_id, 'Bank_Reference__file', $upload['url']);
				}
			}

			update_post_meta($order_id, 'Bank_Reference_Number', $Bank_Reference_Number);
			update_post_meta($order_id, 'Bank_Reference_Description', $Bank_Reference_Description);

		} else {

			if (MJ_GOMEGAMEGA_PLUGIN_DEBUG_MODE) {
				echo '<h2>not called</h2>';
				echo '<h2>not called</h2>';
				echo '<h2>not called</h2>';
				echo '<h2>not called</h2>';
			}

		}

	}
}

add_action('init', 'save_custom_data_to_order');

/*------------------------------------------------------------------*/
// Save Bank Reference Number to order END
/*------------------------------------------------------------------*/
