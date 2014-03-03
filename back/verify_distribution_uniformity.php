<?php

echo '<h3>Verify distribution uniformity/Chi-squared test</h3>';


$vehicles = array(
    array( 'id' => 1, 'name' => 'fiesta', 'brand' => 'ford'),
    array( 'id' => 2, 'name' => 'focus', 'brand' => 'ford'),
    array( 'id' => 3, 'name' => 'serie 3', 'brand' => 'bmw'),
    array( 'id' => 4, 'name' => 'serie 5', 'brand' => 'bmw'),
    array( 'id' => 5, 'name' => '500', 'brand' => 'fiat'),
    array( 'id' => 6, 'name' => 'punto', 'brand' => 'fiat'),
    array( 'id' => 7, 'name' => 'golf', 'brand' => 'vw'),
    array( 'id' => 8, 'name' => 'passat', 'brand' => 'vw'),
    array( 'id' => 9, 'name' => 'polo', 'brand' => 'vw'),
    array( 'id' => 10, 'name' => 'yaris', 'brand' => 'toyota'),
    array( 'id' => 11, 'name' => 'corolla', 'brand' => 'toyota'),
    array( 'id' => 12, 'name' => 'corsa', 'brand' => 'opel'),
    array( 'id' => 13, 'name' => 'astra', 'brand' => 'opel'),
    array( 'id' => 14, 'name' => 'clio', 'brand' => 'renault'),
    array( 'id' => 15, 'name' => 'megane', 'brand' => 'renault'),
    array( 'id' => 16, 'name' => '207', 'brand' => 'peugeot'),
    array( 'id' => 17, 'name' => 'Qashqai', 'brand' => 'nissan'),
    array( 'id' => 18, 'name' => 'Panda', 'brand' => 'fiat'),
    array( 'id' => 19, 'name' => 'Octavia', 'brand' => 'skoda'),
    array( 'id' => 20, 'name' => 'C3', 'brand' => 'citroen'),
    array( 'id' => 21, 'name' => 'C Class', 'brand' => 'mercedes'),
    array( 'id' => 22, 'name' => 'Fabia', 'brand' => 'skoda'),
    array( 'id' => 23, 'name' => 'A1', 'brand' => 'audi'),
    array( 'id' => 24, 'name' => 'Giulietta', 'brand' => 'alfa romeo'),
    array( 'id' => 25, 'name' => 'mini', 'brand' => 'mini'),
    array( 'id' => 26, 'name' => 'DS 5', 'brand' => 'citroen'),
);

// populate $brands array
$brands = array();
foreach ( $vehicles as $vehicle )
{
    if( !array_key_exists( $vehicle['brand'], $brands ) )
    {
        $brands[$vehicle['brand']] = array( $vehicle['name'] );

    }
    else
    {
        if( !in_array( $vehicle['name'], $vehicle['brand']) )
        {
            array_push( $brands[$vehicle['brand']], $vehicle['name'] );
        }
    }
}

// add 'range' key and populate new array from $vehicles array
$result = array();
foreach( $vehicles as $vehicle )
{
    // reproduce the vehicles array
    $row = array();
    foreach ( $vehicle as $key => $value )
    {
        $row[$key] = $value;
    }
    if( array_key_exists( $vehicle['brand'], $brands ) )
    {
        $row['range'] = $brands[ $vehicle['brand'] ];

    }
    $result[] = $row;
}

//echo '<pre>';
//print_r( $result );
//echo '</pre>';

echo '  <table style="border: solid;">
            <thead>
                <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>brand</th>
                    <th>range</th>
                </tr>
            </thead>
            <tbody>';

// diplay all values from $result array
foreach ( $result as $vehicle )
{
    echo '<tr>';
    echo '<td>' . $vehicle['id'] . '</td>';
    echo '<td>' . $vehicle['name'] . '</td>';
    echo '<td>' . $vehicle['brand'] . '</td>';
    echo '<td>';
    foreach( $vehicle['range'] as $value )
    {
        echo $value . ', ';
    }
    echo '</td>';

    echo '</tr>';
}

echo '      </tbody>
        </table>';


//foreach ( $brands as $key => $value )
//{
//    echo '<div>';
//    echo $key . ' has the following range: ';
//    foreach ( $value as $car )
//    {
//        echo $car . ', ';
//    }
//    echo '</div>';
//}

?>