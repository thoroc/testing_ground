
var fonts = [
    "CiscoSansTTBold",
    "CiscoSansTTBoldOblique",
    "CiscoSansTTCondensedBold",
    "CiscoSansTTCondensedBoldOblique",
    "CiscoSansTTCondensedExtraLight",
    "CiscoSansTTCondensedExtraLightOblique",
    "CiscoSansTTCondensedHeavy",
    "CiscoSansTTCondensedHeavyOblique",
    "CiscoSansTTCondensedLight",
    "CiscoSansTTCondensedLightOblique",
    "CiscoSansTTCondensedOblique",
    "CiscoSansTTCondensedRegular",
    "CiscoSansTTCondensedThin",
    "CiscoSansTTCondensedThinOblique",
    "CiscoSansTTExtraLight",
    "CiscoSansTTExtraLightOblique",
    "CiscoSansTTHeavy",
    "CiscoSansTTHeavyOblique",
    "CiscoSansTTLight",
    "CiscoSansTTLightOblique",
    "CiscoSansTTRegular",
    "CiscoSansTTRegularOblique",
    "CiscoSansTTThin",
    "CiscoSansTTThinOblique",
    /* language specific */
    "CiscoSansTTCHS-Regular",
    "CiscoSansTTCHT-Regular",
    "CiscoSansTTGlobal-Regular",
    "CiscoSansTTJPN-Regular",
    "CiscoSansTTKOR-Regular",
    "CiscoSansTTLatin-Regular",
    "CiscoSansTTME-Regular",
    "CiscoSansTTThai-Regular"
];

var pathname = window.location.pathname;

$( function() {
    populatePage( fonts );
    createIndex( fonts );

    $( 'input[type=checkbox]' ).on( 'click', function() {
        var target = $( this ).attr( 'data-target' );
        var e = $( '#' + target );
        ( e.attr( 'class' ) === target ) ?
            e.removeClass( target ) :
            e.addClass( target );
    });
});

function  createIndex( data  ) {
    var list = $( '<ul/>', {
        'class': 'list'
    }).appendTo( '.nav' );
    $.each( data, function( i, d ) {
        var id = d.replace( 'CiscoSansTT', '' );
        var item = $( '<li/>', {
        }).appendTo( '.list' );
        $( '<a/>', {
            'href': pathname + '#' + id,
            'text': d
        }).appendTo( item );
    });
};

function populatePage( data ) {
    $.each( data, function( i, d ){
        var str = '';
        var arr = d.split(/(?=[A-Z])/);
        var id = d.replace( 'CiscoSansTT', '' );
        for( i in arr ) {
            str += arr[i] + ' ';
        }
        $.trim( str );
        var container = $( '<div/>', {
            'class': 'container',
            'data-origin': d,
            'id': id
        }).appendTo( '.body' );
        var label = $( '<div/>', {
            'class': 'label',
            'text': str
        }).appendTo( container );
        var input = $( '<input/>', {
            'type': 'checkbox',
            'data-target': d,
            'checked': true
        }).appendTo( label );
        var content = $( '<div/>', {
            'class': 'content'
        }).appendTo( container );
        var p = $( '<p/>', {
            'data-lorem': '1p',
            'class': d,
            'id': d
        }).appendTo( content );
    });
};