<?php
/**
 *
 * @package   Codestar Framework - WordPress Options Framework
 * @author    Codestar <info@codestarthemes.com>
 * @link      http://codestarframework.com
 * @copyright 2015-2018 Codestar
 *
 *
 * Plugin Name: Stock Toolkit
 * Plugin URI: http://onlinecoder.com/
 * Author: Online Coder
 * Author URI: http://onlinecoder.com/
 * Version: 1.0.0
 * Description: A Simple and Lightweight WordPress Option Framework for Themes and Plugins
 * Text Domain: oc
 * Domain Path: /languages
 *
 */
// Exit if accessible directly
if( !defined('ABSPATH' ) ){
   exit;
}

// Define
define('STOCK_ACC_URL', WP_PLUGIN_URL.'/'. plugin_basename( dirname( __FILE__ ) ) . '/' );
define('STOCK_ACC_PATH', plugin_dir_path( __FILE__ ) );

add_action( 'init', 'stock_slider_custom_post' );
function stock_slider_custom_post() {
    register_post_type( 'slides',
        array(
            'labels' => array(
                'name' => __( 'Sliders' ),
                'singular_name' => __( 'Slider' )
            ),
            'supports' => array('title', 'editor', 'thumbnail', 'page-attributes'),
            'public'    => false,
            'show_ui'   => true,
        )
    );
}

// Print Shortcode In Widget
add_filter('widget_text', 'do_shortcode');

// Loading VC_addons
require_once( STOCK_ACC_PATH . 'vc-addons/vc-block-load.php');

// Theme Shortchodes
require_once( STOCK_ACC_PATH . 'theme-shortcodes/slides-shortcode.php');

// ShortCodes Depended on Visual Composer
include_once( ABSPATH . 'wp-admin/includes/plugin.php');
if( is_plugin_active( 'js_composer/js_composer.php' )){
   require_once( STOCK_ACC_PATH . 'theme-shortcodes/slides-shortcode.php');
}


// Registering Stock Tolkit File
function stock_tolkit_files(){
   wp_enqueue_style('owl-carousel', plugin_dir_url( __FILE__ ) .'assets/css/owl.carousel.min.css');
   wp_enqueue_style('plugin-style', plugin_dir_url( __FILE__ ) .'assets/css/style.css');
   wp_enqueue_script('owl-carousel', plugin_dir_url( __FILE__ ) .'assets/js/owl.carousel.min.js', array('jquery'), '2.3.4', true);
}
add_action('wp_enqueue_scripts','stock_tolkit_files');