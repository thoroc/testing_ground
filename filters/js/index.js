var filterSelection = {};

$( document ).ready( function() {

    GetData( 'data/bundesland.json' ).done( function( data ) {
        CreateAndPopulateSelect( data );
    });

    GetData( 'data/regierungsbezirke.json' ).done( function( data ) {
        CreateAndPopulateSelect( data );
    });

    GetData( 'data/kreis.json' ).done( function( data ) {
        CreateAndPopulateSelect( data );
    });

    GetData( 'data/bezirke.json' ).done( function( data ) {
        CreateAndPopulateSelect( data );
    });

    GetData( 'data/gemeinde.json' ).done( function( data ) {
        CreateAndPopulateSelect( data );
    });

    $( '.select-filter' ).each( function() {
        CreateAndAddResetBtn( $( this ).closest( 'div' ) );
        StoreSelectOptions( this );
    });

    $( '.select-filter' ).each( function() {
        SetSelectCollection( this );
    });

    $( '.select-filter' ).change( function() {
        SetSelectCollection( this );
    });

//                $( 'a.pop' ).click( function() {
//                    Populate( this );
//                });

    $( '.reset' ).click( function() {
        ResetSelector( this, null );
        $( 'select.' + $( this ).attr( 'data-target' ) )[0].selectedIndex = 0;
    });
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

function CreateAndPopulateSelect( dataset ) {
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

function CreateAndAddResetBtn( DOMElement ) {
    var resetBtn = jQuery( '<a/>', {
        'class': 'reset',
        'data-target': dataset.name,
        'text': 'x'
    }).appendTo( DOMElement );
}

function SetSelectCollection( DOMElement ) {
    var stateSelected = $( DOMElement ).val();
    var valueSelected = stateSelected ? true : false;
    var enables = $( DOMElement ).attr( 'data-enables' );
    enables = enables ? enables.split( ' ' ) : [ ];
    for( var it in enables ) {
        var element = $( 'select.' + enables[it] );
        if( element.attr( 'name' )) {
            if( element.prop( 'disabled' ) || !valueSelected ) {
//                console.log( element );
                ToggleDisableAttribute( 'select.' + enables[it], !valueSelected, true );
            }
        }
    }


    var limits = $( DOMElement ).attr( 'data-limits' );
    limits = limits ? limits.split( ' ' ) : [ ];
    for( var it in limits )
    {
        var data = {'name': limits[it]};
        if( valueSelected )
        {
            data['limited-by'] = $( ':selected', DOMElement ).val();
        }
        LimitSelectionTo( data );
    }
}

function LimitSelectionTo( data ) {
    var selector = $( 'select.' + data['name'] );
    var selection = filterSelection[data['name']];
    $( 'select.' + data['name'] ).empty();
    if( selection ) selector.append( selection.clone() );
    selector.find( 'optgroup, option' ).filter( function() {
        if( 1 != this.nodeType ) return true;
        var limitedBy = $( this ).attr( 'data-limited-by' );
        if( limitedBy && data['limited-by'] )
        {
            if( -1 == limitedBy.indexOf( data['limited-by'] ))
                return true;
        }
        return false;
    }).remove();
    CountOptions( selector );
}

function StoreSelectOptions( DOMElement ) {
    var name = $( DOMElement ).attr( 'name' );
    if( !filterSelection[name] ) {
        filterSelection[name] = {};
    }
    filterSelection[name] = $( DOMElement ).contents().clone();
}

function CountOptions( DOMElement ) {
    var name = $( DOMElement ).attr( 'name' );
    var count = $( DOMElement ).find( 'option' ).length - 1;
    var el = $( '.' + name + ' option:first' ).text();
    $( '.' + name + ' option:first' ).text( el + ' (' + count + ')' )
}

function ToggleDisableAttribute( selector, disable, reset ) {
    var resetBtn = $( selector ).next( 'a.reset' );
//                FsatFilter_toggleEventHandlerOverlay( selector, disable );
    $( selector )
            .prop( 'disabled', disable ? 'disabled' : false )
            .css( 'color', disable ? '#ddd' : '#555' );
    resetBtn.css( 'color', disable ? 'rgb(221, 221, 221)' : 'rgb(85, 85, 85)' );
    if( reset ) $( selector ).val( null );
}

function ResetSelector( DOMElement, ignoreElements ) {
    var groupArray = [];
    var selectArray = [];
    var selector = 'group-filter';
    // determine if the current select was set to its default value
    var reset = ( DOMElement.selectedIndex === 0 ) ? true : false;
    // find all the select element from the current group
    var group = $( DOMElement ).closest( selector ).find( 'select' );
    // check if select is first element or not in the group
    // the group contains 2 element right now
    if( $( group[0] ).is( $( DOMElement ) ) ) {
        selectArray.push( group[1] );
    }
    // get all groups and aggregate in an array
    $( DOMElement ).closest( selector )
            .nextAll( selector )
            .each( function() {
                groupArray.push( this );
            });
    // get all the select and aggregate in an array
    $( groupArray ).each( function() {
        $( this ).find( 'select' ).each( function() {
            selectArray.push( this );
        });
    });
    // reset the selected option to the default value
    $( selectArray ).each( function() {
        for( var el in ignoreElements ) {
            if( reset && $.inArray( $( this ).attr( 'name' ), ignoreElements[el] ) < 0 ) {
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


//            function Populate( DOMElement ) {
//                var value = $( DOMElement ).attr( 'data-value' );
//                var targetLabel = $( DOMElement ).attr( 'data-target' );
//                var targetElement = $( '#' + targetLabel );
//                var text = $( DOMElement ).text();
//                switch( value ) {
//                    case 'delete':
//                        targetElement.contents().remove();
//                        value = 'populate';
//                        text = 'Populate List';
//                        break;
//                    case 'populate':
//                        targetElement.append( filterSelection[targetLabel] );
//                        value = 'delete';
//                        text = 'Delete List';
//                        break;
//                    default:
//                        break;
//                }
//                $( DOMElement ).attr( 'data-value', value )
//                               .text( text );
//            }