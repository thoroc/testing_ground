$( function() {
    //  Called when page is first loaded or refreshed
    get_hash();

    //  Looks for changes in the URL hash
    $(window).bind('hashchange', function() {
        get_hash();
    });

    //  Called when we click on the tab itself
    $('.tabs_wrapper ul li').click(function() {
        var tab_id = $(this).children('a').attr('rel');

        //  Update the hash in the url
        window.location.hash = tab_id;

        //  Do nothing when tab is clicked
        return false;
    });
});

//  Main function that shows and hides the requested tabs and their content
function set_tab( tab_container_id, tab_id ) {
    //  Remove class "active" from currently active tab
    $( '#' + tab_container_id + ' ul li' ).removeClass( 'active' );

    //  Now add class "active" to the selected/clicked tab
    $( '#' + tab_container_id + ' a[rel="' + tab_id + '"]' ).parent().addClass( "active" );

    //  Hide contents for all the tabs.
    //  The '_content' part is merged with tab_container_id and the result
    //  is the content container ID.
    //  For example for the original tabs: tab_container_id + '_content' = original_tabs_content
    $( '#' + tab_container_id + '_content .tab_content' ).hide();

    //  Show the selected tab content
    $( '#' + tab_container_id + '_content #' + tab_id ).fadeIn();
}


//  Function that gets the hash from URL
function get_hash() {
    if( window.location.hash ) {
        //  Get the hash from URL
        var url = window.location.hash;

        //  Remove the #
        var current_hash = url.substring(1);

        //  Split the IDs with comma
        var current_hashes = current_hash.split(",");

        //  Loop over the array and activate the tabs if more then one in URL hash
        $.each( current_hashes, function( i, v ) {
            set_tab( $( 'a[rel="' + v + '"]' ).parent().parent().parent().attr( 'id' ), v );
        });
    }
}