<?php


// Add ACF Field to Custom Post Type
function mj_megamega_add_acf_fields_to_custom_post_type() {

	// Check if ACF function exists
	if (function_exists('acf_add_local_field_group')) {

		acf_add_local_field_group(array(
			'key' => 'group_reports_meta',
			'title' => 'report Meta',
			'fields' => array(
				array(
					'key' => 'field_report_period',
					'label' => 'بازه زمانی',
					'name' => 'report_period',
					'type' => 'select',
					'instructions' => 'بازه زمانی گزارش را انتخاب کنید',
					'choices' => array(
						'1' => 'ماهانه',
						'3' => 'سه ماهه',
						'12' => 'سالانه',
						// Add more period options as needed
					),
					'default_value' => '1', // Default period
					'allow_null' => false,
					'multiple' => false,
					'ui' => true,
					'ajax' => false,
					'return_format' => 'value',
					'placeholder' => '',
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'post_type',
						'operator' => '==',
						'value' => 'report', // Adjust this to match your custom post type slug
					),
				),
			),
			'menu_order' => 0,
			'position' => 'normal',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'active' => true,
			'description' => '',
		));
	}
}

add_action('acf/init', 'mj_megamega_add_acf_fields_to_custom_post_type');
