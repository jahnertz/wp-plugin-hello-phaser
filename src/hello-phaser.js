var config = {
	type: Phaser.AUTO,
	width: 800,
	height: 600,
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
	// this needs to be pulled from wp_options:
	this.load.setBaseUrl( 'http://dev.unknwn.asia' );
	this.load.image( 'sky', 'assets/skies/space3.png' );
	this.load.image( 'logo', 'assets/sprites/red.png' );
}

function create () {
	this.add.image( 400, 300, 'sky' );

	var particles  = this.add.particles( 'red' );

	var emitter = particles.createEmitter ( {
		speed: 100;
		scale: { start: 1, end: 0 },
		blendMode: 'ADD'
	} );

	var logo = this.physics.add.image( 400, 100, 'logo' );

	logo.setVelocity( 100, 200 );
	logo.setBounce( 1, 1 );
	logo.setColliderWorldBounds( true );

	emitter.startFollow( logo );
}