<?php
// Register Custom Post Type
function mj_gomegamega_report_post_type() {

	$labels = array(
		'name'                  => _x( 'گزارش ها', 'Post Type General Name', 'mj_gomegamega_plugin' ),
		'singular_name'         => _x( 'گزارش', 'Post Type Singular Name', 'mj_gomegamega_plugin' ),
		'menu_name'             => __( 'گزارش ها', 'mj_gomegamega_plugin' ),
		'name_admin_bar'        => __( 'گزارش', 'mj_gomegamega_plugin' ),
		'archives'              => __( 'گزارش آرشیو', 'mj_gomegamega_plugin' ),
		'attributes'            => __( 'گزارش Attributes', 'mj_gomegamega_plugin' ),
		'parent_item_colon'     => __( 'Parent گزارش:', 'mj_gomegamega_plugin' ),
		'all_items'             => __( 'تمام گزارش ها', 'mj_gomegamega_plugin' ),
		'add_new_item'          => __( 'افزودن گزارش', 'mj_gomegamega_plugin' ),
		'add_new'               => __( 'افزودن', 'mj_gomegamega_plugin' ),
		'new_item'              => __( 'جدید گزارش', 'mj_gomegamega_plugin' ),
		'edit_item'             => __( 'ویرایش گزارش', 'mj_gomegamega_plugin' ),
		'update_item'           => __( 'اپدیت گزارش', 'mj_gomegamega_plugin' ),
		'view_item'             => __( 'نمایش گزارش', 'mj_gomegamega_plugin' ),
		'view_items'            => __( 'نمایش گزارش ها', 'mj_gomegamega_plugin' ),
		'search_items'          => __( 'جستجو گزارش', 'mj_gomegamega_plugin' ),
		'not_found'             => __( 'یافت نشد', 'mj_gomegamega_plugin' ),
		'not_found_in_trash'    => __( 'یافت نشد in Trash', 'mj_gomegamega_plugin' ),
		'featured_image'        => __( 'Featured Image', 'mj_gomegamega_plugin' ),
		'set_featured_image'    => __( 'Set featured image', 'mj_gomegamega_plugin' ),
		'remove_featured_image' => __( 'Remove featured image', 'mj_gomegamega_plugin' ),
		'use_featured_image'    => __( 'Use as featured image', 'mj_gomegamega_plugin' ),
		'insert_into_item'      => __( 'Insert into book', 'mj_gomegamega_plugin' ),
		'uploaded_to_this_item' => __( 'Uploaded to this book', 'mj_gomegamega_plugin' ),
		'items_list'            => __( 'گزارش ها list', 'mj_gomegamega_plugin' ),
		'items_list_navigation' => __( 'گزارش ها list navigation', 'mj_gomegamega_plugin' ),
		'filter_items_list'     => __( 'Filter books list', 'mj_gomegamega_plugin' ),
	);
	$args = array(
		'label'                 => __( 'گزارش', 'mj_gomegamega_plugin' ),
		'description'           => __( 'Post Type Description', 'mj_gomegamega_plugin' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
		'taxonomies'            => array( 'genre', 'author' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'show_in_rest'          => true,
	);
	register_post_type( 'report', $args );

}
add_action( 'init', 'mj_gomegamega_report_post_type', 0 );



// Register Custom Taxonomy
function mj_gomegamega_report_category_taxonomy() {

	$labels = array(
		'name'                       => _x( 'دسته بندی گزارش ها', 'Taxonomy General Name', 'mj_gomegamega_plugin' ),
		'singular_name'              => _x( 'دسته بندی گزارش', 'Taxonomy Singular Name', 'mj_gomegamega_plugin' ),
		'menu_name'                  => __( 'دسته بندی گزارش ها', 'mj_gomegamega_plugin' ),
		'all_items'                  => __( 'تمام دسته بندی گزارش ها', 'mj_gomegamega_plugin' ),
		'parent_item'                => __( 'Parent دسته بندی گزارش', 'mj_gomegamega_plugin' ),
		'parent_item_colon'          => __( 'Parent دسته بندی گزارش:', 'mj_gomegamega_plugin' ),
		'new_item_name'              => __( 'جدید دسته بندی گزارش Name', 'mj_gomegamega_plugin' ),
		'add_new_item'               => __( 'افزودن دسته بندی گزارش', 'mj_gomegamega_plugin' ),
		'edit_item'                  => __( 'ویرایش دسته بندی گزارش', 'mj_gomegamega_plugin' ),
		'update_item'                => __( 'اپدیت دسته بندی گزارش', 'mj_gomegamega_plugin' ),
		'view_item'                  => __( 'نمایش دسته بندی گزارش', 'mj_gomegamega_plugin' ),
		'separate_items_with_commas' => __( 'Separate genres with commas', 'mj_gomegamega_plugin' ),
		'add_or_remove_items'        => __( 'Add or remove genres', 'mj_gomegamega_plugin' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'mj_gomegamega_plugin' ),
		'popular_items'              => __( 'Popular دسته بندی گزارش ها', 'mj_gomegamega_plugin' ),
		'search_items'               => __( 'جستجو دسته بندی گزارش ها', 'mj_gomegamega_plugin' ),
		'not_found'                  => __( 'یافت نشد', 'mj_gomegamega_plugin' ),
		'no_terms'                   => __( 'هیچ دسته بندی یافت نشد', 'mj_gomegamega_plugin' ),
		'items_list'                 => __( 'دسته بندی گزارش ها لیست', 'mj_gomegamega_plugin' ),
		'items_list_navigation'      => __( 'دسته بندی گزارش ها list navigation', 'mj_gomegamega_plugin' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'show_in_rest'               => true,
	);
	register_taxonomy( 'report_category', array( 'report' ), $args );

}
add_action( 'init', 'mj_gomegamega_report_category_taxonomy', 0 );



