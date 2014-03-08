/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$( document ).ready( function() {
    getStructure( './index/script/fileStructure.php' );
//    getStructure( './index/script/json-data.php' );



    $( '#success' ).load( './index/script/not-here.php', function( response, status, xhr ) {
      if ( status == 'error') {
        var msg = 'Sorry but there was an error: ';
        $( '#error' ).html( msg + xhr.status + ' ' + xhr.statusText );
      }
    });
});

function getStructure( filename ) {
    var DOMElement = $( '#structrure' );
    $.ajax({
         type: 'GET',
         url: filename,
         async: false,
         beforeSend: function( x ) {
            if( x && x.overrideMimeType ) {
                x.overrideMimeType( 'application/j-son;charset=UTF-8' );
            }
        },
        dataType: 'json',
        success: function( data ) {
           console.log( data );
           $.each( data, function( i, d ) {
               $( '<p/>', {
                   'name': i,
                   'text': d
               }).appendTo( DOMElement )
           });
        }
    });

//    console.log( filename );
//    console.log( DOMElement );
}