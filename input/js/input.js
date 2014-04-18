$( function() {
    $( '#btn_show' ).on( 'click', function() {
        show_checked()
    });

    $( '#btn_on' ).on( 'click', function() {
        set_checked( true );
    });

    $( '#btn_off' ).on( 'click', function() {
        set_checked( false );
    });

    $( "#isCheck" ).click( function() {
        alert( $( 'input:checkbox[name=checkme]' ).is( ':checked' ) );
    });

    $( "#checkIt" ).click( function() {
        $( 'input:checkbox[name=checkme]' ).prop( 'checked', true );
        $( 'input:checkbox[name=checkme]' ).attr( 'checked', true );
    });

    $( "#UnCheckIt" ).click( function() {
        $( 'input:checkbox[name=checkme]' ).prop( 'checked', false );
        $( 'input:checkbox[name=checkme]' ).attr( 'checked', false );
    });

    $( 'input[name=test]' ).click( function() {
        $( 'input[name=controle]' ).val( $( this ).is(':checked') ? 'foo' : 'baa' );
    });
});

function show_checked() {
    window.alert( $( 'input[name=foo]' ).is( ':checked' ) );
}

function set_checked( checked ) {
    $( 'input[name=foo]' ).attr( 'checked', checked );
}