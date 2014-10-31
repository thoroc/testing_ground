<?php

use TestingGround\ArrayManipulator as Manipulator;

namespace TestingGround;

echo 'foo';

$displayMe = array();

$array1 = array ( 'a' => 1, 'b' => 2, 'c' => 3, 'd' => 2, 'e' => 5, 'f' => 6 );
$array2 = array ( 'a' => 2, 'b' => 2, 'c' => 3, 'd' => 4, 'f' => 6, 'g' => 7 );
//$array2 = array ( 1, 2, 4, 3, 5 );
//$array2 = array ( '0' => 1);
$resultArray = Manipulator::array_merge_assoc($array1, $array2);
$resultArray = Manipulator::array_compare_assoc($array1, $array2);

$displayMe['array1'] = $array1;
$displayMe['array2'] = $array2;
$displayMe['array_values1'] = array_values($array1);
$displayMe['array_values2'] = array_values($array2);
$displayMe['array_keys1'] = array_keys($array1);
$displayMe['array_keys2'] = array_keys($array2);

$displayMe['array_diff_assoc:1-2'] = Manipulator::array_diff_assoc($array1, $array2);
$displayMe['array_diff_assoc:2-1'] = Manipulator::array_diff_assoc($array2, $array1);
$displayMe['array_intersect_assoc:1-2'] = Manipulator::array_intersect_assoc($array1, $array2);
$displayMe['array_intersect_assoc:2-1'] = Manipulator::array_intersect_assoc($array2, $array1);
$displayMe['array_diff_key:1-2'] = Manipulator::array_diff_key($array1, $array2);
$displayMe['array_diff_key:2-1'] = Manipulator::array_diff_key($array2, $array1);

$array_merge1 = array_merge($array1, $array2);
ksort($array_merge1);
$displayMe['array_merge:1-2'] = $array_merge1;
$array_merge2 = array_merge($array2, $array1);
ksort($array_merge2);
$displayMe['array_merge:2-1'] = $array_merge2;

$displayMe['array_intersect_key:1-2'] = Manipulator::array_intersect_key($array1, $array2);
$displayMe['array_intersect_key:2-1'] = Manipulator::array_intersect_key($array2, $array1);

$displayMe['array_keys:1'] = array_keys($array1);
$displayMe['array_keys:2'] = array_keys($array2);

$displayMe['array_intersect_keys'] = Manipulator::array_intersect_keys($array1, $array2);
$displayMe['array_diff_keys'] = Manipulator::array_diff_keys($array1, $array2);
$displayMe['array_union_keys'] = Manipulator::array_union_keys($array1, $array2);

$displayMe['array_remove1'] = Manipulator::array_remove($array1, 2);
$displayMe['array_remove2'] = Manipulator::array_remove($array2, 7);

echo '<pre>'; print_r( $displayMe ); echo '</pre>'; die(); exit;

class ArrayManipulator
{

    // TODO IMPLEMENT
    public static function array_compare_assoc( array $array1, array $array2 )
    {
        $result = array();

        $sameKey = array();
        $SameValue = array();
        $diffValue = array();
        $sameElement = array();
        $diffElement = array();

        foreach ( $array1 as $key => $value )
        {
    //            $item = array( $key => $value );
            // does key from $array1 exist in $array2 ?
            if ( array_key_exists( $key, $array2 ) )
            {
                // is value from $array[$key] equal to value from $array2[$key] ?
                if( $array1[ $key ] == $array2[ $key ] ) { $sameElement[ $key ] = $value; }
                else { $diffValue[ $key ] = $value; }
            }
            else
            {
                $diffElement[ $key ] = $value;
            }
        }

        $result[ 'sameElement' ] = $sameElement;
        $result[ 'sameKeyDiffValue' ] = $diffValue;
    //        $result['diffElement'] = \Cisco\AuditBundle\Debug\ArrayInspector::array_intersect_assoc( $array1, $array2 );
        $result[ 'originalArray' ] = $array1 + $array2;
    //        $result['originalArray'] = \Cisco\AuditBundle\Debug\ArrayInspector::array_merge_assoc( $array1, $array2 );
    //        echo '<pre>'; print_r( $result1 ); echo '</pre>'; die(); exit;

        return $result;
    }

