<?php
/**
 * The WordPress Plugin Boilerplate.
 *
 * A foundation off of which to build well-documented WordPress plugins that also follow
 * WordPress coding standards and PHP best practices.
 *
 * @package   PluginName
 * @author    Your Name <email@example.com>
 * @license   GPL-2.0+
 * @link      http://example.com
 * @copyright 2013 Your Name or Company Name
 *
 * @wordpress-plugin
 * Plugin Name: Page Template Dashboard
 * Plugin URI:  http://tommcfarlin.com/page-template-dashboard/
 * Description: An easy way to see which templates your pages are using without having to view the page editor.
 * Version:     1.3.0
 * Author:      Tom McFarlin
 * Author URI:  http://tommcfarlin.com/
 * Text Domain: page-template-dashboard-locale
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: /lang
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

require_once( plugin_dir_path( __FILE__ ) . 'class-page-template-dashboard.php' );
Page_Template_Dashboard::get_instance();