<?php

echo '<h3>demonstration of recursive loop</h3>';

$outText = var_export( $GLOBALS, true );

echo $outText;