<?php

main();


function main()
{
    $value = ( $_SERVER['REQUEST_METHOD'] === 'POST' )? $_POST['color']: null;
    $fnct = $value !== null? call_user_func( $value ): null;

    render( $fnct );
}

function red()
{
    return 'red';
}

function blue()
{
    return 'blue';
}

function render( $option = null )
{
    $content = $option !== null? 'you have selected ' . $option: 'No choice has been made yet';
    $content .= '<div style="background: ' . $option . '">';
    $content .= '<form method="POST">';
    $content .= '<select name="color">';
    $content .= '<option name="color[red]"';
    if( $option === 'red' )
    {
        $content .= ' selected="selected"';
    }
    $content .= '>red</option>';

    $content .= '<option name="color[blue]"';
    if( $option === 'blue' )
    {
        $content .= ' selected="selected"';
    }
    $content .= '>blue</option>';
    $content .= '</select>';
    $content .= '<input type="submit" value="set">';
    $content .= '</form>';
    $content .= '</div>';

    echo $content;
}

function debug( $values )
{
    $values = is_array( $values )? $values: array( $values );
    echo '<pre>';
    print_r( $values );
    echo '</pre>';
    die();
}