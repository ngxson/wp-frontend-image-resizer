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

define('FRONTEND_IMAGE_RESIZE_MAX_WIDTH', 100);
define('FRONTEND_IMAGE_RESIZE_MAX_HEIGHT', 100);
define('FRONTEND_IMAGE_RESIZE_QUALITY', 80);

function frontend_image_resizer_get_settings() {
  return [
    'enabled' => true,
    'width' => FRONTEND_IMAGE_RESIZE_MAX_WIDTH,
    'height' => FRONTEND_IMAGE_RESIZE_MAX_HEIGHT,
    'quality' => FRONTEND_IMAGE_RESIZE_QUALITY,
  ];
}

add_action('admin_head', function () {
  ?><script>
    window.FRONTEND_IMAGE_RESIZE = <?php echo json_encode(frontend_image_resizer_get_settings()); ?>;
  </script><?php
}, 100);

function frontend_image_resizer_enqueue_script() {   
  wp_enqueue_script(
    'frontend-image-resizer',
    plugin_dir_url(__FILE__) . 'image-resizer.min.js',
    array('jquery'),
    '$version'
  );
}

add_action('admin_enqueue_scripts', 'frontend_image_resizer_enqueue_script');

function frontend_image_resizer_plupload($params) {
  $params['resize'] = frontend_image_resizer_get_settings();
  return $params;
}

add_filter('plupload_init', 'frontend_image_resizer_plupload', 100);
add_filter('plupload_default_settings', 'frontend_image_resizer_plupload', 100);
