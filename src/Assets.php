<?php
namespace RedonleftLogin;

if ( ! defined( 'ABSPATH' ) ) exit;

class Assets {
	public static function enqueue_frontend() {
		wp_register_script('redonleft-login-js', ASYNC_LOGIN_PLUGIN_URL . 'assets/js/redonleft-login.js', ['jquery'], '1.0.1', true);
		wp_localize_script('redonleft-login-js', 'AsyncLoginData', [
			'ajax_url' => admin_url('admin-ajax.php'),
			'nonce' => wp_create_nonce('redonleft_login_nonce')
		]);


		wp_register_style('redonleft-login-css', ASYNC_LOGIN_PLUGIN_URL . 'assets/css/redonleft-login.css');
		wp_enqueue_style('redonleft-login-css');
		wp_enqueue_script('redonleft-login-js');
	}
}