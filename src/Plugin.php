<?php
namespace RedonleftLogin;

if (!defined( 'ABSPATH')){
	exit;
}

class Plugin {
	private static $instance = null;

	public static function get_instance() : self {
		if ( null === self::$instance ) self::$instance = new self();
		return self::$instance;
	}
	
	protected function __construct() {}
	
	public function run() {
		add_action( 'wp_enqueue_scripts', [ Assets::class, 'enqueue_frontend' ] );


		add_action( 'widgets_init', function() {
			register_widget( Widget\LoginWidget::class );
		});

		Ajax\LoginAjax::register();
	}
}
