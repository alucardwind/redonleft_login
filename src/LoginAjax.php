<?php
namespace RedonleftLogin\Ajax;
use RedonleftLogin\Widget\LoginWidget;

if (!defined('ABSPATH')) exit;

class LoginAjax {
	public static function register() {
		add_action('wp_ajax_nopriv_redonleft_login_login',[__CLASS__,'handle_login']);
		add_action('wp_ajax_redonleft_login_login',[__CLASS__,'handle_login']);


		add_action('wp_ajax_redonleft_login_logout',[__CLASS__,'handle_logout']);
		add_action('wp_ajax_nopriv_redonleft_login_logout',[__CLASS__,'handle_logout']);
	}


	public static function handle_login() {
		check_ajax_referer('redonleft_login_nonce','nonce');


		$username = $_POST['username'] ?? '';
		$password = $_POST['password'] ?? '';
		$remember = isset($_POST['remember']) ? true : false;


		$username = sanitize_text_field(wp_unslash($username));
		$password = sanitize_text_field(wp_unslash($password));


		if(empty($username)||empty($password)) wp_send_json_error(['message'=>__('Please provide username and password','redonleft-login')]);


		$creds = ['user_login'=>$username,'user_password'=>$password,'remember'=>$remember];
		$user = wp_signon($creds,is_ssl());
		if(is_wp_error($user)) wp_send_json_error(['message'=>$user->get_error_message()]);


		$html = self::render_current_widget();
		wp_send_json_success(['message'=>__('Login successful','redonleft-login'),'widget'=>$html]);
	}


	public static function handle_logout() {
		check_ajax_referer('redonleft_login_nonce','nonce');
		wp_logout();
		$html = self::render_current_widget();
		wp_send_json_success(['message'=>__('Logged out','redonleft-login'),'widget'=>$html]);
	}


	protected static function render_current_widget() {
		$widget = new \RedonleftLogin\Widget\LoginWidget();
		ob_start();
		$widget->render_widget();
		return ob_get_clean();
	}
}