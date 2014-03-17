$.fn.textWidth = function() {
    var e = $( this );
    var original = e.html();

    var node = $( '<span/>', {
        'position': 'absolute',
        'width': 'auto',
        'left': '-9999px',
        'font-family': e.css( 'font-family' ),
        'font-size': e.css( 'font-size' ),
        'html': original
    }).appendTo( 'body' );

  var width = node.width();
  node.remove();

  return width;
};

$.fn.thAutoWidth = function() {
    var header = $( this );
    var table = $( header ).closest( 'table' );

    header.each( function() {
        $( this ).css( 'width', table.width() / header.length );
    });
};