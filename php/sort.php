<?php
$input = array( 6, 5, 3, 1, 8, 7, 2, 4, 9, 0 );

//echoArray( $input, "input" );

function merge_sort( $arr )
{
    if( count( $arr ) <= 1 )
    {
        return $arr;
    }

    $left = array_slice( $arr, 0, ( int ) (count( $arr ) / 2) );
    $right = array_slice( $arr, ( int ) (count( $arr ) / 2) );

    $left = merge_sort( $left );
    $right = merge_sort( $right );

    $output = merge( $left, $right );

    return $output;
}

function merge( $left, $right )
{
    $result = array();

    while( count( $left ) > 0 && count( $right ) > 0 )
    {
        if( $left[0] <= $right[0] )
        {
            $result[] = $left[0];
            $left = shift( $left );
        }
        else
        {
            $result[] = $right[0];
            $right = shift( $right );
        }
    }
    array_splice( $result, count( $result ), 0, $left );
    array_splice( $result, count( $result ), 0, $right );

    return $result;
}
// 1, 2, 3, 4, 5, 6, 7, 8
$output = merge_sort( $input );

//echoArray( $output, "output" );

function shift( &$input = array()) {
    $output = array();
    foreach( $input as $k => $v ) {
        if( $k !== 0 ) {
            $output[$k-1] = $v;
        }
    }
    return $output;
}

//echoArray( $input );
//echoArray( array_splice( $input, count( $input ), 0, array( 56 ) ) );
//echoArray( remove( $input, count( $input ), 0, array( 56 ) ) );


function remove( $input, $index, $number, $replacement ) {
    $output = array();
    for( $i = $index; $i < $index; $i++ ) {
        $output[] = $input[$i];
    }
    return $output;
}

function echoArray( $arr = array(), $title = null )
{
    if( null !== $title )
    {
        echo "<h3>" . $title . "</h3>";
    }
    echo "<pre>{";
    foreach( $arr as $key => $value )
    {
        echo "<span>  [" . $key . "] => " . $value . "</span>  ";
    }
    echo "}</pre>";
}

$input = array("red", "green", "blue", "yellow");
echoArray($input);
array_splice($input, 2);
// $input is now array("red", "green")
echoArray($input);

$input = array("red", "green", "blue", "yellow");
echoArray($input);
array_splice($input, 1, -1);
// $input is now array("red", "yellow")
echoArray($input);

$input = array("red", "green", "blue", "yellow");
echoArray($input);
array_splice($input, 1, count($input), "orange");
// $input is now array("red", "orange")
echoArray($input);

$input = array("red", "green", "blue", "yellow");
echoArray($input);
array_splice($input, -1, 1, array("black", "maroon"));
// $input is now array("red", "green", "blue", "black", "maroon")
echoArray($input);

$input = array("red", "green", "blue", "yellow");
echoArray($input);
array_splice($input, 3, 0, "purple");
// $input is now array("red", "green", "blue", "purple", "yellow");
echoArray($input);

$input = array("red", "green", "blue", "yellow");
echoArray($input);
echoArray(array_splice($input, count($input), 0, array("purple", "brown")));
// $input is now array("red", "green", "blue", "yellow", "purple");
echoArray($input);


define(MIN, 1);
define(MAX, 9);
$list = array(4, 3, 5, 9, 7, 2, 4, 1, 6, 5);

function radix_sort(&$input)
{
    $temp = array();
	$len = count($input);

	// initialize with 0s
    $temp = array_fill(MIN, MAX-MIN+1, 0);

    foreach ($input as $key => $val) {
    	$temp[$val]++;
    }

    $input = array();
    foreach ($temp as $key => $val) {
	if ($val == 1) {
		$input[] = $key;
	} else {
		while ($val--) {
			$input[] = $key;
		}
	}
    }
}

// 4, 3, 5, 9, 7, 2, 4, 1, 6, 5
echoArray($list);

//radix_sort(&$list);

// 1, 2, 3, 4, 5, 5, 6, 7, 8, 9
echoArray($list);