<?php
 class Hello_Phaser {

	private static $debug_messages;

	public function init () {
		// TODO: include Phaser library
		$options = get_option( HELLO_PHASER__OPTIONS );
		isset( self::$debug_messages ) ?: ( $debug_messages = array() );
		isset( $options[ 'initiated' ] ) ?: ( $this->initiate() );
		add_action( 'wp_enqueue_scripts', array( get_called_class(), 'enqueue_user_scripts' ) );
		function hello_phaser_shortcode_func ( $atts ) {
			$script = '<div id="hello-phaser-container"></div><script src="' . HELLO_PHASER__PLUGIN_URL . 'src/hello-phaser.js" ></script>'; 
			return $script;
		}
		add_shortcode( 'hello-phaser', 'hello_phaser_shortcode_func' );
	}

	public function initiate () {
		$options = get_option( HELLO_PHASER__OPTIONS );
		$options[ 'initiated' ] = true;
		update_option( HELLO_PHASER__OPTIONS, $options );
	}

	public static function enqueue_user_scripts () {
			wp_register_script( 'phaser', HELLO_PHASER__PLUGIN_URL . 'node_modules/phaser/dist/phaser.min.js', array(), false );
			wp_register_script( 'hello-phaser', HELLO_PHASER__PLUGIN_URL . 'src/hello-phaser.js', array( 'phaser' ), false );
			wp_enqueue_script( 'phaser' );
			// wp_enqueue_script( 'hello-phaser' );
	}

	public static function debug ( $message ) {
		array_push( self::$debug_messages, $message );
	}
}
