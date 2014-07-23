<?php

/**
 * string comparison is doing an 'on-the-fly' char to int conversion !
 */

$date = '2014-04-29';
echo 'date = ' . $date . '<br/>';

if( $date >= '2013-04-28' )
{
    $date = 'Foo';
}
else
{
    $date = 'Baa';
}

echo 'date = ' . $date . '<br/>';