<?php
/**
 * @author: http://www.go4expert.com/forums/boyer-moore-string-matching-algorithm-t23040/
 */

define( 'ALPHABET_SIZE', 1 );

function compute_prefix( $str, $size, &$result = 0 )
{
    $result = $size + 1;
    $q;
    $k;
    $result[0] = 0;
    $k = 0;
    for( $q = 1; $q < $size; $q++ )
    {
        while( $k > 0 && $str[$k] != $str[$q] )
            $k = $result[$k - 1];

        if( $str[$k] == $str[$q] ) $k++;
        $result[$q] = $k;
    }
}

function prepare_badcharacter_heuristic( $str, $size, $result = ALPHABET_SIZE )
{
    $i = 0;
    for( $i = 0; $i < ALPHABET_SIZE; $i++ ) { $result[$i] = -1; }
    for( $i = 0; $i < $size; $i++ ) { $result[( int ) $str[$i]] = $i; }
}

function prepare_goodsuffix_heuristic( $normal, $size, &$result = 1 )
{
    $result = $size + 1;
    $left = ( string ) $normal;
    $right = $left + $size;
    $reversed[$size + 1];
    $tmp = $reversed + $size;
    $i;

    /* reverse string */
    $tmp = 0;
    while( $left < $right )
        $tmp = $left++;

    $prefix_normal[$size];
    $prefix_reversed[$size];

    compute_prefix( $normal, $size, $prefix_normal );
    compute_prefix( $reversed, $size, $prefix_reversed );

    for( $i = 0; $i <= $size; $i++ )
    {
        $result[$i] = $size - $prefix_normal[$size - 1];
    }

    for( $i = 0; $i < $size; $i++ )
    {
        $j = $size - $prefix_reversed[$i];
        $k = $i - $prefix_reversed[$i] + 1;

        if( $result[$j] > $k )
        {
            $result[$j] = $k;
        }
    }
}
/*
 * Boyer-Moore search algorithm
 */

function boyermoore_search( $haystack, $needle )
{
    /*
     * Calc string sizes
     */
//    $needle_len;
//    $haystack_len;
    $needle_len = strlen( $needle );
    $haystack_len = strlen( $haystack );

    /*
     * Simple checks
     */
    if( $haystack_len == 0 )
    {
        return NULL;
    }
    if( $needle_len == 0 )
    {
        return $haystack;
    }

    $badcharacter = array();
    $goodsuffix = array();
    /*
     * Initialize heuristics
     */
    $badcharacter[ALPHABET_SIZE];
    $goodsuffix[$needle_len + 1];

    prepare_badcharacter_heuristic( $needle, $needle_len, $badcharacter );
    prepare_goodsuffix_heuristic( $needle, $needle_len, $goodsuffix );

    /*
     * Boyer-Moore search
     */
    $s = 0;
    while( $s <= ( $haystack_len - $needle_len ))
    {
        $j = $needle_len;
        while( $j > 0 && $needle[$j - 1] == $haystack[$s + $j - 1] )
            $j--;

        if( $j > 0 )
        {
            $k = $badcharacter[( int ) $haystack[$s + $j - 1]];
            if( $k < ( int ) $j && ( $m = $j - $k - 1 ) > $goodsuffix[$j] ) { $s += $m; }
            else { $s += $goodsuffix[$j]; }
        }
        else
        {
            return $haystack + $s;
        }
    }

    return NULL;
}