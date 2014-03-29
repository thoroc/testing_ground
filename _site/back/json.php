<?

// http://blog-en.openalfa.com/how-to-read-and-write-json-files-in-php/?ModPagespeed=noscript

// Read the file contents into a string variable,
// and parse the string into a data structure
//$str_data = file_get_contents("data.json");
//$data = json_decode($str_data,true);
//
//echo "Boss hobbies: ".$data["boss"]["Hobbies"][0]."\n";

// Modify the value, and write the structure to a file "data_out.json"
//
//$data["boss"]["Hobbies"][0] = "Swimming";

//$fh = fopen("data_out.json", 'w')
//      or die("Error opening output file");
//fwrite($fh, json_encode($data,JSON_UNESCAPED_UNICODE));
//fclose($fh);


// http://stackoverflow.com/questions/4343596/parsing-json-file-with-php

$file = "XVM.xvmconf";
//$string = file_get_contents( $file );
//
////echo $file;
////echo $string;
//
////$text = $string;
//
////echo "string: " . $string;
//
//$string = preg_replace( "\/\/.*|\*.*", "", $string);
//
////echo "string: " . $string;
//
function remove_comments( & $string )
{
  $string = preg_replace( "%(#|;|(//)).*%", "", $string );
  $string = preg_replace( "%/\*(?:(?!\*/).)*\*/%s", "", $string ); // google for negative lookahead
  return $string;
}
//
//function json_decode_nice( $json, $assoc = FALSE)
//{ 
//    $json = str_replace( array( "\n", "\r" ), "", $json); 
//    $json = preg_replace( '/([{,]+)(\s*)([^"]+?)\s*:/', '$1"$3":', $json); 
//    return json_decode( $json, $assoc ); 
//} 
//
////echo remove_comments( $string );
//
//$json = json_decode( $string, true );
//$json = json_decode_nice( $string, true );
//
////echo $json;
//
//$jsonIterator = new RecursiveIteratorIterator(
//    new RecursiveArrayIterator( json_decode( $json, TRUE )),
//    RecursiveIteratorIterator::SELF_FIRST);
//
//foreach ($jsonIterator as $key => $val)
//{
//    if(is_array($val))
//    {
//        echo "$key:\n";
//    }
//    else
//    {
//        echo "$key => $val\n";
//    }
//}

// http://php.net/manual/en/function.file.php

// Get a file into an array.  In this example we'll go through HTTP to get
// the HTML source of a URL.
$lines = file( $file );

// Loop through our array, show HTML source as HTML source; and line numbers too.
foreach ($lines as $line_num => $line)
{
//    $string = remove_comment( $line );
    $string = preg_replace( "\/\*.*", "", $line );
    echo "Line #<b>{ $line_num }</b> : " . htmlspecialchars( $line ) . " => " . $string . "<br /> \n";
//    $line = preg_replace( "\/\/.*|\*.*", "", $line);
}

// Another example, let's get a web page into a string.  See also file_get_contents().
//$html = implode('', file('http://www.example.com/'));

// Using the optional flags parameter since PHP 5
//$trimmed = file('somefile.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);