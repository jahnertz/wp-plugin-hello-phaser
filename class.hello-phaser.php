<?php
 class Hello_Phaser {

	private static $debug_messages;

	public function init () {
		// TODO: include Phaser library
		$options = get_option( HELLO_PHASER__OPTIONS );
		isset( self::$debug_messages ) ?: ( $debug_messages = array() );
		isset( $options[ 'initiated' ] ) ?: ( $this->initiate() );
	}

	public function initiate () {
		$options = get_option( HELLO_PHASER__OPTIONS );
		$options[ 'initiated' ] = true;
		update_option( HELLO_PHASER__OPTIONS, $options );
	}

	public static function debug ( $message ) {
		array_push( self::$debug_messages, $message );
	}
}
