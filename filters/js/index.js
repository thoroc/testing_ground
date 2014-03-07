var filterSelection = {};
var dataFolder = 'data/';
var dataFileType = 'json';

$( document ).ready( function() {
    // populating the filters
    GetData( dataFolder + 'bundesland.' + dataFileType ).done( function( data ) {
        createSelect( data );
    });

    GetData( dataFolder + 'regierungsbezirke.' + dataFileType ).done( function( data ) {
        createSelect( data );
    });

    GetData( dataFolder + 'kreis.' + dataFileType ).done( function( data ) {
        createSelect( data );
    });

    GetData( dataFolder + 'bezirke.' + dataFileType ).done( function( data ) {
        createSelect( data );
    });

    GetData( dataFolder + 'gemeinde.' + dataFileType ).done( function( data ) {
        createSelect( data );
    });

//                $( 'a.pop' ).click( function() {
//                    Populate( this );
//                });


//    d = document.createElement( 'div' );
//    $( d ).addClass( 'rubbish' )
//        .html( 'sometext' )
//        .appendTo( $( '#test' )) //main div
//        .click( function() {
//            $( this ).remove();
//        })
//        .hide()
//        .slideToggle( 300 )
//        .delay( 2500 )
//        .slideToggle( 300 )
//        .queue( function() {
//            $( this ).remove();
//        });
});

$( document ).on( 'each', 'select.select-filter', function() {
    storeSelectOptions( this );
});

$( document ).on( 'each', 'select.select-filter', function() {
    setSelectCollection( this );
});


/**
 * Set the selectCollection on change event
 */
$( document ).on( 'change', 'select.select-filter', function() {
    setSelectCollection( this, true );
});

/**
 * reset the linked select on click event
 */
$( document ).on( 'click', 'a.reset', function() {
    resetSelector( this, null );
    $( 'select.' + $( this ).attr( 'data-target' ) )[0].selectedIndex = 0;
});

function GetData( filename ) {
    return $.getJSON( filename ).then( function( json ) {
        return {
            'name': json.name,
            'limits': json.limits,
            'enables': json.enables,
            'default': json.default,
            'value': json.data
        };
    });
}

function createSelect( dataset ) {
    var container = $( 'div.filters' );

    var divGroup = jQuery( '<div/>', {
        'class': 'group-filter',
    }).appendTo( container );

    var select = jQuery( '<select/>',  {
        'class': 'select-filter ' + dataset.name,
        'data-limits': dataset.limits,
        'data-enables': dataset.enables,
        'name': dataset.name
    }).appendTo( divGroup );

    $( '<a/>', {
        'class': 'reset',
        'data-target': select.attr( 'name' ),
        'text': 'x'
    }).appendTo( divGroup );

    var defaultValue = jQuery( '<option/>', {
        'value': '',
        'text': dataset.default
    }).appendTo( select );

    $.each( dataset.value, function( key, obj ) {
        if( depthOf( obj.value ) > 1 ) {
            var optgroup = jQuery( '<optgroup/>', {
                'data-name': key,
                'label': obj.label
            }).appendTo( select );
            $.each( obj.value, function( key, el ) {
                jQuery( '<option/>', {
                    'value': el.value,
                    'text': el.name,
                    'data-limited-by': el['limited-by']
                }).appendTo( optgroup );
            });
        } else {
            jQuery( '<option/>', {
                'value': obj.value,
                'text': obj.name,
                'data-limited-by': obj['limited-by']
            }).appendTo( select );
        }
    });
}

function setSelectCollection( selectorDOMElement, init ) {
//    countOptions( selectorDOMElement );
    var stateSelected = $( selectorDOMElement ).val();
    var valueSelected = stateSelected ? true : false;
    init = typeof init !== 'undefined' ? init : false;
    // Reset values depending on SELECT elements
    if( init ) {
        var reset = $( selectorDOMElement ).attr( 'data-reset' );
        reset = reset ? reset.split( ' ' ) : [ ];
    }

    // Enable/disable depending SELECT elements
    var enables = $( selectorDOMElement ).attr( 'data-enables' );
    enables = enables ? enables.split( ' ' ) : [ ];
    for( var it in enables ) {
        var resets = ( init ) ? ( $.inArray( enables[it], reset ) ? true : false ) : true ;
        var element = $( 'select.' + enables[it] );
        if( element.attr( 'name' )) {
            if( element.prop( 'disabled' ) || !valueSelected ) {
                toggleDisableAttribute( 'select.' + enables[it], !valueSelected, resets );
            }
        }
    }

    // Enable/disable incompatible SELECT elements
    var disables = $( selectorDOMElement ).attr( 'data-disables' );
    disables = disables ? disables.split( ' ' ) : [ ];
    for( var it in disables )
    {
        // valueSelected
        var resets = ( init ) ? ( $.inArray( enables[it], reset ) ? true : false ) : valueSelected ;
        if( $( 'select.' + disables[it] ).attr( 'name' ) )
        {
            toggleDisableAttribute( 'select.' + disables[it], valueSelected, resets );
        }
    }

    // Limit or reset OPTION tags of related SELECT elements
    // based on limited-by on Selected Element and closest limited-by-optgroup
    var limits = $( selectorDOMElement ).attr( 'data-limits' );
    limits = limits ? limits.split( ' ' ) : [ ];
    for( var it in limits )
    {
        var data = { 'name': limits[it] };
        if( valueSelected )
        {
//            data['limited-by'] = $( ':selected', selectorDOMElement ).val();
            data['limited-by'] = $.trim( $( ':selected', selectorDOMElement ).text() );
            var optgroup = $( ':selected', selectorDOMElement ).closest( 'optgroup' );
            var tagName = $( optgroup ).prop( 'tagName' );
            if( tagName && 'OPTGROUP' === tagName.toUpperCase() )
            {
                data['limited-by-optgroup'] = $.trim( optgroup.attr( 'data-name' ) );
            }
        }
        limitSelectionTo( data );
    }
}

