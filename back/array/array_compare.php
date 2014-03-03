<?php

echo '<h3>demonstration of object range</h3>';


$touristtam = array(
    array( 'id' => 1, 'tank' => 'Löwe', 'type' => 'HT', 'nation' => 'DE', 'tier' => 8, 'battle' => 514, 'rate' => 50.39 ),
    array( 'id' => 2, 'tank' => 'KV-1', 'type' => 'HT', 'nation' => 'SU', 'tier' => 5, 'battle' => 423, 'rate' => 48.94 ),
    array( 'id' => 3, 'tank' => 'Marder II', 'type' => 'TD', 'nation' => 'DE', 'tier' => 3, 'battle' => 404, 'rate' => 64.85 ),
    array( 'id' => 4, 'tank' => 'Hummel', 'type' => 'SPG', 'nation' => 'DE', 'tier' => 6, 'battle' => 271, 'rate' => 51.29 ),
    array( 'id' => 5, 'tank' => 'Type 59', 'type' => 'MT', 'nation' => 'CN', 'tier' => 8, 'battle' => 241, 'rate' => 55.19 ),
    array( 'id' => 6, 'tank' => 'PzKpfw VI Tiger', 'type' => 'HT', 'nation' => 'DE', 'tier' => 7, 'battle' => 226, 'rate' => 55.31 ),
    array( 'id' => 7, 'tank' => 'T-150', 'type' => 'HT', 'nation' => 'SU', 'tier' => 6, 'battle' => 218, 'rate' => 40.83 ),
    array( 'id' => 8, 'tank' => 'KV-2', 'type' => 'HT', 'nation' => 'SU', 'tier' => 6, 'battle' => 193, 'rate' => 53.89 ),
    array( 'id' => 9, 'tank' => 'PzKpfw V Panther', 'type' => 'MT', 'nation' => 'DE', 'tier' => 7, 'battle' => 190, 'rate' => 60.53 ),
    array( 'id' => 10, 'tank' => 'M24 Chaffee', 'type' => 'LT', 'nation' => 'US', 'tier' => 5, 'battle' => 187, 'rate' => 52.41 ),
    array( 'id' => 11, 'tank' => 'PzKpfw 38H735 (f)', 'type' => 'LT', 'nation' => 'DE', 'tier' => 2, 'battle' => 182, 'rate' => 60.99 ),
    array( 'id' => 12, 'tank' => 'SU-100', 'type' => 'TD', 'nation' => 'SU', 'tier' => 6, 'battle' => 168, 'rate' => 54.76 ),
    array( 'id' => 13, 'tank' => 'VK 3601 (H)', 'type' => 'MT', 'nation' => 'DE', 'tier' => 6, 'battle' => 166, 'rate' => 57.23 ),
    array( 'id' => 14, 'tank' => 'M10 Wolverine', 'type' => 'TD', 'nation' => 'US', 'tier' => 5, 'battle' => 163, 'rate' => 59.51 ),
    array( 'id' => 15, 'tank' => 'Type-62', 'type' => 'LT', 'nation' => 'CN', 'tier' => 7, 'battle' => 152, 'rate' => 55.26 ),
    array( 'id' => 16, 'tank' => 'T-34-85', 'type' => 'MT', 'nation' => 'SU', 'tier' => 6, 'battle' => 139, 'rate' => 50.36 ),
    array( 'id' => 17, 'tank' => 'Dicker Max', 'type' => 'TD', 'nation' => 'DE', 'tier' => 6, 'battle' => 137, 'rate' => 48.91 ),
    array( 'id' => 18, 'tank' => 'M18 Hellcat', 'type' => 'TD', 'nation' => 'US', 'tier' => 6, 'battle' => 133, 'rate' => 57.14 ),
    array( 'id' => 19, 'tank' => 'Matilda Black Prince', 'type' => 'MT', 'nation' => 'GB', 'tier' => 5, 'battle' => 123, 'rate' => 59.35 ),
    array( 'id' => 20, 'tank' => 'M4A3E8 Sherman', 'type' => 'MT', 'nation' => 'US', 'tier' => 6, 'battle' => 122, 'rate' => 53.28 ),
    array( 'id' => 21, 'tank' => 'KV-3', 'type' => 'HT', 'nation' => 'SU', 'tier' => 7, 'battle' => 117, 'rate' => 61.54 ),
    array( 'id' => 22, 'tank' => 'S-51', 'type' => 'SPG', 'nation' => 'SU', 'tier' => 7, 'battle' => 109, 'rate' => 48.62 ),
    array( 'id' => 23, 'tank' => 'T29', 'type' => 'HT', 'nation' => 'US', 'tier' => 7, 'battle' => 109, 'rate' => 48.62 ),
    array( 'id' => 24, 'tank' => 'PzKpfw IV', 'type' => 'MT', 'nation' => 'DE', 'tier' => 5, 'battle' => 109, 'rate' => 54.13 ),
    array( 'id' => 25, 'tank' => 'PzKpfw II Luchs', 'type' => 'LT', 'nation' => 'DE', 'tier' => 4, 'battle' => 105, 'rate' => 55.24 ),
    array( 'id' => 26, 'tank' => 'IS', 'type' => 'HT', 'nation' => 'SU', 'tier' => 7, 'battle' => 104, 'rate' => 62.50 ),
    array( 'id' => 27, 'tank' => 'T49', 'type' => 'TD', 'nation' => 'US', 'tier' => 5, 'battle' => 103, 'rate' => 52.43 ),
    array( 'id' => 28, 'tank' => 'M5 Stuart', 'type' => 'LT', 'nation' => 'US', 'tier' => 4, 'battle' => 86, 'rate' => 48.84 ),
    array( 'id' => 29, 'tank' => 'T-43', 'type' => 'MT', 'nation' => 'SU', 'tier' => 7, 'battle' => 85, 'rate' => 58.82 ),
    array( 'id' => 30, 'tank' => 'MkVII Tetrarch', 'type' => 'LT', 'nation' => 'SU', 'tier' => 2, 'battle' => 85, 'rate' => 63.53 ),
    array( 'id' => 31, 'tank' => 'Churchill', 'type' => 'HT', 'nation' => 'SU', 'tier' => 5, 'battle' => 84, 'rate' => 63.10 ),
    array( 'id' => 32, 'tank' => 'T-50-2', 'type' => 'LT', 'nation' => 'SU', 'tier' => 5, 'battle' => 79, 'rate' => 49.37 ),
    array( 'id' => 33, 'tank' => 'M7', 'type' => 'MT', 'nation' => 'US', 'tier' => 5, 'battle' => 78, 'rate' => 48.72 ),
    array( 'id' => 34, 'tank' => 'AMX 13 75', 'type' => 'LT', 'nation' => 'FR', 'tier' => 7, 'battle' => 77, 'rate' => 59.74 ),
    array( 'id' => 35, 'tank' => 'Pz IV Schmalturm', 'type' => 'MT', 'nation' => 'DE', 'tier' => 6, 'battle' => 77, 'rate' => 57.14 ),
    array( 'id' => 36, 'tank' => 'PzKpfw II', 'type' => 'LT', 'nation' => 'DE', 'tier' => 2, 'battle' => 76, 'rate' => 48.68 ),
    array( 'id' => 37, 'tank' => 'PzKpfw III', 'type' => 'MT', 'nation' => 'DE', 'tier' => 4, 'battle' => 75, 'rate' => 54.67 ),
    array( 'id' => 38, 'tank' => 'T1 heavy', 'type' => 'HT', 'nation' => 'US', 'tier' => 5, 'battle' => 69, 'rate' => 47.83 ),
    array( 'id' => 39, 'tank' => 'T40', 'type' => 'TD', 'nation' => 'US', 'tier' => 4, 'battle' => 66, 'rate' => 51.52 ),
    array( 'id' => 40, 'tank' => 'T-28', 'type' => 'MT', 'nation' => 'SU', 'tier' => 4, 'battle' => 64, 'rate' => 54.69 ),
    array( 'id' => 41, 'tank' => 'M6', 'type' => 'HT', 'nation' => 'US', 'tier' => 6, 'battle' => 64, 'rate' => 54.69 ),
    array( 'id' => 42, 'tank' => 'AT-1', 'type' => 'TD', 'nation' => 'SU', 'tier' => 2, 'battle' => 63, 'rate' => 53.97 ),
    array( 'id' => 43, 'tank' => 'A-20', 'type' => 'LT', 'nation' => 'SU', 'tier' => 4, 'battle' => 63, 'rate' => 50.79 ),
    array( 'id' => 44, 'tank' => 'KV-5', 'type' => 'HT', 'nation' => 'SU', 'tier' => 8, 'battle' => 62, 'rate' => 46.77 ),
    array( 'id' => 45, 'tank' => 'KV-1S', 'type' => 'HT', 'nation' => 'SU', 'tier' => 6, 'battle' => 61, 'rate' => 49.18 ),
    array( 'id' => 46, 'tank' => 'T-34', 'type' => 'MT', 'nation' => 'SU', 'tier' => 5, 'battle' => 61, 'rate' => 57.38 ),
    array( 'id' => 47, 'tank' => 'BT-2', 'type' => 'LT', 'nation' => 'SU', 'tier' => 2, 'battle' => 58, 'rate' => 68.97 ),
    array( 'id' => 48, 'tank' => 'Leichttraktor', 'type' => 'LT', 'nation' => 'DE', 'tier' => 1, 'battle' => 57, 'rate' => 52.63 ),
    array( 'id' => 49, 'tank' => 'VK 1602 Leopard', 'type' => 'LT', 'nation' => 'DE', 'tier' => 5, 'battle' => 56, 'rate' => 66.07 ),
    array( 'id' => 50, 'tank' => 'Crusader', 'type' => 'LT', 'nation' => 'GB', 'tier' => 5, 'battle' => 56, 'rate' => 50.00 ),
);

