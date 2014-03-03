<?php

const INTEGER = " an integer!";
const NUMBER = " a number!";

$var1 = "12345";
$var2 = 12345;

function IsValidNumber1( $number )
{
    return  is_int( $number ) ?
            $number . ' is' . INTEGER :
                ( is_numeric( $number ) ?
                $number . ' is' . NUMBER :
                $number . ' is neither' . INTEGER . ' nor' . NUMBER );
            ;
}

function IsValidNumber2( $number )
{
    return  is_int( $number ) ?
            $number . ' is' . INTEGER :
                is_numeric( $number ) ?
                $number . ' is' . NUMBER :
                $number . ' is neither' . INTEGER . ' nor' . NUMBER ;
            ;
}

function IsValidNumber3( $number )
{
    if ( is_int( $number ) )
    {
        return $number . ' is' . INTEGER;
    }
    else
    {
        if ( is_numeric( $number ))
        {
            return $number . ' is' . NUMBER;
        }
        else
        {
            return $number . ' is neither' . INTEGER . ' nor' . NUMBER;
        }
    }
    return 'foo';
}

function displayResult( $value )
{
    echo 'variable: ' . $value . ' of type ' . gettype( $value ) . '<br />';
    echo 'IsValidNumber1: ' . IsValidNumber1( $value ) . '<br />';
    echo 'IsValidNumber2: ' . IsValidNumber2( $value ) . '<br />';
    echo 'IsValidNumber3: ' . IsValidNumber3( $value ) . '<br />';
}

displayResult( $var1 ); echo '<br />';
displayResult( $var2 );