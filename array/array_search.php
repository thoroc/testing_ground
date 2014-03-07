<?php

echo '<h3>demonstration of search value in sub array</h3>';

$state = array(
    array(
        'id' => 2,
        'sections' => array(
            array(
                'id' => 13,
                'fields' => array(
                    30, 31, 32,
                ),
            ),
            array(
                'id' => 14,
                'fields' => array(
                    33, 34,
                ),
            ),
        ),
    ),
);


echo '<h4>cold array</h4>';
print_r( $state );

echo '<h4>list of element in the array</h4>';

$index = array(
    'forms' => array(),
    'sections' => array(),
    'fields' => array()
);

echo '<ul>';
foreach( $state as $form )
{
    echo '<li>Form Id: ' . $form['id'] . '</li>';
    array_push( $index['forms'], $form['id'] );
    echo '<li>Sections</li>';
    echo '<ul>';
    foreach( $form['sections'] as $k => $section )
    {
        array_push( $index['sections'], $section['id'] );
        echo '<li>Section Id: ' . $section['id'] .'</li>';
        echo '<li>Fields</li>';
        echo '<ul>';
        foreach( $section['fields'] as $field )
        {
            array_push( $index['fields'], $field );
            echo '<li>Field Id: ' . $field . '</li>';
        }
        echo '</ul>';
    }
    echo  '</ul>';
}

echo '</ul>';

foreach( $index as $k => $v )
{
    echo '<div>[' . $k . '] => {';

//    while( $k < count( $index ) )
//    {
//        echo 'foo ';
//    }

    foreach( $v as $e )
    {
        echo $e . ', ';
    }
    echo '}</div>';
}

?>