$userfriendly = array(
    array( 'id' => 1, 'tank' => 'Löwe', 'type' => 'HT', 'nation' => 'DE', 'tier' => 8, 'battle' => 1308, 'rate' => 48.17 ),
    array( 'id' => 2, 'tank' => 'Type 59', 'type' => 'MT', 'nation' => 'CN', 'tier' => 8, 'battle' => 1054, 'rate' => 52.94 ),
    array( 'id' => 3, 'tank' => 'IS-3', 'type' => 'HT', 'nation' => 'SU', 'tier' => 8, 'battle' => 638, 'rate' => 45.45 ),
    array( 'id' => 4, 'tank' => 'T-54', 'type' => 'MT', 'nation' => 'SU', 'tier' => 9, 'battle' => 541, 'rate' => 48.98 ),
    array( 'id' => 5, 'tank' => 'PzKpfw 38H735 (f)', 'type' => 'LT', 'nation' => 'DE', 'tier' => 2, 'battle' => 426, 'rate' => 49.06 ),
    array( 'id' => 6, 'tank' => 'IS', 'type' => 'HT', 'nation' => 'SU', 'tier' => 7, 'battle' => 424, 'rate' => 48.58 ),
    array( 'id' => 7, 'tank' => 'IS-8', 'type' => 'HT', 'nation' => 'SU', 'tier' => 9, 'battle' => 398, 'rate' => 43.72 ),
    array( 'id' => 8, 'tank' => 'KV-1', 'type' => 'HT', 'nation' => 'SU', 'tier' => 5, 'battle' => 371, 'rate' => 45.55 ),
    array( 'id' => 9, 'tank' => 'E-75', 'type' => 'HT', 'nation' => 'DE', 'tier' => 9, 'battle' => 347, 'rate' => 51.87 ),
    array( 'id' => 10, 'tank' => 'T29', 'type' => 'HT', 'nation' => 'US', 'tier' => 7, 'battle' => 322, 'rate' => 57.14 ),
    array( 'id' => 11, 'tank' => 'Type-62', 'type' => 'LT', 'nation' => 'CN', 'tier' => 7, 'battle' => 287, 'rate' => 49.83 ),
    array( 'id' => 12, 'tank' => 'T-150', 'type' => 'HT', 'nation' => 'SU', 'tier' => 6, 'battle' => 271, 'rate' => 42.44 ),
    array( 'id' => 13, 'tank' => 'VK 3601 (H)', 'type' => 'MT', 'nation' => 'DE', 'tier' => 6, 'battle' => 240, 'rate' => 45.42 ),
    array( 'id' => 14, 'tank' => 'M103', 'type' => 'HT', 'nation' => 'US', 'tier' => 9, 'battle' => 214, 'rate' => 46.26 ),
    array( 'id' => 15, 'tank' => 'T34', 'type' => 'HT', 'nation' => 'US', 'tier' => 8, 'battle' => 213, 'rate' => 46.01 ),
    array( 'id' => 16, 'tank' => 'IS-7', 'type' => 'HT', 'nation' => 'SU', 'tier' => 10, 'battle' => 213, 'rate' => 50.23 ),
    array( 'id' => 17, 'tank' => 'T28', 'type' => 'TD', 'nation' => 'US', 'tier' => 8, 'battle' => 212, 'rate' => 49.53 ),
    array( 'id' => 18, 'tank' => 'Ram-II', 'type' => 'MT', 'nation' => 'US', 'tier' => 5, 'battle' => 212, 'rate' => 57.08 ),
    array( 'id' => 19, 'tank' => 'T110E5', 'type' => 'HT', 'nation' => 'US', 'tier' => 10, 'battle' => 210, 'rate' => 42.86 ),
    array( 'id' => 20, 'tank' => 'Matilda', 'type' => 'MT', 'nation' => 'SU', 'tier' => 5, 'battle' => 203, 'rate' => 58.62 ),
    array( 'id' => 21, 'tank' => 'Panther II', 'type' => 'MT', 'nation' => 'DE', 'tier' => 8, 'battle' => 196, 'rate' => 53.06 ),
    array( 'id' => 22, 'tank' => 'KV-1S', 'type' => 'HT', 'nation' => 'SU', 'tier' => 6, 'battle' => 180, 'rate' => 55.56 ),
    array( 'id' => 23, 'tank' => 'M26 Pershing', 'type' => 'MT', 'nation' => 'US', 'tier' => 8, 'battle' => 178, 'rate' => 52.25 ),
    array( 'id' => 24, 'tank' => 'PzKpfw IV', 'type' => 'MT', 'nation' => 'DE', 'tier' => 5, 'battle' => 177, 'rate' => 45.76 ),
    array( 'id' => 25, 'tank' => 'Matilda Black Prince', 'type' => 'MT', 'nation' => 'GB', 'tier' => 5, 'battle' => 174, 'rate' => 52.87 ),
    array( 'id' => 26, 'tank' => 'PzKpfw VIB Tiger II', 'type' => 'HT', 'nation' => 'DE', 'tier' => 8, 'battle' => 166, 'rate' => 51.81 ),
    array( 'id' => 27, 'tank' => 'A-20', 'type' => 'LT', 'nation' => 'SU', 'tier' => 4, 'battle' => 165, 'rate' => 52.12 ),
    array( 'id' => 28, 'tank' => 'PzKpfw III', 'type' => 'MT', 'nation' => 'DE', 'tier' => 4, 'battle' => 161, 'rate' => 48.45 ),
    array( 'id' => 29, 'tank' => 'M46 Patton', 'type' => 'MT', 'nation' => 'US', 'tier' => 9, 'battle' => 158, 'rate' => 47.47 ),
    array( 'id' => 30, 'tank' => 'T-34-85', 'type' => 'MT', 'nation' => 'SU', 'tier' => 6, 'battle' => 157, 'rate' => 43.31 ),
    array( 'id' => 31, 'tank' => 'T-34', 'type' => 'MT', 'nation' => 'SU', 'tier' => 5, 'battle' => 152, 'rate' => 43.42 ),
    array( 'id' => 32, 'tank' => 'VK 3002 (DB)', 'type' => 'MT', 'nation' => 'DE', 'tier' => 7, 'battle' => 143, 'rate' => 54.55 ),
    array( 'id' => 33, 'tank' => 'Hummel', 'type' => 'SPG', 'nation' => 'DE', 'tier' => 6, 'battle' => 140, 'rate' => 46.43 ),
    array( 'id' => 34, 'tank' => 'PzKpfw III Ausf. A', 'type' => 'LT', 'nation' => 'DE', 'tier' => 3, 'battle' => 134, 'rate' => 43.28 ),
    array( 'id' => 35, 'tank' => 'T62A', 'type' => 'MT', 'nation' => 'SU', 'tier' => 10, 'battle' => 134, 'rate' => 44.78 ),
    array( 'id' => 36, 'tank' => 'Leichttraktor', 'type' => 'LT', 'nation' => 'DE', 'tier' => 1, 'battle' => 121, 'rate' => 52.89 ),
    array( 'id' => 37, 'tank' => 'T-28', 'type' => 'MT', 'nation' => 'SU', 'tier' => 4, 'battle' => 120, 'rate' => 49.17 ),
    array( 'id' => 38, 'tank' => 'WZ-131', 'type' => 'LT', 'nation' => 'CN', 'tier' => 7, 'battle' => 120, 'rate' => 50.83 ),
    array( 'id' => 39, 'tank' => 'AMX 13 90', 'type' => 'LT', 'nation' => 'FR', 'tier' => 8, 'battle' => 109, 'rate' => 52.29 ),
    array( 'id' => 40, 'tank' => 'T71', 'type' => 'LT', 'nation' => 'US', 'tier' => 7, 'battle' => 105, 'rate' => 43.81 ),
    array( 'id' => 41, 'tank' => 'S-51', 'type' => 'SPG', 'nation' => 'SU', 'tier' => 7, 'battle' => 96, 'rate' => 45.83 ),
    array( 'id' => 42, 'tank' => 'T-34', 'type' => 'MT', 'nation' => 'CN', 'tier' => 5, 'battle' => 91, 'rate' => 57.14 ),
    array( 'id' => 43, 'tank' => 'T25 AT', 'type' => 'TD', 'nation' => 'US', 'tier' => 7, 'battle' => 90, 'rate' => 62.22 ),
    array( 'id' => 44, 'tank' => 'M5 Stuart', 'type' => 'LT', 'nation' => 'US', 'tier' => 4, 'battle' => 89, 'rate' => 56.18 ),
    array( 'id' => 45, 'tank' => 'T20', 'type' => 'MT', 'nation' => 'US', 'tier' => 7, 'battle' => 89, 'rate' => 55.06 ),
    array( 'id' => 46, 'tank' => 'Marder II', 'type' => 'TD', 'nation' => 'DE', 'tier' => 3, 'battle' => 87, 'rate' => 47.13 ),
    array( 'id' => 47, 'tank' => 'Cromwell', 'type' => 'MT', 'nation' => 'GB', 'tier' => 6, 'battle' => 85, 'rate' => 51.76 ),
    array( 'id' => 48, 'tank' => '59-16', 'type' => 'LT', 'nation' => 'CN', 'tier' => 6, 'battle' => 79, 'rate' => 53.16 ),
    array( 'id' => 49, 'tank' => 'Comet', 'type' => 'MT', 'nation' => 'GB', 'tier' => 7, 'battle' => 78, 'rate' => 61.54 ),
    array( 'id' => 50, 'tank' => 'E-50', 'type' => 'MT', 'nation' => 'DE', 'tier' => 9, 'battle' => 78, 'rate' => 39.74 ),
);

