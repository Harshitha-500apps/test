<?php
namespace conferenceplugin;
class Conference
{
    public static $class = __CLASS__;
    /**
     * @param $action_id
     */
    public static function appContent($action_id){
        global $settings_conference;
        echo "<script>console.log('Debug Objects: " . $action_id . "' );</script>";
        if ($action_id == 'conference') {
            echo "<script>console.log('Debug Objects: " . $action_id . "' );</script>";
            $conference_url = "https://infinity.500apps.com/conference?a=s&menu=false";
            include 'conference_content.php';
        }
    }
    public static function action_1(){
        self::appContent('conference');
    }
    public static function action_2(){
        self::appContent('Other');
    }
    public static function init()
    {
        add_action('admin_menu', array(__CLASS__, 'register_menu_conference'),10,0);
    }
    public static function register_menu_conference()
    {
        global $settings_conference;
        add_menu_page($settings_conference['menus']['menu'], $settings_conference['menus']['menu'], 'manage_options', __FILE__, array(__CLASS__, 'action_1'),plugin_dir_url( __FILE__ ) . 'images/siterecording_icon.png');
        add_submenu_page(__FILE__, $settings_conference['menus']['sub_menu_title_1'], $settings_conference['menus']['sub_menu_title_1'], 'manage_options', $settings_conference['menus']['sub_menu_url_1'], array(__CLASS__, 'action_2'));
    }
}