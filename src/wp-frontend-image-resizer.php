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

if (!class_exists('FrontendImageResizer')) {
  class FrontendImageResizer {
    function __construct() {
      add_action('admin_head', [$this, 'populate_settings'], 100);
      add_action('admin_enqueue_scripts', [$this, 'enqueue_script']);
      add_filter('plupload_init', [$this, 'resizer_plupload'], 100);
      add_filter('plupload_default_settings', [$this, 'resizer_plupload'], 100);
    }

    function get_settings() {
      return [
        'enabled' => true,
        'width' => FRONTEND_IMAGE_RESIZE_MAX_WIDTH,
        'height' => FRONTEND_IMAGE_RESIZE_MAX_HEIGHT,
        'quality' => FRONTEND_IMAGE_RESIZE_QUALITY,
      ];
    }

    function populate_settings() {
      ?><script>
        window.FRONTEND_IMAGE_RESIZE = <?php echo json_encode($this->get_settings()); ?>;
      </script><?php
    }

    function enqueue_script() {   
      wp_enqueue_script(
        'frontend-image-resizer',
        plugin_dir_url(__FILE__) . 'image-resizer.min.js',
        array('jquery'),
        '$version'
      );
    }

    function resizer_plupload($params) {
      $params['resize'] = $this->get_settings();
      return $params;
    }
  }

  new FrontendImageResizer();
}
