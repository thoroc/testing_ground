( function( $ ) {
    $.fn.extend({
        dashboard: function() {
            return this.each( function() {
            });
        },
        addWidget: function( title ) {
            var DOMElement = $( this );
        },
        addTimer: function() {
            var DOMElement = $( this );
            $( '<div/>', {
                id: 'countDown',
                class: 'widget'
            }).appendTo( DOMElement );
            $( '#countDown' ).flipcountdown();
        },
        addClock: function() {
            var DOMElement = $( this );
            var currentdate = new Date();
            var clock = $( '<div/>', {
                class: 'clock widget'
            }).appendTo( DOMElement );
            $( '<div/>', {
                text: currentdate.getTime()
            }).appendTo( clock );
        },
        addArticle: function( options ) {
			var defaults = {
                title: 'Article Title',
                length: '2',
                numberOfParagraphs: '2'
			};
			var options = $.extend( defaults, options );
            var DOMElement = $( this );
            var container = $( '<article/>', {
                class: 'widget'
            }).appendTo( DOMElement );
            $( '<h2/>', {
                text: options.title
            }).appendTo( container );
            for( var i = 0; i < options.numberOfParagraphs; i++ ) {
                $( '<p/>', {
                    attr: { 'data-lorem': options.length + 'p' },
                    class: 'wrapword'
                }).appendTo( container );
            }
        },
    });
})( jQuery );

$( function() {
    $( '.widget' ).hover( function() {
        var height = $( this ).height();
        var width = $( this ).width();

        console.log( height * 1.10 );
        console.log( width * 1.10 );

        $( this ).css( 'height', height * 1.10 );
    });
});