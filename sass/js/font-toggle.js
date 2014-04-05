
var fonts = [
    "CiscoSansBold",
    "CiscoSansBoldOblique",
    "CiscoSansCondensedBold",
    "CiscoSansCondensedBoldOblique",
    "CiscoSansCondensedExtraLight",
    "CiscoSansCondensedExtraLightOblique",
    "CiscoSansCondensedHeavy",
    "CiscoSansCondensedHeavyOblique",
    "CiscoSansCondensedLight",
    "CiscoSansCondensedLightOblique",
    "CiscoSansCondensedOblique",
    "CiscoSansCondensedRegular",
    "CiscoSansCondensedThin",
    "CiscoSansCondensedThinOblique",
    "CiscoSansExtraLight",
    "CiscoSansExtraLightOblique",
    "CiscoSansHeavy",
    "CiscoSansHeavyOblique",
    "CiscoSansLight",
    "CiscoSansLightOblique",
    "CiscoSansRegular",
    "CiscoSansRegularOblique",
    "CiscoSansThin",
    "CiscoSansThinOblique",
    /* language specific */
    "CiscoSansRegularChineseSimplified",
    "CiscoSansRegularChineseTraditional",
    "CiscoSansRegularGlobal",
    "CiscoSansRegularJapanese",
    "CiscoSansRegularKorean",
    "CiscoSansRegularLatin",
    "CiscoSansRegularMe",
    "CiscoSansRegularThai"
];
var referenceString = 'The quick brown fox jumps over the lazy dog';
var string = "!\"#$%&amp;'()*+,-./0123456789:;&lt;=&gt;?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_`abcdefghijklmnopqrstuvwxyz{|}~¡¢£¤¥¦§¨©ª«¬­®¯°±²³´µ¶·¸¹º»¼½¾¿ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõö÷øùúûüýþÿĀāĂăĄąĆćĈĉĊċČčĎďĐđĒēĔĕĖėĘęĚěĜĝĞğĠġĢģĤĥĦħĨĩĪīĬĭĮįİıĲĳĴĵĶķĸĹĺĻļĽľĿŀŁłŃńŅņŇňŉŊŋŌōŎŏŐőŒœŔŕŖŗŘřŚśŜŝŞşŠšŢţŤťŦŧŨũŪūŬŭŮůŰűŲųŴŵŶŷŸŹźŻżŽžſƒǺǻǼǽǾǿȘșȚțȷˆˇˉ˘˙˚˛˜˝̣̒;΄΅Ά·ΈΉΊΌΎΏΐΑΒΓΔΕΖΗΘΙΚΛΜΝΞΟΠΡΣΤΥΦΧΨΩΪΫάέήίΰαβγδεζηθικλμνξοπρςστυφχψωϊϋόύώЀЁЂЃЄЅІЇЈЉЊЋЌЍЎЏАБВГДЕЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдежзийклмнопрстуфхцчшщъыьэюяѐёђѓєѕіїјљњћќѝўџѢѣѲѳѴѵҐґҒғҖҗҘҙҚқҜҝҠҡҢңҪҫҮүҰұҲҳҸҹҺһӀӋӌӏӘәӢӣӨөӮӯẀẁẂẃẄẅỲỳ‒–—―‗‘’‚‛“”„†‡•…‰′″‹›‼‾⁄⁰⁴⁵⁶⁷⁸⁹ⁿ₣₤₧€℅ℓ№™Ω℮⅓⅔⅛⅜⅝⅞←↑→↓↔↕↖↗↘↙↨∂∆∏∑−∕∙√∞∟∩∫≈≠≡≤≥⋆⌂⌐⌠⌡─│┌┐└┘├┤┬┴┼═║╒╓╔╕╖╗╘╙╚╛╜╝╞╟╠╡╢╣╤╥╦╧╨╩╪╫╬▀▄█▌▐░▒▓■□▪▫▬▯▲►▼◄◊○●◘◙◦☺☻☼♀♂♠♣♥♦♪♫ﬀﬁﬂﬃﬄ";
var pathname = window.location.pathname;
//var attributes = [ 'bold', 'oblique', 'regular', 'condensed', 'light', 'extra', 'heavy', 'thin' ];
var attributes;
var selectors;
var selectedAttr = [];

