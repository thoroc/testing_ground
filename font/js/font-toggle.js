
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
        var id = d.replace( 'CiscoSans', '' );
        var item = $( '<li/>', {
        }).appendTo( list );
        $( '<a/>', {
            'href': pathname + '#' + id,
            'text': d
        }).appendTo( item );
    });
};

function populatePage( data ) {
    $.each( data, function( i, d ){
        var str = '';
        var id = d.replace( 'CiscoSans', '' );
        var arr = id.split(/(?=[A-Z])/);
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
        var contentType = $( '<div/>', {
            'class': 'content'
        }).appendTo( container );
        var p = $( '<p/>', {
//            'data-lorem': '1p',
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