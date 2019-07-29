<?php
/*
Plugin Name: Loco Automatic Translate Addon
Description: Auto language translator add-on for Loco Translate plugin to translate plugins and themes translation files into any language via fully automatic machine translations via Yendex Translate API.
Version: 1.0.2
License: GPL2
Text Domain:atlt
Domain Path:languages
Author:Cool Plugins
Author URI: https://coolplugins.net/
 */

 /**
 * @package Loco Automatic Translate Addon
 * @version 1.0.2
 */
if (!defined('ABSPATH')) {
    die('WordPress Environment Not Found!');
}

define('ATLT_FILE', __FILE__);
define('ATLT_URL', plugin_dir_url(ATLT_FILE));
define('ATLT_PATH', plugin_dir_path(ATLT_FILE));

class LocoAutoTranslate
{

    public function __construct()
    {

        register_activation_hook( ATLT_FILE, array( $this, 'atlt_activate' ) );
	    register_deactivation_hook( ATLT_FILE, array( $this, 'atlt_deactivate' ) );
        add_action('init', array($this, 'atlt_include_files'));
        add_action('plugins_loaded', array($this, 'atlt_check_required_loco_plugin'));
        add_action( 'admin_enqueue_scripts', array( $this, 'atlt_enqueue_scripts') );
        add_action('wp_ajax_atlt_translation', array($this, 'atlt_translate_words'), 100);

     //   delete_option("atlt-installDate");
       //  delete_option("atlt-ratingDiv");
    }


   /*
   |----------------------------------------------------------------------
   | required php files
   |----------------------------------------------------------------------
   */
   public function atlt_include_files()
   {
        require_once ATLT_PATH . 'includes/class.settings-api.php';
        require_once ATLT_PATH . 'includes/atlt-settings.php';
        new Atlt_Settings_Panel();

         if ( is_admin() ) {
                require_once ATLT_PATH . "includes/atlt-feedback-notice.php";
                 new atltFeedbackNotice();
            }
   }

   /*
   |----------------------------------------------------------------------
   | AJAX called to this function for translation
   |----------------------------------------------------------------------
   */
   public function atlt_translate_words()
   {

        $api_key = get_option('atlt_register');
        $KEY = $api_key['atlt_api-key'];
        $lang = $_REQUEST['sourceLan'] . '-' . $_REQUEST['targetLan'];
        $DATA = $_REQUEST['data'];        
        if (empty($DATA)) {
            die(json_encode(array('code' => 900, 'message' => 'Empty request')));
        }
        $data = '[' . implode('],![', $DATA) . ']';
        
        $HOST = 'https://translate.yandex.net/api/v1.5/tr.json/translate?key=' . $KEY . '&lang=' . $lang;
        $response = wp_remote_post($HOST, array('body' => array('text' => $data)));

        if (is_wp_error($response)) {
            return $response; // Bail early
        }

        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body);

        die(json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));

   }

   /*
   |----------------------------------------------------------------------
   | check if required "Loco Translate" plugin is active
   | also register the plugin text domain
   |----------------------------------------------------------------------
   */
   public function atlt_check_required_loco_plugin()
   {

      if (!function_exists('loco_plugin_self')) {
         add_action('admin_notices', array($this, 'atlt_plugin_required_admin_notice'));
      }
      load_plugin_textdomain('atlt', false, basename(dirname(__FILE__)) . '/languages/');

   }

   /*
   |----------------------------------------------------------------------
   | Notice to 'Admin' if "Loco Translate" is not active
   |----------------------------------------------------------------------
   */
   public function atlt_plugin_required_admin_notice()
   {
      if (current_user_can('activate_plugins')) {
         $url = 'plugin-install.php?tab=plugin-information&plugin=loco-translate&TB_iframe=true';
         $title = "Loco Translate";
         $plugin_info = get_plugin_data(__FILE__, true, true);
         echo '<div class="error"><p>' . sprintf(__('In order to use <strong>%s</strong> plugin, please install and activate the latest version of <a href="%s" class="thickbox" title="%s">%s</a>', 'atlt'), $plugin_info['Name'], esc_url($url), esc_attr($title), esc_attr($title)) . '.</p></div>';
         deactivate_plugins(__FILE__);
      }
   }

   /*
   |------------------------------------------------------------------------
   |  Enqueue required JS file
   |------------------------------------------------------------------------
   */
   function atlt_enqueue_scripts(){
       
       wp_deregister_script('loco-js-editor');
       wp_register_script( 'loco-js-editor', ATLT_URL.'assets/js/loco-js-editor.js', array('loco-js-min-admin'),false, true);
       
       if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'file-edit') {
            wp_enqueue_script('loco-js-editor');
            wp_localize_script('loco-js-editor', 'ATLT', array('api_key' => get_option('atlt_register')));  
       }

   }

   /*
   |------------------------------------------------------
   |    Plugin activation
   |------------------------------------------------------
    */
   public function atlt_activate(){
       $plugin_info = get_plugin_data(__FILE__, true, true);
       update_option('atlt_version', $plugin_info['Version'] );
        update_option("atlt-installDate",date('Y-m-d h:i:s') );
        update_option("atlt-ratingDiv","no");


   }


   /*
   |-------------------------------------------------------
   |    Plugin deactivation
   |-------------------------------------------------------
   */
   public function atlt_deactivate(){

   }

}
new LocoAutoTranslate();
