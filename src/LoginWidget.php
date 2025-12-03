<?php
namespace RedonleftLogin\Widget;
use WP_Widget;

if ( ! defined( 'ABSPATH' ) ) exit;

class LoginWidget extends WP_Widget {
	public function __construct() {
		parent::__construct(
			'redonleft_login_widget',
			__('左半红印登录窗', 'redonleft-login'),
			['description' => __('AJAX 异步侧边栏登录/退出', 'redonleft-login')]
		);
	}

	public function widget($args, $instance) {
		if (!wp_script_is('redonleft-login-js','enqueued')) {\RedonleftLogin\Assets::enqueue_frontend();}
		echo $args['before_widget'];
		$this->render_widget();
		echo $args['after_widget'];
	}
	
	public function form($instance) {
		$title = $instance['title'] ?? __('Login', 'redonleft-login');
		?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
		</p>
		<?php
	}

	public function update($new_instance,$old_instance) {
		return ['title'=>sanitize_text_field($new_instance['title'])];
	}
	
	public function render_widget() {
		if (!is_user_logged_in()) {
			?>
			<ul class="redonleft-login-widget" data-widget-id="<?php echo esc_attr($this->id); ?>">
				<form class="redonleft-login-form" onsubmit="return false;">
					<p><input autocomplete="off" type="text" name="username" placeholder="<?php esc_attr_e('用户名','redonleft-login'); ?>" required></p>
					<p><input type="password" name="password" placeholder="<?php esc_attr_e('密码','redonleft-login'); ?>" required></p>
					<p><label><input type="checkbox" name="remember"> <?php esc_html_e('记着我','redonleft-login'); ?></label></p>
					<p><button type="button" class="redonleft-login-submit"><?php esc_html_e('登录','redonleft-login'); ?></button></p>
					<div class="redonleft-login-message" role="status" aria-live="polite"></div>
				</form>
			</ul>
			<?php
		} else {
			$user = wp_get_current_user();
			?>
			<ul class="redonleft-login-widget" data-widget-id="<?php echo esc_attr($this->id); ?>">
				<div class="redonleft-login-hello">
					<p>见到你真好，<?php echo esc_html($user->display_name); ?></p>
				</div>
				<div class="redonleft-login-profile">
					<div class="redonleft-login-avatar"><?php echo get_avatar($user->ID,80); ?></div>
					<div class="redonleft-login-meta">
						<div class="redonleft-login-post"><a herf="<?php echo esc_url( admin_url( 'post-new.php' ) ); ?>"><?php esc_html_e('写作','redonleft-login'); ?></a></div>
						<div class="redonleft-login-links"><a href="<?php echo esc_url(admin_url()); ?>"><?php esc_html_e('仪表盘','redonleft-login'); ?></a></div>
						<p><button type="button" class="redonleft-logout-button"><?php esc_html_e('注销','redonleft-login'); ?></button></p>
					</div>
				</div>
			</ul>
			<?php
		}
	}
}
