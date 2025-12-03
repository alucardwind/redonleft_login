<?php
/**
 * Plugin Name: Redonleft Login
 * Plugin URI: https://redonleft.com/
 * Description: 针对redonleft.com，用于异步登录
 * Version: 2.0.0
 * Author: redonleft
 * Author URI: https://www.redonleft.com
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'ASYNC_LOGIN_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'ASYNC_LOGIN_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

// PSR-4 样式自动加载
//spl_autoload_register( function( $class ) {
//	$prefix = 'RedonleftLogin\\';
//	$base_dir = __DIR__ . '/src/';
//
//
//	if ( 0 !== strpos( $class, $prefix ) ) return;
//
//
//	$relative_class = substr( $class, strlen( $prefix ) );
//	$file = $base_dir . str_replace( '\\', '/', $relative_class ) . '.php';
//
//
//	if ( file_exists( $file ) ) require_once $file;
//});

require_once __DIR__ . '/src/Plugin.php';
require_once __DIR__ . '/src/Assets.php';
require_once __DIR__ . '/src/LoginWidget.php';
require_once __DIR__ . '/src/LoginAjax.php';

add_action( 'plugins_loaded', function() {
	$plugin = RedonleftLogin\Plugin::get_instance();
	$plugin->run();
} );
