<?php

$original1 = 'original_string';
$original2 = 'ORIGINAL STRING';

echo 'starting string: ' . $original1 . '<br />';
echo 'transformed string: ' . camelCasing( $original1 ) . '<br />';
echo 'position of underscore: ' . strpos( $original1, "_" ) . '<br />';
echo 'starting string: ' . $original2 . '<br />';
echo 'transformed string: ' . camelCasing( $original2 ) . '<br />';
echo 'position of containing underscore: ' . strpos( $original2, "_" ) . '<br />';

function camelCasing( $string )
{
        return ucwords( strtolower( str_replace( "_", " ", $string )));
//    $string = ( false !== strpos( $string, "_" )) ? str_replace( "_", " ", $string ) : $string ;
//    return ucwords( strtolower( $string ));
}