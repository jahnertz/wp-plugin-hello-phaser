<?php
/**
 * @package hello-phaser
 * @version 1.0.1
/*
Plugin Name: hello-phaser
Plugin URI: https://github.com/jahnertz/wp-plugin-hello-phaser 
Description: A simple implementation of the Phaser game library in a Wordpress plugin.
Author: Jordan Han
Version: 1.0.1
Author URI: https://jhanrahan.com.au
*/

define( 'HELLO_PHASER__DEBUG_MODE', true );
define( 'HELLO_PHASER__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'HELLO_PHASER__PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'HELLO_PHASER__OPTIONS', 'hello_phaser_options' );

require_once( HELLO_PHASER__PLUGIN_DIR . 'class.hello-phaser.php' );

$hello_phaser = new Hello_Phaser;
add_action( 'init', array( &$hello_phaser, 'init' ), 1 );
