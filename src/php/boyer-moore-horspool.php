<?php
/**
 * @author: http://www.go4expert.com/forums/boyer-moore-string-matching-algorithm-t23040/
 */

define( 'UCHAR_MAX', 255 );

function boyermoore_horspool_memmem( $haystack,$needle )
{
    $hlen = strlen( $haystack );
    $nlen = strlen( $needle );
    $scan = 0;
    $bad_char_skip[UCHAR_MAX + 1];

    if ($nlen <= 0 || !$haystack || !$needle) { return NULL; }

    for( $scan = 0; $scan <= UCHAR_MAX; $scan = $scan + 1 )
    {
        $bad_char_skip[$scan] = $nlen;
    }

    $last = $nlen - 1;

    for( $scan = 0; $scan < $last; $scan = $scan + 1)
    {
        $bad_char_skip[$needle[$scan]] = $last - $scan;
    }

    while ($hlen >= $nlen)
    {
        for( $scan = $last; $haystack[$scan] == $needle[$scan]; $scan = $scan - 1 )
        {
            if( $scan == 0 ) { return $haystack; }
        }

        $hlen -= $bad_char_skip[$haystack[$last]];
        $haystack += $bad_char_skip[$haystack[$last]];
    }

    return NULL;
}