$compare = array();
$return =  false;

$empty1 = array(
    'id1' => $record1['id'],
    'tank1' => $record1['tank'],
    'type1' => $record1['type'],
    'nation1' => $record1['nation'],
    'tier1' => $record1['tier'],
    'battle1' => $record1['battle'],
    'rate1' => $record1['rate'],
);

$empty2 = array(
    'id2' => $record2['id'],
    'tank2' => $record2['tank'],
    'type2' => $record2['type'],
    'nation2' => $record2['nation'],
    'tier2' => $record2['tier'],
    'battle2' => $record2['battle'],
    'rate2' => $record2['rate'],
);

//$value = 'Matilda Black Prince'; //test value

$tanks = array();

foreach( $userfriendly as $record )
{
    if( !in_array( $record['tank'], $tanks))
    {
        $tanks[] = $record['tank'];
    }
}
foreach( $touristtam as $record )
{
    if( !in_array( $record['tank'], $tanks))
    {
        $tanks[] = $record['tank'];
    }
}

foreach( $userfriendly as $record1 )
{
    $value = $record1['tank'];

    $foo = array(
        'id1' => $record1['id'],
        'tank1' => $record1['tank'],
        'type1' => $record1['type'],
        'nation1' => $record1['nation'],
        'tier1' => $record1['tier'],
        'battle1' => $record1['battle'],
        'rate1' => $record1['rate'],
    );

    foreach( $touristtam as $id => $record2 )
    {
        $bar = array(
            'id2' => $record2['id'],
            'tank2' => $record2['tank'],
            'type2' => $record2['type'],
            'nation2' => $record2['nation'],
            'tier2' => $record2['tier'],
            'battle2' => $record2['battle'],
            'rate2' => $record2['rate'],
        );

        if( in_array( $value, $record2 ))
        {
            $compare[] = array_merge( $bar, $foo );
        }
    }
}
foreach( $touristtam as $record1 )
{
    $value = $record1['tank'];

    foreach( $userfriendly as $id => $record2 )
    {
        if( in_array( $value, $record2 ))
        {
            $compare[] = array_merge( $record1, $record2 );
        }
    }
}
echo $return;


