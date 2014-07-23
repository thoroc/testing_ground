//    var menuItems = $( '.fiscal_period_list' ).children( 'li' );
//    var div = menuItems.first().children( 'div' );
//    var pos = div.position();
//    var width = div.outerWidth();
//    var height = div.outerHeight();

    $( function() {
        var menuItems = $( '.fiscal_period_list' ).children( 'li' );
        var div = menuItems.first().children( 'div' );
        var pos = div.position();
        var width = div.outerWidth();
        var height = div.outerHeight();

        alignOptions( menuItems.first(), pos, height );
//                    console.log( pos, width, height );

        $( '.date_range' ).on( 'click', function( e ) {
            e.preventDefault();
            $( this ).parents( 'li' ).siblings( '.active' ).removeClass( 'active' );
            $( this ).parents( 'li' ).addClass( 'active' );
            alignOptions( this, pos, height );
        });

        $( document ).on( 'click', '.date_range', function( e ) {
            $( '#fiscal_date_range_start' ).val( $( this ).attr( 'data-start' ) );
            $( '#fiscal_date_range_end' ).val( $( this ).attr( 'data-end' ) );
            e.preventDefault();
            $( this ).siblings( '.current' ).removeClass( 'current' );
            $( this ).addClass( 'current' );

            return false;
        });
    });

    function alignOptions( e, p, h ) {
        var options = $( e ).closest( 'div' ).siblings( 'ul' );

        options.css({
            position: 'absolute',
            top: ( p.top + h ) + 'px',
            left: p.left + 'px'
        }).show();
    }


