<?php

/**
 * Plugin Name:     Go Mega Mega
 * Plugin URI:      https://bulus.ir
 * Description:     This plugin created for go mega mega website
 * Author:          wp-cli
 * Author URI:      https://bulus.ir
 * Text Domain:     mj_gomegamega_plugin
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Mj_Gomegamega_Plugin
 */

// Your code starts here.


require __DIR__ . '/report-custom-type.php';
require __DIR__ . '/acf-setting-to-posttypes.php';
require __DIR__ . '/lib/direct-transfer/mj-woo-direct-transfer-ref.php';


add_filter('woocommerce_is_purchasable', 'mj_deny_purchase_if_already_purchased', 9999, 2);

function mj_deny_purchase_if_already_purchased($is_purchasable, $product)
{

	$value = get_option('mj_gomegamega_product', '');

	if($product->get_id() == $value)
	{
		if (is_user_logged_in() && wc_customer_bought_product('', get_current_user_id(), $product->get_id())) {
			$is_purchasable = false;
		}
	}
	return $is_purchasable;
}



/* ---------------------------- menu ------------------------- */
add_action('admin_menu', 'mj_gomegamega_create_menu');
add_action('admin_init', 'mj_gomegamega_register_settings');

function mj_gomegamega_create_menu()
{
	//create custom top-level menu
	add_menu_page(
		'Go MegaMega Settings',
		'Go MegaMega Settings',
		'manage_options',
		'mj_gomegamega_options',
		'mj_gomegamega_main_menu_callback',
		'dashicons-smiley',
		99
	);
}

function mj_gomegamega_register_settings()
{
	register_setting('mj_gomegamega_settings_group', 'mj_gomegamega_product');

	// Add a new section to the custom settings page
	add_settings_section(
		'mj_gomegamega_custom_main_section',       // Section ID
		'Main Settings',             // Section title
		'mj_gomegamega_section_text',                        // Callback function to output content
		'mj_gomegamega_options'            // Page slug
	);

	// Add a new field to the section
	add_settings_field(
		'mj_gomegamega_product',         // Field ID
		'انتخاب محصول یکبار خرید ',                // Field label
		'mj_gomegamega_product_callback', // Callback function for the field
		'mj_gomegamega_options',           // Page slug
		'mj_gomegamega_custom_main_section'        // Section ID
	);
}



// Draw the section header
function mj_gomegamega_section_text()
{
	echo '<p>' . __("Go Mega Mega setting ", "mjkh-otp") . '</p>';
}


function mj_gomegamega_product_callback()
{
	// get option 'text_string' value from the database
	$value = get_option('mj_gomegamega_product', '');

	// Set your args
	$args = array(

		'limit' => 10,
		'orderby' => 'date',
		'order' => 'DESC'

	);

	// Perform Query
	$query = new WC_Product_Query($args);

	// Collect Product Object
	$products = $query->get_products();

	// Loop through products
	if (!empty($products)) {

	?>	<select name='mj_gomegamega_product'> <?php
		foreach ($products as $product) {

?>

				<option value='<?php echo esc_attr($product->get_id()); ?>' <?php selected($value, $product->get_id()); ?>>
					<?php echo esc_attr($product->get_name()); ?></option>
	<?php

		}
	?>	</select> <?php

	}
}
// Create the option page
function mj_gomegamega_main_menu_callback()
{
	?>
	<div class="wrap">
		<h2>OTP Login Plugin Setting Page</h2>
		<form action="options.php" method="post">
			<?php
			// Output the settings sections and settings fields
			settings_fields('mj_gomegamega_settings_group');  // Identifies the settings group
			do_settings_sections('mj_gomegamega_options');   // Identifies the settings page
			submit_button();  // Adds a submit button
			?>
		</form>
	</div>
<?php
}















