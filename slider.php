<?php
/*
    Plugin Name: MySlider Plugin
    Description: Simple implementation of a nivo slideshow into WordPress
    Author: Haylemichael Tefera
    Version: 1.0
*/
if(is_admin()){
    require_once plugin_dir_path(__FILE__).'admin/admin-menu.php';
    require_once plugin_dir_path(__FILE__).'admin/settings-page.php';
}

add_theme_support( 'post-thumbnails' );

function np_init() {
    
    add_image_size('np_widget', 180, 100, true);
	add_image_size('np_function', 600, 280, true);
    $args = array(
        'public' => true,
        'label' => 'Nivo Images',
        'supports' => array(
            'title',
            'thumbnail'
        )
    );
    register_post_type('np_images', $args);

    add_shortcode('np-shortcode', 'np_function');
}
add_action('init', 'np_init');

function np_register_scripts() {
    if (!is_admin()) {
        // register
        wp_register_script('np_nivo-script', plugins_url('nivo-slider/jquery.nivo.slider.js', __FILE__), array( 'jquery' ));
        wp_register_script('np_script', plugins_url('script.js', __FILE__));
 
        // enqueue
        wp_enqueue_script('np_nivo-script');
        wp_enqueue_script('np_script');
    }
}
 
function np_register_styles() {
    // register
    wp_register_style('np_styles', plugins_url('nivo-slider/nivo-slider.css', __FILE__));
    wp_register_style('np_styles_theme', plugins_url('nivo-slider/themes/default/default.css', __FILE__));
 
    // enqueue
    wp_enqueue_style('np_styles');
    wp_enqueue_style('np_styles_theme');
}

add_action('wp_print_scripts', 'np_register_scripts');
add_action('wp_print_styles', 'np_register_styles');


function np_function($type='np_function') {
	$args = array(
		'post_type' => 'np_images',
		'posts_per_page' => 5
	);
	$result = '<div class="slider-wrapper theme-default">';
	$result .= '<div id="slider" class="nivoSlider">';


	$loop = new WP_Query($args);
	while ($loop->have_posts()) {
		$loop->the_post();

		$the_url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), $type);
		$result .='<img title="'.get_the_title().'" src="' . $the_url[0] . '" data-thumb="' . $the_url[0] . '" alt=""/>';
	}
	$result .= '</div>';
	$result .='<div id = "htmlcaption" class = "nivo-html-caption">';
	$result .='<strong>This</strong> is an example of a <em>HTML</em> caption with <a href = "#">a link</a>.';
	$result .='</div>';
	$result .='</div>';
	return $result;
}
add_shortcode('np-shortcode', 'np_function');



?>

