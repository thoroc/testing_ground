<?php

echo '<h3>String manipulation</h3>';

$date = 'FY 2013 Q2';

echo '<div>String for date: ' . $date . '</div>';
echo '<div>FY exist in var $date: ' . stristr( $date, 'FY' ) . '</div>';
echo '<div>Q exist in var $date: ' . stristr( $date, 'Q' ) . '</div>';
echo '<div>FY exist in var $date: ' . strpos( $date, 'FY' ) . '</div>';
echo '<div>Q exist in var $date: ' . strpos( $date, 'Q' ) . '</div>';
echo '<div>year in var $date: ' . substr( $date, strpos( $date, 'FY' ), 7 ) . '</div>';
echo '<div>quarter in var $date: ' . substr( $date, strpos( $date, 'Q' ), 2 ) . '</div>';