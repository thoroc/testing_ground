<?php

$string = 'myCustomFunction';

echo '<h3>show function ' . $string . ' in current file</h3>';

$func = new ReflectionFunction( 'myCustomFunction' );
$ffilename = $func->getFileName(); // complete file path + file name
$start_line = $func->getStartLine() - 1; // it's actually - 1, otherwise you wont get the function() block
$end_line = $func->getEndLine(); // end line
$length = $end_line - $start_line; // number of total lines
$source = file( $ffilename ); // source file as array
$array = array_slice( $source, $start_line, $length );
$body = '<?php

' .implode( "", $array );
echo highlight_string( $body , true ); // needs true otherwise it will return the result

//$tokens = token_get_all( file_get_contents( 'string.php' ));
//
//foreach ($tokens as $token)
//{
//    if (is_array($token))
//    {
//        echo (token_name_nl($token[0]) . ': "' . $token[1] . '"<br />');
//    }
//    else
//    {
//        echo ('"' . $token . '"<br />');
//    }
//}


$filename = 'string.php';
$fullname = dirname(__FILE__) . DIRECTORY_SEPARATOR . $filename;

echo printString( $fullname );

$fileContent = file_get_contents( $fullname );

echo $fileContent;

// Get the file and get all PHP language tokens out of it
$arr = token_get_all( file_get_contents( 'string.php' ));

//The array where we will store our functions
$functions = array();

// loop trough
foreach( $arr as $key => $value)
{
    //filter all user declared functions
    if( $value[0] == 334)
    {
                //store third value to get relation
                $chekid = $value[2];
    }

    //now list functions user declared
    if( $value[2] == $chekid && $value[0] == 307 )
    {
        $functions[] = $value[1];
    }
}

//echo $functions . ' (' . count( $functions ) . ')';

//foreach( $functions as $value )
//{
//    echo '<div>' . $value . '</div>';
//}


function myCustomFunction()
{
    return 'foo';
}

class MyCustomClass
{
    private $var;

    public function setVar( $var )
    {
        $this->var = $var;
    }

    public function getVar()
    {
        return $this->var;
    }
}

function printCode($source_code)
{

    if (is_array($source_code))
        return false;

    $source_code = explode("\n", str_replace(array("\r\n", "\r"), "\n", $source_code));
    $line_count = 1;

    foreach ($source_code as $code_line)
    {
        $formatted_code .= '<tr><td>'.$line_count.'</td>';
        $line_count++;

        if (ereg('<\?(php)?[^[:graph:]]', $code_line))
            $formatted_code .= '<td>'. str_replace(array('<code>', '</code>'), '', highlight_string($code_line, true)).'</td></tr>';
        else
            $formatted_code .= '<td>'.ereg_replace('(&lt;\?php&nbsp;)+', '', str_replace(array('<code>', '</code>'), '', highlight_string('<?php '.$code_line, true))).'</td></tr>';
    }

    return '<table style="font: 1em Consolas, \'andale mono\', \'monotype.com\', \'lucida console\', monospace;">'.$formatted_code.'</table>';
}

function token_get_all_nl($source)
{
    $new_tokens = array();

    // Get the tokens
    $tokens = token_get_all($source);

    // Split newlines into their own tokens
    foreach ($tokens as $token)
    {
        $token_name = is_array($token) ? $token[0] : null;
        $token_data = is_array($token) ? $token[1] : $token;

        // Do not split encapsed strings or multiline comments
        if ($token_name == T_CONSTANT_ENCAPSED_STRING || substr($token_data, 0, 2) == '/*')
        {
            $new_tokens[] = array($token_name, $token_data);
            continue;
        }

        // Split the data up by newlines
        $split_data = preg_split('#(\r\n|\n)#', $token_data, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

        foreach ($split_data as $data)
        {
            if ($data == "\r\n" || $data == "\n")
            {
                // This is a new line token
                $new_tokens[] = array(T_NEW_LINE, $data);
            }
            else
            {
                // Add the token under the original token name
                $new_tokens[] = is_array($token) ? array($token_name, $data) : $data;
            }
        }
    }

    return $new_tokens;
}

function token_name_nl($token)
{
    if ($token === T_NEW_LINE)
    {
        return 'T_NEW_LINE';
    }

    return token_name($token);
}

function printString( $string, $comment = '' )
{
    echo '<div>' . $comment . ': ' . $string . '</div>';
}

function pringArray( array $array )
{
    echo '<div>';
    foreach( $array as $key => $value )
    {
        echo '<div>[' . $key . '] => ' . $value .  ',</div>';
    }
    echo '</div>';
}

function get_file_dir()
{
    global $argv;
    return realpath( $argv[0] );
}

$file = __FILE__;
$pathFile = realpath( $file );
$dirFile = dirname( $file );
$baseFile = basename( $file );

printString( $file, '__FILE__' );
printString( $pathFile, 'realpath(__FILE__)' );
printString( $dirFile, 'dirname(__FILE__)' );
printString( $baseFile, 'basename(__FILE__)' );


$dir = __DIR__;
$pathDir = realpath( $dir );
$dirDir = dirname( $dir );
$baseDir = basename( $dir );

$separator = DIRECTORY_SEPARATOR;

printString( $dir, '__DIR__' );
printString( $pathDir, 'realpath(__FILE__)' );
printString( $dirDir, 'dirname(__DIR__)' );
printString( $baseDir, 'basename(__DIR__)' );
//printString( $separator );

function public_base_directory()
{
    //get public directory structure eg "/top/second/third"
    //place each directory into array
    $directory_array = explode( '/', dirname( $_SERVER['PHP_SELF'] ));

    //get highest or top level in array of directory strings
    return max( $directory_array );
}


//printString( dirname( $_SERVER['PHP_SELF'] ) );

//$directory_array = explode( '/', dirname( $_SERVER['PHP_SELF'] ));
//printArray( $directory_array );

//printString( 'base: ' . public_base_directory() );

$my_folder = dirname( realpath( __FILE__ ) ) . DIRECTORY_SEPARATOR;

//printString( $my_folder );
//$arr = get_defined_functions();
//
//print_r($arr);
