<?php
/*
Plugin Name: Shipping Method Conditionally
Description: Woocommmerce manage shipping method based on time range conditionally.
Version: 1.1.0
Author: ksthannan
Author URI: https://profiles.wordpress.org/ksthannan/
Tags: shipping, wocommerce shipping conditionally, woocommerce shipping time limit, hide shipping
Requires at least: 5.0
Tested up to: 6.5
Requires PHP: 5.6
Stable tag: 1.1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: woo-wsmc
*/

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Autoload require
 */
require_once __DIR__ . "/vendor/autoload.php";

/**
 * The main plugin class
 */
final class wooSameShipControll
{
    /**
     * Plugin version
     */
    const version = '1.0';

    private function __construct()
    {
        $this->define_constants();
        register_activation_hook(__FILE__, [$this, 'activate']);

        add_action('plugins_loaded', [$this, 'init_plugin']);

        add_action('init', [$this, 'run_same_day']);

    }

    /**
     * initializing a singleton instance
     * @return \WeDevs_Academy
     */
    public static function init()
    {
        static $instance = false;
        if (!$instance) {
            $instance = new self();
        }
        return $instance;
    }

    /**
     * define constants
     */
    public function define_constants()
    {
        define('WOO_SDDTL_VERSION', self::version);
        define('WOO_SDDTL_FILE', __FILE__);
        define('WOO_SDDTL_PATH', __DIR__);
        define('WOO_SDDTL_URL', plugins_url('', WOO_SDDTL_FILE));
        define('WOO_SDDTL_ASSETS', WOO_SDDTL_URL . '/assets');
    }

    /**
     * Init plugin
     */
    public function init_plugin()
    {
        if (is_admin()) {
            new Themeongon\Woosame\Admin\Menu();
            new Themeongon\Woosame\Admin();
        }
    }

    /**
     * activation update options
     */
    public function activate()
    {

        $installer = new Themeongon\Woosame\Installer();
        $installer->run();

    }

    /**
     * run_same_day
     */
    public function run_same_day()
    {

        new Themeongon\Woosame\functions();

    }

}

/**
 * Initializing the main plugin
 * @return \wooSameShipControll
 */
function wooSameShipControll()
{
    return wooSameShipControll::init();
}

// Kick-off the plugin
wooSameShipControll();