function limitSelectionTo( data ) {
    var selector = $( 'select.' + data['name'] );
    var selection = filterSelection[data['name']];
    $( 'select.' + data['name'] ).empty();
    if( selection ) selector.append( selection.clone() );
    selector.find( 'optgroup, option' ).filter( function() {
        if( 1 !== this.nodeType ) return true;
        var limitedBy = $( this ).attr( 'data-limited-by' );
        if( limitedBy && data['limited-by'] )
        {
            if( -1 === limitedBy.indexOf( data['limited-by'] ))
                return true;
        }
        return false;
    }).remove();
    countOptions( selector );
}

function storeSelectOptions( selectorDOMElement ) {
    // Get name of selector
    var name = $( selectorDOMElement ).attr( 'name' );
    // Create index for it in global storage object if there isn't one yet
    if( !filterSelection[name] ) filterSelection[name] = {};
    // Store contents
    filterSelection[name] = $( selectorDOMElement ).contents().clone();
}

function countOptions( selectorDOMElement ) {
//    console.log( 'selectorDOMElement' );
//    console.log( selectorDOMElement );
    var name = $( selectorDOMElement ).attr( 'name' );
    var count = $( selectorDOMElement ).find( 'option' ).length - 1;
    var el = $( '.' + name + ' option:first' ).text();
    $( '.' + name + ' option:first' ).text( el + ' (' + count + ')' );
}

function toggleDisableAttribute( selector, disable, reset ) {
    var resetBtn = $( selector ).next( 'a.reset' );
//                FsatFilter_toggleEventHandlerOverlay( selector, disable );
    $( selector )
            .prop( 'disabled', disable ? 'disabled' : false )
            .css( 'color', disable ? '#ddd' : '#555' );
    resetBtn.css( 'color', disable ? 'rgb(221, 221, 221)' : 'rgb(85, 85, 85)' );
    if( reset ) $( selector ).val( null );
}

function resetSelector( selectorDOMElement, ignoreElements ) {
    var groupArray = [];
    var selectArray = [];
    var groupClass = '.group-filter';
    // find all the select element from the current group
    var filterGroup = $( selectorDOMElement ).closest( groupClass ).find( 'select' );
    console.log( selectorDOMElement );
    console.log( $( selectorDOMElement ).closest( groupClass ) );
    console.log( filterGroup );
    console.log( $( selectorDOMElement ).closest( groupClass ).find( 'select' )[0] );
//    console.log( $( filterGroup ) );
    // determine if the current select was set to its default value
    var isReset = ( null === $( filterGroup ).find( 'select' ).val() ) ? true : false;
//    var isReset = ( selectorDOMElement.selectedIndex === 0 ) ? true : false;
    console.log( isReset );
    // check if select is first element or not in the group
    // the group contains 2 element right now
    if( $( filterGroup[0] ).is( $( selectorDOMElement ) ) ) {
        selectArray.push( filterGroup[1] );
    }
    // get all groups and aggregate them in an array
    $( selectorDOMElement ).closest( groupClass )
            .nextAll( groupClass )
            .each( function() {
                groupArray.push( this );
            });
    // get all the select and aggregate them in an array
    $( groupArray ).each( function() {
        $( this ).find( 'select' ).each( function() {
            selectArray.push( this );
        });
    });
    // reset the selected option to the default value
    $( selectArray ).each( function() {
        for( var el in ignoreElements ) {
//            $( this ).val( null );
            if( isReset && $.inArray( $( this ).attr( 'name' ), ignoreElements[el] ) < 0 ) {
                this.selectedIndex = 0;
            }
        }
    });
}

// http://stackoverflow.com/questions/13523951/how-to-check-the-depth-of-an-object
// cause I am not that smart :p
function depthOf( object ) {
    var level = 1;
    var key;
    for(key in object) {
        if (!object.hasOwnProperty(key)) continue;

        if(typeof object[key] == 'object'){
            var depth = depthOf(object[key]) + 1;
            level = Math.max(depth, level);
        }
    }

    return level;
};