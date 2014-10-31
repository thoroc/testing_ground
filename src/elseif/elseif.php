<?php

$a = 5;
$b = 3;

echo 'value of $a: ' . $a . '<br>';
echo 'value of $b: ' . $b . '<br>';

if ($a > $b) {
    echo "a is bigger than b";
} elseif ($a == $b) {
    echo "a is equal to b";
} else {
    echo "a is smaller than b";
}

echo '<br />';

$simple = 'simpleroute';
$camel = 'simpleRoute';
$point = 'simple.route';

echo 'route1: ' . $simple . '<br>';
echo 'valide route1: ' . getValidRouteParameters( $simple ) . '<br />';
echo 'route2: ' . $camel . '<br>';
echo 'valide route2: ' . getValidRouteParameters( $camel ) . '<br />';
echo 'route3: ' . $point . '<br>';
echo 'valide route3: ' . getValidRouteParameters( $point ) . '<br />';


function getValidRouteParameters( $name )
{
    $pos = 0;
    while (($pos = strpos($name, '.', ++$pos)) !== false) {
        $name = substr($name, 0, $pos) . strtoupper(substr($name, $pos+1, 1)) . substr($name, $pos+2);
    }

    return $name;
}
?>