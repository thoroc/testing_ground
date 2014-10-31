$( function() {
    $( document ).on( 'click', '.widget-list-link', function( e ) {
        $( '#fiscal_date_range_start' ).val( $( this ).attr( 'data-start' ) );
        $( '#fiscal_date_range_end' ).val( $( this ).attr( 'data-end' ) );
        e.preventDefault();
        $.each( $( '.widget-list-link.active' ), function() {
            $( this ).removeClass( 'active' );
        });
        $( this ).addClass( 'active' );

        return false;
    });
});

