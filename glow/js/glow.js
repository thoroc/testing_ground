/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

!function( $ ) {
    $( function() {
        window.prettyPrint && prettyPrint();

    } );
}( window.jQuery );

$( document ).ready( function() {
    //             method to get an element to change backgound
    //             http://stackoverflow.com/questions/11398333/jquery-pulsate-effect
    $( ".confirm_selection_1" ).click( function( e ) {
        e.preventDefault();
        for( var i = 0; i < 3; i++ ) {
            $( "#contactColumn" )
                    .animate( {backgroundColor: "#f00"}, 2000 )
                    .animate( {backgroundColor: "transparent"}, 2000 );
        }
    });

    //             method to glow constantly (1)
    //             http://stackoverflow.com/questions/7061420/how-do-i-animate-a-glowing-effect-on-text
    var glow = $( '.confirm_selection_3' );
    setInterval( function() {
        glow.hasClass( 'glow' ) ? glow.removeClass( 'glow' ) : glow.addClass( 'glow' );
    }, 1000 );

    //             method to glow on hover (2)
    //             http://stackoverflow.com/questions/7061420/how-do-i-animate-a-glowing-effect-on-text
    $( ".confirm_selection_5" ).hover( function() {
        $( this ).animate( {
            color: "red"
        }, 2000 );
    }, function() {
        $( this ).animate( {
            color: "black"
        }, 2000 );
    });
});
