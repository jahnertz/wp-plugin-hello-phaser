// TODO: make this an object so it can be instanced.

var config = {
	// type: Phaser.AUTO,
	width: 800,
	height: 600,
	parent: localized.parent_id,
	physics: {
		default: 'arcade',
		arcade: {
			gravity: { y: 200 }
		}
	},
	scene: {
		preload: preload,
		create: create
	}
};

var game = new Phaser.Game( config );

function preload () {
	// TODO: this variable should be set with php:
	// this.load.setBaseURL( HELLO_PHASER__SRC_URL );
	this.load.setBaseURL( 'http://dev.unknwn.asia/wp-content/plugins/wp-plugin-hello-phaser/src/' );
	this.load.image( 'sky', 'assets/skies/wtf.png' );
	this.load.image( 'logo', 'assets/sprites/phaser3-logo.png' );
	this.load.image( 'particle', 'assets/sprites/particle1.png' );
}

function create () {
	this.add.image( 400, 300, 'sky' );
	var particles  = this.add.particles( 'particle' );
	var emitter = particles.createEmitter ( {
		speed: 100,
		scale: { start: 1, end: 0 },
		blendMode: 'ADD'
	} );
	var logo = this.physics.add.image( 400, 100, 'logo' );
	logo.setVelocity( 100, 200 );
	logo.setBounce( 1, 1 );
	logo.setCollideWorldBounds( true );
	emitter.startFollow( logo );
}