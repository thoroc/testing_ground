<?php

echo '<h3>Split a string of caseId as an array</h3>';


$string = "'332206', '294014', '335051', '313910', '326393', '333605', '329819', '330193', '337994', '325161'";

echo '<div>the string: ' . $string . '</div>';

$array = explode( ", ", str_replace( "'", "", $string ));

echo 'the array: </div>';
foreach( $array as $value )
{
    echo '<div>' . $value . '</div>';
}