//echo '<pre>';
//print_r( $result );
//echo '</pre>';

echo '  <table style="border: solid;">
            <thead>
                <tr>
                    <th colspan="7">touristtam</th>
                    <th colspan="7">userfriendly</th>
                </tr>
                <tr>
                    <th>id</th>
                    <th>tank</th>
                    <th>type</th>
                    <th>nation</th>
                    <th>tier</th>
                    <th>battle</th>
                    <th>win rate</th>
                    <th>id</th>
                    <th>tank</th>
                    <th>type</th>
                    <th>nation</th>
                    <th>tier</th>
                    <th>battle</th>
                    <th>win rate</th>
                </tr>
            </thead>
            <tbody>';

// diplay all values from $result array
foreach ( $compare as $value )
{
    echo '<tr>';
    echo '  <td>' . $value['id1'] . '</td>';
    echo '  <td>' . $value['tank1'] . '</td>';
    echo '  <td>' . $value['type1'] . '</td>';
    echo '  <td>' . $value['nation1'] . '</td>';
    echo '  <td>' . $value['tier1'] . '</td>';
    echo '  <td>' . $value['battle1'] . '</td>';
    echo '  <td>' . $value['rate1'] . '%</td>';
    echo '  <td>' . $value['id2'] . '</td>';
    echo '  <td>' . $value['tank2'] . '</td>';
    echo '  <td>' . $value['type2'] . '</td>';
    echo '  <td>' . $value['nation2'] . '</td>';
    echo '  <td>' . $value['tier2'] . '</td>';
    echo '  <td>' . $value['battle2'] . '</td>';
    echo '  <td>' . $value['rate2'] . '%</td>';

    echo '</tr>';
}

echo '      </tbody>
        </table>';

?>