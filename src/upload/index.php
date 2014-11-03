<?php
$title = 'upload';
$body = 'foo';

layout( $title, $body );
form( $title );

echo 'foo';

function render_template( $filename, $variables )
{
    extract( $variables );
    ob_start();
    require( __DIR__ . "/templates/" . $filename . ".php");
    $contents = ob_get_contents();
    ob_end_clean();

    return $contents;
}

function layout( $title, $body )
{
    return render_template( "layout", array( "title" => $title, "body" => $body ) );
}

function form( $title )
{
    return render_template( "form", array( "title" => $title ) );
}