<?php
 class Hello_Phaser {

	private static $debug_messages;
	public static $instances = 0;

	public function init () {
		// TODO: include Phaser library
		$options = get_option( HELLO_PHASER__OPTIONS );
		isset( self::$debug_messages ) ?: ( $debug_messages = array() );
		isset( $options[ 'initiated' ] ) ?: ( $this->initiate() );
		add_action( 'wp_enqueue_scripts', array( get_called_class(), 'register_user_scripts' ) );
		function hello_phaser_shortcode_func ( $atts ) {
			Hello_Phaser::$instances++; // increment instance number
			wp_enqueue_script( 'phaser' );
			$container_id = 'hello-phaser-container-' . Hello_Phaser::$instances;
			wp_localize_script( 'hello-phaser', 'localized', array( 'parent_id' => $container_id ) );
			wp_enqueue_script( 'hello-phaser' );
			$container = '<div id="' . $container_id . '"></div>';
			return $container;
		}
		add_shortcode( 'hello-phaser', 'hello_phaser_shortcode_func' );
	}

	public function initiate () {
		$options = get_option( HELLO_PHASER__OPTIONS );
		$options[ 'initiated' ] = true;
		update_option( HELLO_PHASER__OPTIONS, $options );
	}
	
	public static function register_user_scripts () {
			wp_register_script( 'phaser', HELLO_PHASER__PLUGIN_URL . 'node_modules/phaser/dist/phaser.min.js', array(), false );
			wp_register_script( 'hello-phaser', HELLO_PHASER__PLUGIN_URL . 'src/hello-phaser.js', array( 'phaser' ), false );
	}

	public static function debug ( $message ) {
		array_push( self::$debug_messages, $message );
	}
}
