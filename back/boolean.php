<?php

echo '<h3>Boolean check</h3>';

$true = TRUE;
$false = FALSE;

$div = '<div>';
$_div = '</div>';

echo $div . 'TRUE: ' . $true . $_div;

echo $div . 'FALSE: ' . $false . $_div;

if( empty( $true ) )
{
    echo $div . 'TRUE IS EMPTY' . $_div;
}
else
{
    echo $div . 'TRUE NOT IS EMPTY' . $_div;
}
if( empty( $false ) )
{
    echo $div . 'FALSE IS EMPTY' . $_div;
}
else
{
    echo $div . 'FALSE NOT IS EMPTY' . $_div;
}