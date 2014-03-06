<?php

echo '<h3>compare</h3>';

$values = [" VSEgrad", "CSS", "Specialist", "TechLead", "VSEgrad"];

echo '<h3>original array</h3>';
foreach( $values as $e )
{
    echo "<div>[" . $e . "]</div>";
}

$ctrlArray = [];
$return = [];

echo '<h3>processing values</h3>';
foreach( $values as $value )
{
    $temp = strtolower( trim( $value ));
    if( !in_array( $temp, $ctrlArray) )
    {
        $ctrlArray[] = $temp;
        $return[] = trim( $value);
    }
    echo "<div>[" . $temp . "]</div>";
}

echo '<h3>control array</h3>';
foreach( $ctrlArray as $e )
{
    echo "<div>[" . $e . "]</div>";
}

echo '<h3>resulting array</h3>';
foreach( $return as $e )
{
    echo "<div>[" . $e . "]</div>";
}

