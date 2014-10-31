<?php
function randomColor() {
    $str = '#';
    for($i = 0 ; $i < 6 ; $i++) {
        $randNum = rand(0 , 15);
        switch ($randNum) {
            case 10: $randNum = 'A'; break;
            case 11: $randNum = 'B'; break;
            case 12: $randNum = 'C'; break;
            case 13: $randNum = 'D'; break;
            case 14: $randNum = 'E'; break;
            case 15: $randNum = 'F'; break;
        }
        $str .= $randNum;
    }
    return $str;
}

function generateRandomColor() {

    // random number between 0 and 10,000,000
    // rand( 0, 10000000 )
    //
    // string hex representation of rand
    // dechex( rand( ... ) )
    //
    // capitalize string
    // strtoupper( ... )
    //
    // string length
    // strlen( ... )
    //
    // pad a string with another string up to the second arg supplied
    // str_pad( arg1, arg2, arg3, arg4 )

    $randomcolor = '#' . strtoupper(dechex(rand(0,10000000)));
    if (strlen($randomcolor) != 7){
        $randomcolor = substr(str_pad($randomcolor, 10, '0', STR_PAD_RIGHT),0,7);
//        $randomcolor = substr($randomcolor,0,7);
    }
    return $randomcolor;
}

echo "===> randomColor <===</br>";
$color = randomColor();
echo '<span style="color:' . $color . '">Random color: ' . $color . '</span></br>';
$color = randomColor();
echo '<span style="color:' . $color . '">Random color: ' . $color . '</span></br>';
$color = randomColor();
echo '<span style="color:' . $color . '">Random color: ' . $color . '</span></br>';
$color = randomColor();
echo '<span style="color:' . $color . '">Random color: ' . $color . '</span></br>';
$color = randomColor();
echo '<span style="color:' . $color . '">Random color: ' . $color . '</span></br>';
$color = randomColor();
echo '<span style="color:' . $color . '">Random color: ' . $color . '</span></br>';
$color = randomColor();
echo '<span style="color:' . $color . '">Random color: ' . $color . '</span></br>';

echo "===> generateRandomColor <===</br>";
$color = generateRandomColor();
echo '<span style="color:' . $color . '">Random color: ' . $color . '</span></br>';
$color = generateRandomColor();
echo '<span style="color:' . $color . '">Random color: ' . $color . '</span></br>';
$color = generateRandomColor();
echo '<span style="color:' . $color . '">Random color: ' . $color . '</span></br>';
$color = generateRandomColor();
echo '<span style="color:' . $color . '">Random color: ' . $color . '</span></br>';
$color = generateRandomColor();
echo '<span style="color:' . $color . '">Random color: ' . $color . '</span></br>';
$color = generateRandomColor();
echo '<span style="color:' . $color . '">Random color: ' . $color . '</span></br>';
$color = generateRandomColor();
echo '<span style="color:' . $color . '">Random color: ' . $color . '</span></br>';