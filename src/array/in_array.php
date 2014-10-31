<?php

$languages = array(
    "Arabic",
    "Bahasa Indonesia",
    "Cantonese",
    "Czech",
    "Danish",
    "Dutch",
    "English",
    "French",
    "German",
    "Hungarian",
    
);


function getValidRouteParameters( $name )
{
    $pos = 0;
    while (($pos = strpos($name, '.', ++$pos)) !== false) {
        $name = substr($name, 0, $pos) . strtoupper(substr($name, $pos+1, 1)) . substr($name, $pos+2);
    }

    return $name;
}
?>