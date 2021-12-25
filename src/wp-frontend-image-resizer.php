<?php
/**
 * Plugin Name: Frontend Image Resizer
 * Version: $version
 * Plugin URI: https://github.com/ngxson/wp-frontend-image-resizer/
 * Description: $description
 * Author: ngxson
 * Author URI: https://ngxson.com/
 * Requires at least: 4.0
 * Tested up to: 5.8
 */

function frontend_image_resizer_enqueue_script() {   
  wp_enqueue_script(
    'frontend_image_resizer',
    plugin_dir_url(__FILE__) . 'image-resizer.min.js',
    array('jquery'),
    '1.0'
  );
}

add_action('admin_enqueue_scripts', 'frontend_image_resizer_enqueue_script');