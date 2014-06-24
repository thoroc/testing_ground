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
		//plugin name - animatemenu
		animateMenu: function( options ) {

			//Settings list and the default values
			var defaults = {
				animatePadding: 60,
				defaultPadding: 10,
				evenColor: '#ccc',
				oddColor: '#eee'
			};

			var options = $.extend( defaults, options );

    		return this.each( function() {
				var o = options;

				//Assign current element to variable, in this case is UL element
				var obj = $( this );

				//Get all LI in the UL
				var items = $( "li", obj );

				//Change the color according to odd and even rows
				$( "li:even", obj ).css( 'background-color', o.evenColor );
			 	$( "li:odd", obj ).css( 'background-color', o.oddColor );

				//Attach mouseover and mouseout event to the LI
				items.mouseover(function() {
					$(this).animate({ paddingLeft: o.animatePadding }, 300 );

				}).mouseout( function() {
					$( this ).animate({ paddingLeft: o.defaultPadding }, 300 );
				});
    		});
    	}
    });
})( jQuery );
