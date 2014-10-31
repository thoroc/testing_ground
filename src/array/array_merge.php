<?php

echo '<h3>array_merge</h3>';

$cars1 = array(
    array( 'name' => 'fiesta', 'brand' => 'ford'),
    array( 'name' => 'focus', 'brand' => 'ford'),
    array( 'name' => 'serie 3', 'brand' => 'bmw'),
    array( 'name' => 'serie 5', 'brand' => 'bmw'),
    array( 'name' => '500', 'brand' => 'fiat'),
    array( 'name' => 'punto', 'brand' => 'fiat'),
    array( 'name' => 'golf', 'brand' => 'vw'),
    array( 'name' => 'passat', 'brand' => 'vw'),
    array( 'name' => 'polo', 'brand' => 'vw'),
    array( 'name' => 'yaris', 'brand' => 'toyota'),
    array( 'name' => 'corolla', 'brand' => 'toyota'),
    array( 'name' => 'corsa', 'brand' => 'opel'),
    array( 'name' => 'astra', 'brand' => 'opel'),
    array( 'name' => 'clio', 'brand' => 'renault'),
    array( 'name' => 'megane', 'brand' => 'renault'),
    array( 'name' => '207', 'brand' => 'peugeot'),
    array( 'name' => 'Qashqai', 'brand' => 'nissan'),
    array( 'name' => 'Panda', 'brand' => 'fiat'),
    array( 'name' => 'Octavia', 'brand' => 'skoda'),
    array( 'name' => 'C3', 'brand' => 'citroen'),
    array( 'name' => 'C Class', 'brand' => 'mercedes'),
    array( 'name' => 'Fabia', 'brand' => 'skoda'),
    array( 'name' => 'A1', 'brand' => 'audi'),
    array( 'name' => 'Giulietta', 'brand' => 'alfa romeo'),
    array( 'name' => 'mini', 'brand' => 'mini'),
    array( 'name' => 'DS 5', 'brand' => 'citroen'),
);

$cars2 = array(
    array( 'name' => 'fiesta', 'class' => 'compact' ),
    array( 'name' => 'focus', 'class' => 'compact' ),
    array( 'name' => 'serie 3', 'class' => 'compact' ),
    array( 'name' => 'serie 5', 'class' => 'compact' ),
    array( 'name' => '500', 'class' => 'compact' ),
    array( 'name' => 'punto', 'class' => 'compact' ),
    array( 'name' => 'golf', 'class' => 'compact' ),
    array( 'name' => 'passat', 'class' => 'compact' ),
    array( 'name' => 'polo', 'class' => 'compact' ),
    array( 'name' => 'yaris', 'class' => 'compact' ),
    array( 'name' => 'corolla', 'class' => 'compact' ),
    array( 'name' => 'corsa', 'class' => 'compact' ),
    array( 'name' => 'astra', 'class' => 'compact' ),
    array( 'name' => 'clio', 'class' => 'compact' ),
    array( 'name' => 'megane', 'class' => 'compact' ),
    array( 'name' => '207', 'class' => 'compact' ),
    array( 'name' => 'Qashqai', 'class' => 'compact' ),
    array( 'name' => 'Panda', 'class' => 'compact' ),
    array( 'name' => 'Octavia', 'class' => 'compact' ),
    array( 'name' => 'C3', 'class' => 'compact' ),
    array( 'name' => 'C Class', 'class' => 'compact' ),
    array( 'name' => 'Fabia', 'class' => 'compact' ),
    array( 'name' => 'A1', 'class' => 'compact' ),
    array( 'name' => 'Giulietta', 'class' => 'compact' ),
    array( 'name' => 'mini', 'class' => 'compact' ),
    array( 'name' => 'DS 5', 'class' => 'compact' ),
);

function array_assoc_merge( $arr1, $arr2 )
{
    /**
     * 1. get keys from $arr1
     * 2. get keys from $arr2
     *
     *
     *
     */
    $keys1 = array_keys( $arr1 );
    $keys2 = array_keys( $arr2 );

    foreach( $arr1 as $e )
    {
        foreach( $e as $k => $v )
        {

        }
    }
}

//$data = $cars1 + $cars2 ;
//$data = array_merge( $cars1, $cars2 );

$data = array_reduce(array_keys($cars1), function($c, $x) use ($cars1)
{
    $c[$x] = isset($c[$x])
       ?array_merge((array)$c[$x], [$cars1[$x]])
       :$cars1[$x];
    return $c;
}, $cars2);

//print_r( $result );

echo '<div>';
foreach( $data as $car )
{
    echo '<div>';
    foreach( $car as $key => $value )
    {
        echo '<span>' . $key . ': ' . $value . '</span>';
    }
    echo '</div>';
}
echo '</div>';