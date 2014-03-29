$( document ).ready( function() {
    // set the default value
    $( '#click-value' ).text( $( '.highlight' ).text() );
    // get the default value
    var defaultValue = $( '#click-value' ).text();

    // set values for cells in 'Class' column
    $( '.content-class' ).each( function() {
        $( this ).readClass();
    });

    $( '.action' ).on( 'click', function() {
        var actionElement = $( this );
        // toggle active on this element
        actionElement.toggleClass( 'active' );
        // get all the actions
        var actions = actionElement.findColumnSiblings( '.action' );
        // toggle active on siblings
        $.each( actions, function() {
            if( $( this ).hasClass( 'active' ) ) {
                $( this ).toggleClass( 'active' );
            }
        });
        // get the element for the Value
        var valueElement = $( '#' + actionElement.attr( 'data-origin' ));
        // toggle highligh on this element
        valueElement.toggleClass( 'highlight' );
        // get all the values
        var values = valueElement.findColumnSiblings( '.content' );
        // toggle active on siblings
        $.each( values, function() {
            if( $( this ).hasClass( 'highlight' ) ) {
                $( this ).toggleClass( 'highlight' );
            }
        });
        $( '.content-class' ).each( function() {
            $( this ).readClass();
        });
        var result = '' !== $( '.highlight' ).text() ? $( '.highlight' ).text() : defaultValue;
        $( '#click-value' ).text( result );
    });
});

$.fn.readClass = function() {
    var element = $( this ).closest( 'div' );
    var targetElement = $( '#' + element.attr( 'data-origin' ) );
    element.text( targetElement.attr( 'class' ) );
};

$.fn.findColumnSiblings = function( className ) {
    var element = $( this )[0];
    var name = null !== className ? className : element.attr( 'class' );
    var actions = $( name );
    var siblings = [];
    $.each( actions, function() {
        if( this !== element ) { siblings.push( this ); }
    });
    return siblings;
};