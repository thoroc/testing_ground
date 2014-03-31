
var fonts = [
    "CiscoSansTTBoldOblique",
    "CiscoSansTTBold",
    "CiscoSansTT-CondensedBoldOblique",
    "CiscoSansTT-CondensedBold",
    "CiscoSansTT-CondensedExtraLightOblique",
    "CiscoSansTT-CondensedExtraLight",
    "CiscoSansTT-CondensedHeavyOblique",
    "CiscoSansTT-CondensedHeavy",
    "CiscoSansTT-LightOblique",
    "CiscoSansTTCondensedLight",
    "CiscoSansTT-CondensedOblique",
    "CiscoSansTT-Condensed",
    "CiscoSansTT-CondensedThinOblique",
    "CiscoSansTT-CondensedThin",
    "CiscoSansTTExtraLightOblique",
    "CiscoSansTTExtraLight",
    "CiscoSansTTHeavyOblique",
    "CiscoSansTTHeavy",
    "CiscoSansTTLightOblique",
    "CiscoSansTTLight",
    "CiscoSansTTCHS-Regular",
    "CiscoSansTTCHT-Regular",
    "CiscoSansTTGlobal-Regular",
    "CiscoSansTTJPN-Regular",
    "CiscoSansTTKOR-Regular",
    "CiscoSansTTLatin",
    "CiscoSansTTME-Regular",
    "CiscoSansTTRegularOblique",
    "CiscoSansTTThai-Regular",
    "CiscoSansTTRegular",
    "CiscoSansTTThinOblique",
    "CiscoSansTTThin"
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
        var item = $( '<li/>', {
        }).appendTo( '.list' );
        $( '<a/>', {
            'href': pathname + '#' + d,
            'text': d
        }).appendTo( item );

    });
};

function populatePage( data ) {
    $.each( data, function( i, d ){
        var container = $( '<div/>', {
            'class': 'container',
            'data-origin': d
        }).appendTo( '.body' );
        var label = $( '<div/>', {
            'class': 'label',
            'text': d
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