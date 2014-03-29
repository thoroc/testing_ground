<?php

$roles = array( "SLC Audit Reviewer" );
$stringR = "Manager, SLC Audit Reviewer";

if(in_array($stringR, $roles) )
    echo 'geschaffen';
else
    echo 'FAIL';

echo '<h3>demonstration of array values</h3>';

//$array = array("size" => "XL", "color" => "gold");
//
//echo '<div>';
//foreach( $array as $key => $value )
//{
//    echo '<div>[' . $key . ']=>' . $value . '</div>';
//}
//echo '</div>';
//
//echo '<div>';
//foreach( array_values($array) as $key => $value )
//{
//    echo '<div>[' . $key . ']=>' . $value . '</div>';
//}
//echo '</div>';

$arrayValue = array(
    array( 1, "blue" ),
    array( 1, "red" ),
    array( 1, "yellow" ),
    array( 2, "purple" ),
    array( 2, "orange" ),
    array( 2, "green" ),
    array( 3, "custard brown" ),
    array( 3, "olive green" ),
    array( 3, "red tulip" ),
    array( 4, "super bright yellow" ),
);

// display $arrayValue
echo '<p>';
echo '<h4>$arrayValue</h4>';
foreach( $arrayValue as $e )
{
    echo '<div> array( ';
    foreach( $e as $key => $value )
    {
        echo '[' . $key . ']=>' . $value . ', ';
    }
    echo ' );</div>';
}
echo '</p>';

echo '<p>';
echo '<h4>Reduced $arrayValue</h4>';
foreach( reduce_array( $arrayValue ) as $e )
{
    echo '<div> array( ';
    foreach( $e as $key => $value )
    {
        if( is_integer( $value ))
        {
            echo '[' . $key . ']=>' . $value . ', ';
        }

        if( is_array( $value ))
        {
            echo '[' . $key . ']=>{ ';
            foreach( $value as $k => $v )
            {
                echo '[' . $k . ']=>' . $v . ', ';
            }
            echo ' }, ';
        }
    }
    echo ' );</div>';
}
echo '</p>';

function reduce_array( $array )
{
    $assoc = array();
    $count = count( $array );

    for( $index = 0; $index < $count; $index++ )
    {
        if( $assoc[$array[$index][0]]['id'] == $array[$index][0] )
        {
            $assoc[$array[$index][0]] = array(
                'id' => $array[$index][0],
                'value' => array_merge( $assoc[$array[$index][0]]['value'], array( $array[$index][1] )),
            );

        }
        else
        {
            $assoc[$array[$index][0]] = array(
                'id' => $array[$index][0],
                'value' => array( $array[$index][1] ),
            );
        }
        if( $assoc[$array[$index-1][0]]['id'] < $assoc[$array[$index][0]]['id'] && (isset( $assoc[$array[$index-1][0]]['id'] )) )
        {
//            echo $assoc[$array[$index-1][0]]['id'] . ' is smaller than ' . $assoc[$array[$index][0]]['id'] . '<br>';
            $assoc[$array[$index][0]] = array(
                'id' => $array[$index][0],
                'value' => array_merge( $assoc[$array[$index-1][0]]['value'], $assoc[$array[$index][0]]['value'] ),
            );
        }
    }

    return $assoc;
}

// concatenate the values in sub array from $arrayValue into strings

$ret = array_concatenate( $arrayValue );

echo '<p>';
echo '<h4>concatenated $arrayValue</h4>';
foreach( $ret as $key => $value )
{
    echo '<div>[' . $key . ']=>' . $value . '</div>';
}
echo '</p>';

// identify the key own values

echo '<p>';
echo '<h4>unique key values</h4>';
$keys = array_unique_keys( $ret );

foreach( $keys as $k => $v )
{
    echo '<div>';
    echo '[' . $k .'] => ' . $v;
    echo '</div>';
}
echo '</p>';


echo '<p>';
echo '<h4>compare keys</h4>';
echo_array( $arrayValue );
echo '</p>';

function array_concatenate( $array )
{
    $return = array();
    foreach( $array as $e )
    {
        $return[$e[0]] = ( array_key_exists($e[0], $return) ) ?
                        $return[$e[0]] . ', ' . $e[1] :
                        $e[1] ;
    }

    return $return;
}

function array_unique_keys( $array )
{
    return array_unique( array_keys( $array ));
}

function array_concatenate_plus( $array )
{
    $return = array();

    $keys; $values;

    foreach( $array as $element )
    {

    }

    return $return;
}

function echo_array( $array )
{
    echo '
    <div>
        <table>
            <thead>
                <tr>
                    <th>Index</th>
                    <th>Value</th>
                    <th>Prev</th>
                    <th>Next</th>
                    <th>total</th>
                </tr>
            </thead>
            <tbody>';

    for( $index = 0; $index < count( $array ); $index++ )
    {
        $prev = ( $index > 0 ) ? $index - 1 : null ;
        $next = ( $index < ( count( $array ) - 1 )) ? $index + 1 : null ;
        echo '
                <tr>
                    <td>' . $index . '</td>
                    <td>' . $array[$index] . '</td>
                    <td>' . $prev . '</td>
                    <td>' . $next . '</td>
                    <td>' . count( $array ) . '</td>
                </tr>';
    }
    echo '
            </tbody>
        </table>
    </div>';
}

?>