$( function() {
    var nav = $( '.nav' );
    var body = $( '.body' );
    var attr = $( '.font-attributes' );

    attributes = getAttributes( fonts, [ 'Cisco', 'Sans'] );

    populatePage( fonts, body );
    createIndex( fonts, nav );
    createAttributes( fonts, attr );

    selectors = $( '.list' ).children( 'li' );

    populateTest( selectedAttr );

    $( 'input[type=checkbox]' ).on( 'click', function() {
        var target = $( this ).attr( 'data-target' );
        var e = $( '#' + target );
        ( e.attr( 'class' ) === target ) ?
            e.removeClass( target ) :
            e.addClass( target );
    });

    $( 'a.toggle' ).on( 'click', function(){
        $( this ).toggleClass( 'active' );
        var text = $( this ).text();
        toggleAttributes( text );
        populateTest( selectedAttr );
    });
});

function toggleAttributes( targetName ) {
    $.each( selectors, function( i, d ) {
        var values = $( d ).attr( 'data-value' );
        var arr = values.split( ' ' );
        var a = $( d ).children( 'a' );
        console.log( targetName );
        console.log( arr );
        var str = targetName.toLowerCase()
        if( $.inArray( str, arr ) > -1
                && $.inArray( str, selectedAttr ) < 0 ) {
            selectedAttr.push( targetName.toLowerCase() );
            a.addClass( 'active' );
        } else {
            a.removeClass( 'active' );
        }
    });
}

function createIndex( data, DOMElement  ) {
    var ul = $( '<ul/>', {
        'class': 'list'
    }).appendTo( DOMElement );
    $.each( data, function( i, d ) {
        var id = d.replace( 'CiscoSans', '' );
        var li = $( '<li/>', {
            'data-value': splitName( d, 'CiscoSans' ).toLowerCase()
        }).appendTo( ul );
        $( '<a/>', {
            'href': pathname + '#' + id,
            'text': d,
            'class': 'action active'
        }).appendTo( li );
    });
};

function getAttributes( data, ignore ) {
    var ret = [];
    $.each( data, function( i, d ) {
        var arr = d.split(/(?=[A-Z])/);
        $.each( arr, function( k, v ) {
            if( $.inArray( v, ret ) < 0 && $.inArray( v, ignore ) < 0 ) {
                ret.push( v );
            }
        });
    });

    return ret;
}


function createAttributes( data, DOMElement ) {
    var ul = $( '<ul/>' ).appendTo( DOMElement );
    $.each( attributes, function( i, d ) {
        var li = $( '<li/>', {
            'class': 'font-attribute'
        }).appendTo( ul );
        $( '<a/>', {
            'href': '#',
            'text': d,
            'data-target': d.toLowerCase(),
            'class': 'toggle active'
        }).appendTo( li );
    });
}

function populatePage( data, DOMElement ) {
    $.each( data, function( i, d ){
        var container = $( '<div/>', {
            'class': 'container',
            'data-origin': d,
            'id': d.replace( 'CiscoSans', '' )
        }).appendTo( DOMElement );
        var label = $( '<div/>', {
            'class': 'label',
            'text': splitName( d, 'CiscoSans' )
        }).appendTo( container );
        var input = $( '<input/>', {
            'type': 'checkbox',
            'data-target': d,
            'checked': true
        }).appendTo( label );
        var contentType = $( '<div/>', {
            'class': 'content'
        }).appendTo( container );
        var p = $( '<p/>', {
            'text': string,
            'class': d,
            'id': d
        }).appendTo( contentType );
        var separator = $( '<div/>', {
            'class': 'line-separator'
        }).appendTo( container );
        var contentRef = $( '<div/>', {
            'class': 'content'
        }).appendTo( container );
        var ref = $( '<p/>', {
            'class': 'reference',
            'text': referenceString
        }).appendTo( contentRef );
    });
};

function populateTest( data ) {
    var test = $( '#test' );
    var str = '';
    $.each( data, function( i, d ){
        str += d;
    });

    test.text( str );
}

function splitName( data, removeStr ) {
    var str = '';
    var id = data.replace( removeStr, '' );
    var arr = id.split(/(?=[A-Z])/);
    for( i in arr ) {
        str += arr[i] + ' ';
    }
    $.trim( str );

    return str;
}