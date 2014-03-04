/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Example of a json data tree for skyrim mods
 *
 * @type type
 */
var exampleData = {
    "name": "tools",
    "data": {
        "": {
            "step": "",
            "name": "",
            "alias": "",
            "url": "",
            "description": "",
            "desc-more": [],
            "quality": "",
            "dlc": {},
            "filename": "",
            "version": "",
            "type": "",
            "note": "",
            "note-more": [],
            "order": ""
        }
    }
};

var tableHeader = [
    "package",
    "name",
    "nexus hosted",
    "description",
    "quality",
    "dlc requirement",
    "filename",
    "version",
    "file type",
    "notes",
    "load order"
];

//var datafiles = [ 'tools', 'extenders', 'fixesnote' ];
var dataFiles = [ 'tools', 'extenders' ];

$( document ).ready( function() {
    $.each( dataFiles, function( id, name) {
        getData( 'data/' + name + '.json' ).done( function( data ) {
            populateTable( data, name );
        });
    });
});

function getData( filename ) {
    return $.getJSON( filename ).then( function( json ) {
        return {
            'name': json.name,
            'data': json.data
        };
    });
}

function getTableHeader( DOMElement ) {
    var thead = $( '<thead/>' ).appendTo( DOMElement );
    var tr = $( '<tr/>' ).appendTo( thead );
    $.each( tableHeader, function( id, label ) {
        var th = $( '<th/>', {
            'text': label,
            'class': 'row-header'
        }).appendTo( tr );
        if( id === 0 ) {
            th.addClass( 'cell-first' );
        }
        if( id === ( tableHeader.length - 1 )) {
            th.addClass( 'cell-last' );
        }
    });
}

function getModList( dataset, DOMElement, name ) {
    var tbody = $( '<tbody/>', {}).appendTo( DOMElement );
    $.each( dataset.data, function( id, mod ) {
        var tr = $( '<tr/>', { 'id': name + '-' + id }).appendTo( tbody );
        var td = $( '<td/>' ).appendTo( tr );
        var span = $( '<span/>', { 'text': mod.step, 'class': 'label' }).appendTo( td );
        switch( span.text() ) {
            case 'core':
                span.addClass( 'label-primary' );
                break;
            case 'extended':
                span.addClass( 'label-success' );
                break;
            case 'optional':
                span.addClass( 'label-info' );
                break;
        }
        var td = $( '<td/>' ).appendTo( tr );
        $( '<a/>', {
            'href': mod.url,
            'text':  "" !== mod.alias ? mod.alias : mod.name
        }).appendTo( td );
        if( "" !== mod.alias ) {
            td.attr( 'title', mod.name );
        }
        var td = $( '<td/>' ).appendTo( tr );
        var span = $( '<span/>', { 'class': 'glyphicon' }).appendTo( td );
        if( mod.url.match( /nexus/g ) ) {
            span.addClass( 'glyphicon-ok' );
        }
        td = $( '<td/>', { 'text': mod.description, 'class': 'long-text', 'title': mod.description }).appendTo( tr );
        $( '<td/>', { 'text': mod.quality }).appendTo( tr );
        $( '<td/>', { 'text': mod.dlc }).appendTo( tr );
        $( '<td/>', { 'text': mod.filename }).appendTo( tr );
        $( '<td/>', { 'text': mod.version }).appendTo( tr );
        $( '<td/>', {'text': mod.type }).appendTo( tr );
        td = $( '<td/>', { 'text': mod.note, 'class': 'long-text', 'title': mod.note }).appendTo( tr );
        $( '<td/>', { 'text': mod.order }).appendTo( tr );
    });
}

function populateTable( data, name ) {
//    console.log( data );
    addDivider( $( '#tables' ), name );
    var div = $( '<div/>', {
        'id': name
    }).appendTo( '#tables' );
    var table = $( '<table/>', {
        'class': 'table table-condensed'
    }).appendTo( div );
    getTableHeader( table );
    getModList( data, table, name );
}

function addDivider( DOMElement, name ) {
    $( '<div/>', {
        'class': 'divider',
        'id': 'divider-' + name
    }).appendTo( DOMElement );
    var li = $( '<li/>' ).appendTo( $( '.dropdown-menu' ) );
    $( '<a/>', {
        'text': name,
        'href': '#divider-' + name
    }).appendTo( li );



}