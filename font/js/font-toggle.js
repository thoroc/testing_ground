
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

$( function() {
    populatePage( fonts );
});

function populatePage( data ){
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
            'data-target': d
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