    // TODO IMPLEMENT
    public static function array_merge_assoc( array $array1, array $array2 )
    {
        $newArray = array();

        // assume $array1 = ( a => 1, b => 2, c => 3) and $array2 = ( a => 2, b => 2, d => 1 )
        // get all keys from $array1 and $array2 as value for $arrayKeyAsValue
        // $arrayKeyAsValue = ( a, b, c, a, b, d )
        // foreach loop for $array1 -> $key, $value

        while ( list( $key, $value) = each( $array1 ) )
        {
            if ( array_key_exists( $key, $array2 ) ) { $newArray[ $key . '_1' ] = $value; }
            else { $newArray[ $key ] = $value; }
        }
        while ( list( $key, $value) = each( $array2 ) )
        {
            $newArray[ $key . '_2' ] = $value;
        }

        ksort( $newArray );

        return $newArray;
    }

    /**
     * Returns an array of values for keys contained in both arrays regardless
     * of their relative values in the original arrays
     *
     * @param array $array1
     * @param array $array2
     * @return array
     */
    public static function array_intersect_keys( array $array1, array $array2 )
    {
        return array_values( array_intersect( array_keys( $array1 ), array_keys( $array2 ) ) );
    }

    /**
     * Returns an array where the values are the intersection of the keys for
     * the supplied arrays
     *
     * @param array $array1
     * @param array $array2
     * @return array
     */
    public static function array_diff_keys( array $array1, array $array2 )
    {
        return array_values( array_diff( array_keys( $array1 ), array_keys( $array2 ) ) + array_diff( array_keys( $array2 ), array_keys( $array1 ) ) );
    }

    /**
     * Returns an array where the values are the union of the keys for the
     * supplied arrays
     *
     * @param array $array1
     * @param array $array2
     * @return array
     */
    public static function array_union_keys( array $array1, array $array2 )
    {
        $result = array_merge( array_values( AI::array_diff_keys( $array1, $array2 ) ), array_values( AI::array_intersect_keys( $array1, $array2 ) ) );
        sort( $result );
        return $result;
    }

    /**
     * Return the keys of elements in the
     * haystack where the value is found in array needle
     *
     * see http://www.php.net/manual/en/public static function.array-keys.php
     *
     * @param array $array_haystack
     * @param array $array_needle
     * @return array
     */
    public static function array_value_intersect_keys( array $array_haystack, array $array_needle )
    {
        $intersected = array_intersect( $array_haystack, $array_needle );
        return array_keys( $intersected );
    }

    /**
     * Reduce level from array of associative array
     * to an associative array
     *
     * @param array $array
     * @return array
     */
    public static function array_collapse_assoc( array $array )
    {
        $assoc = array();
        foreach ( $array as $key => $value )
        {
            $assoc[ $key ] = $value;
        }
        return $assoc;
    }

    /**
     * Returns an array with the keys prefixed with specified param
     *
     * @param array $array
     * @param string $prefix
     * @return array
     */
    public static function array_keys_prefix( array $array, $prefix = '' )
    {
        $assoc = array();
        foreach ( $array as $key => $value )
        {
            $assoc[ $prefix . $key ] = $value;
        }
        return $assoc;
    }

    /**
     * Returns an array where the element(s) with the value passed has been removed
     *
     * @param array $array
     * @param mixed $value
     * @param bool $strict
     * @return array
     */
    public static function array_remove( array $array, $value, $strict = false )
    {
        return array_diff_key( $array, array_flip( array_keys( $array, $value, $strict ) ) );
    }

    /**
     * Returns a sorted associative array by provided index (key) and optionally ASC or DESC
     *
     * see http://www.php.net/manual/en/public static function.sort.php
     *
     * @param array $array
     * @param string $index
     * @param type $order
     * @return array
     */
    public static function array_sort_assoc( array $array, $index, $order = SORT_ASC )
    {
        $new_array = array();
        $sortable_array = array();

        if ( count( $array ) > 0 )
        {
            foreach ( $array as $key => $value )
            {
                if ( is_array( $value ) )
                {
                    foreach ( $value as $key_2 => $value_2 )
                    {
                        if ( $key_2 == $index )
                        {
                            $sortable_array[ $key ] = $value_2;
                        }
                    }
                }
                else
                {
                    $sortable_array[ $key ] = $value;
                }
            }

            switch ( $order )
            {
                case SORT_ASC:
                    asort( $sortable_array );
                    break;
                case SORT_DESC:
                    arsort( $sortable_array );
                    break;
            }

            foreach ( $sortable_array as $key => $value )
            {
                $new_array[ $key ] = $array[ $key ];
            }
        }

        return $new_array;
    }

