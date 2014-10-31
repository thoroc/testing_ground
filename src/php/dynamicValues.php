<?php

$dataset = array(
    array(
        'period'    => 'Global',
        'send'      => 597,
        'recieved'  => 160,
        'rate'      => 26.8
    ),
    array(
        'period'    => 'February',
        'send'      => 183,
        'recieved'  => 46,
        'rate'      => 25.14
    ),
    array(
        'period'    => 'March',
        'send'      => 193,
        'recieved'  => 52,
        'rate'      => 26.94
    ),
    array(
        'period'    => 'April',
        'send'      => 221,
        'recieved'  => 62,
        'rate'      => 28.05
    ),
);


//$array = array(
//    'period'    => 'Global',
//    'send'      => 597,
//    'recieved'  => 160,
//    'rate'      => 26.8
//);

$return = array();

foreach( $dataset as $data )
{
    foreach( $data as $key => $value )
    {
        $return[$key][] = $value;
    }
}


//foreach( $dataset as $_key => $_value )
//{
//    $return[$_key] = $_value;
//}

echo "<pre>";
print_r( $return );
echo "</pre>";