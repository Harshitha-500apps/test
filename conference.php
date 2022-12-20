<?php
/*
Plugin Name: conference
Plugin URI: https://conference.com/
Author: 500apps
Author URI: https://500apps.com
Version: 0.1
Description: Collaborate with participants with secure screen sharing, real-time chatting, call recording, polls, live webinars, a lot more


define('conferencefile_root', __FILE__);
define('conference_DIR', plugin_dir_path(__FILE__));

require __DIR__ . '/conference_functions.php';
spl_autoload_register('conference_class_loader');

/**
 * Parse configuration
 */
$settings_conference = parse_ini_file(__DIR__ . '/conference_settings.ini', true);
add_action('plugins_loaded', array(\conferenceplugin\Conference::$class, 'init'));

add_action('wp_enqueue_scripts', 'conference_stylesheet');
add_action('admin_enqueue_scripts', 'conference_stylesheet');
function conference_stylesheet() 
{
    wp_enqueue_style( 'conference_CSS', plugins_url( '/conference.css', __FILE__ ) );
}

function conference_scripts(){
    wp_register_script('conference_script', plugins_url('/js/conference_admin.js', conferencefile_root), array('jquery'),time(),true);
    wp_enqueue_script('conference_script');
}    

add_action('wp_enqueue_scripts', 'conference_scripts');
add_action('admin_enqueue_scripts', 'conference_scripts');
add_action( 'wp_head', 'conference_script' );

add_action('wp_ajax_conference_addtoken', 'conference_addtoken');
add_action('wp_ajax_conference_save_website', 'conference_save_website');