<?php
/**
 * Plugin Name: Support Extends Genesis
 * Description: an Add-ons for Genesis Framework
 * Version: 1.0.5
 * Author: Duy Nguyen <duyngha@gmail.com>
 * Author URI: duywp.com
 * Plugin URI: duywp.com
 * License: GPL2
 */

/**
 * Run code under genesis core
 */
function gsInit()
{
	require_once plugin_dir_path(__FILE__) . 'vendor/autoload.php';
	require_once plugin_dir_path(__FILE__) . 'src/functions.php';
	$constants = [
		'GSPL_PATH'   => plugin_dir_path(__FILE__),
		'GSPL_URL'    => plugin_dir_url(__FILE__),
		'GSPL_VER'    => '1.0.5',
		'GSPL_REQ'    => '4.0',
		'GSPL_PRI'    => plugin_dir_path(__FILE__) . 'support-extends-genesis.php',
	];
	new GS\src\gsConstruct($constants);
}
add_action('genesis_init', 'gsInit', 12);