    /**
     * Returns a count of needle in the haystack
     *
     * @param array $haystack
     * @param type $needle
     * @return int
     */
    public static function array_value_count( array $haystack, $needle )
    {
        $count = 0;

        foreach ( $haystack as $value )
        {
            if ( $value === $needle )
            {
                $count++;
            }
        }

        return $count;
    }

    /**
     * Determine whether an object field matches needle.
     *
     * see http://php.net/manual/en/public static function.in-array.php
     *
     * @param Object $needle
     * @param Property $needle_field
     * @param array $haystack
     * @param boolean $strict
     * @return boolean
     */
    public static function in_array_field( $needle, $needle_field, array $haystack, $strict = false )
    {
        if ( $strict )
        {
            foreach ( $haystack as $item )
            {
                if ( isset( $item->$needle_field ) && $item->$needle_field === $needle )
                {
                    return true;
                }
            }
        }
        else
        {
            foreach ( $haystack as $item )
            {
                if ( isset( $item->$needle_field ) && $item->$needle_field == $needle )
                {
                    return true;
                }
            }
        }
        return false;
    }

    // TODO IMPLEMENT
    public static function array_get_duplicate_values()
    {

    }

    public static function get_keys_for_duplicate_values( array $array, $clean = false )
    {
        if ( $clean )
        {
            return array_unique( $array );
        }

        $result = array();
        foreach ( $array as $key => $val )
        {
            if ( isset( $new_arr[ $val ] ) )
            {
                $new_arr[ $val ] = $key;
            }
            else
            {
                if ( isset( $result[ $val ] ) )
                {
                    $result[ $val ][ ] = $key;
                }
                else
                {
                    $result[ $val ] = array(
                        $key );
                }
            }
        }
        return $result;
    }

    /**
     * Push a new element before the specified position
     *
     * @return array
     * @param array $source
     * @param array $add
     * @param int|string $position
     */
    public static function array_push_before( $source, $add, $position )
    {
        if ( is_int( $position ) )
        {
            $result = array_merge( array_slice( $source, 0, $position ), $add, array_slice( $source, $position ) );
        }
        else
        {
            foreach ( $source as $key => $value )
            {
                if ( $key == $position ) $result = array_merge( $result, $add );
                $result[ $key ] = $value;
            }
        }return $result;
    }

    /**
     * Push a new element after the specified position
     *
     * @return array
     * @param array $source
     * @param array $add
     * @param int|string $position
     */
    public static function array_push_after( $source, $add, $position )
    {
        if ( is_int( $position ) )
        {
            $result = array_merge( array_slice( $source, 0, $position + 1 ), $add, array_slice( $source, $position + 1 ) );
        }
        else
        {
            foreach ( $source as $key => $value )
            {
                $result[ $key ] = $value;
                if ( $key == $position ) { $result = array_merge( $result, $add ); }
            }
        }
        return $result;
    }

    /**
     * get an assoc array and add all following assoc array
     *
     * see http://php.net/manual/en/public static function.array-push.php
     *
     * @param array $source
     * @return array
     */
    public static function array_push_associative( &$source )
    {
        $arguments = func_get_args();
        foreach ( $arguments as $argument )
        {
            if ( is_array( $argument ) )
            {
                foreach ( $argument as $key => $value )
                {
                    $source[ $key ] = $value;
                    $result++;
                }
            }
            else
            {
                $source[ $argument ] = "";
            }
        }
        return $result;
    }

    /**
     * Searches haystack for needle and returns an array of the key path if
     * it is found in the (multidimensional) array, FALSE otherwise.
     *
     * @mixed array_searchRecursive ( mixed needle, array haystack [, bool strict[, array path]] )
     *
     * @param type $needle
     * @param array $haystack
     * @param boolean $strict
     * @param array $path
     * @return boolean
     */
    public static function array_search_recursive( $needle, $haystack, $strict = false, $path = array() )
    {
        if ( !is_array( $haystack ) )
        {
            return false;
        }

        foreach ( $haystack as $key => $val )
        {
            if ( is_array( $val ) && $subPath = array_searchRecursive( $needle, $val, $strict, $path ) )
            {
                $path = array_merge( $path, array( $key ), $subPath );
                return $path;
            }
            elseif ( (!$strict && $val == $needle) || ($strict && $val === $needle) )
            {
                $path[ ] = $key;
                return $path;
            }
        }
        return false;
    }
}
