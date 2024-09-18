var express = require( 'express' );
var http = require( 'http' );

var app = express();
var server = http.createServer( app );

const io = require('socket.io')(server, {
    cors: {
      origin: '*',
    }
  });

io.sockets.on( 'connection', function( client ) {
	console.log( "New client !" );	
	client.on( 'message', function( data ) {
		console.log( 'Message received ' + data.name + ":" + data.message + ":" + data.id_meja );	
		io.sockets.emit( 'message', { name: data.name, message: data.message, id_meja:data.id_meja } );
	});

    client.on( 'sentSound', function( data ) {
		console.log( 'Sound: ' + data.sound);
		io.sockets.emit( 'sentSound', { sound: data.sound, id_meja:data.id_meja, nomor_antrian_aktif:data.nomor_antrian_aktif} );
	});

	client.on( 'sentNomorAntrian', function( data ) {
		console.log( 'Nomor Antrian Aktif: ' + data.nomor_antrian_aktif +' : '+data.kode_meja);
		io.sockets.emit( 'sentNomorAntrian', { nomor_antrian_aktif: data.nomor_antrian_aktif, kode_meja:data.kode_meja} );
	});
 
});

server.listen( 3000 );