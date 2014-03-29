<?php

echo '<h3>Date manipulation</h3>';

// set the default timezone to use. Available since PHP 5.1
date_default_timezone_set('UTC');

// Prints something like: Monday
$day = date( "l" );
echo '<p>Day of the week ( \'l\' ): ' . $day . '</p>';

$month = date( 'F' );
echo '<p>Month of the year ( \'F\' ): ' . $month . '</p>';

$year = date( 'Y' );
echo '<p>Year ( \'Y\' ): ' . $year . '</p>';

// Prints something like: Monday 8th of August 2005 03:12:46 PM
$fullDate = date('l jS \of F Y h:i:s A');
echo '<p>Full date for this day: ' . $fullDate . '</p>';

// Prints: July 1, 2000 is on a Saturday
$day2 = date("l", mktime(0, 0, 0, 7, 1, 2000));
echo "July 1, 2000 is on a " . $day2;

/* use the constants in the format parameter */
// prints something like: Mon, 15 Aug 2005 15:12:46 UTC
$moreDate = date(DATE_RFC822);
echo '<p>' . $moreDate . '</p>';

// prints something like: 2000-07-01T00:00:00+00:00
$utc =  date(DATE_ATOM, mktime(0, 0, 0, 7, 1, 2000));
echo '<p>' . $utc . '</p>';

// Assuming today is March 10th, 2001, 5:16:18 pm, and that we are in the
// Mountain Standard Time (MST) Time Zone

$today = date("F j, Y, g:i a");                 // March 10, 2001, 5:16 pm
echo '<p>today: ' . $today . '</p>';
$short = date("m.d.y");                         // 03.10.01
echo '<p>today (short): ' . $short . '</p>';
$split = date("j, n, Y");                       // 10, 3, 2001
echo '<p>today (splitted): ' . $split . '</p>';
$condensed = date("Ymd");                           // 20010310
echo '<p>today (condensed): ' . $condensed . '</p>';
$hourDate = date('h-i-s, j-m-y, it is w Day');     // 05-16-18, 10-03-01, 1631 1618 6 Satpm01
echo '<p>today (time, date): ' . $hourDate . '</p>';
$dom = date('\i\t \i\s \t\h\e jS \d\a\y.');   // it is the 10th day.
echo '<p>today (day of the month): ' . $dom . '</p>';
$utc2 = date("D M j G:i:s T Y");               // Sat Mar 10 17:16:18 MST 2001
echo '<p>today (utc): ' . $utc2 . '</p>';
$smth = date('H:m:s \m \i\s\ \m\o\n\t\h');     // 17:03:18 m is month
echo '<p>today: ' . $smth . '</p>';
$time = date("H:i:s");                         // 17:16:18
echo '<p>today (time): ' . $time . '</p>';
$dateAndTime = date("Y-m-d H:i:s");                   // 2001-03-10 17:16:18 (the MySQL DATETIME format)
echo '<p>today (date and time): ' . $dateAndTime . '</p>';
$date = date( 'Y-m-d' );
echo '<p>today (date): ' . $date . '</p>';

$now = new DateTime( 'NOW' );
echo '<p>DateTime object set to now and formatted in MySQL DATETIME format: ' . $now->format( 'Y-m-d H:i:s' ) . '</p>';

$someOtherDate = new DateTime( $dateAndTime );
echo '<p>DateTime object set to $dateAndTime and formatted in MySQL DATETIME format: ' . $someOtherDate->format( 'Y-m-d H:i:s' ) . '</p>';

$valid = date( 'Y-m-d', strtotime( trim( $date ) ) ) == $date;

echo '<p>is date( \'Y-m-d\' ) valid? '.  $valid . '</p>';

echo '<p>isValidDateTime( date("Y-m-d H:i:s") ): ' . isValidDateTime( $dateAndTime ) . '</p>';
echo '<p>isValidDateTime( date("Y-m-d") ): ' . isValidDateTime( $date ) . '</p>';
echo '<p>isValidDateTime( new DateTime( \'NOW\' ) ): ' . isValidDateTime( $now ) . '</p>';
echo '<p>is_valid_date( date("Y-m-d H:i:s") ): ' . is_valid_date( $dateAndTime ) . '</p>';
echo '<p>is_valid_date( date("Y-m-d") ): ' . is_valid_date( $date, 'Y-m-d' ) . '</p>';
echo '<p>is_valid_date( new DateTime( \'NOW\' ) ): ' . is_valid_date( $now ) . '</p>';
echo '<p>check_sql_date_format( date("Y-m-d H:i:s") ): ' . check_sql_date_format( $dateAndTime ) . '</p>';
echo '<p>check_sql_date_format( new DateTime( \'NOW\' ) ): ' . check_sql_date_format( $now ) . '</p>';
echo '<p>checkDateTime( date("Y-m-d H:i:s") ): ' . checkDateTime( $dateAndTime ) . '</p>';
echo '<p>checkDateTime( new DateTime( \'NOW\' ) ): ' . checkDateTime( $now, 'Y-m-d' ) . '</p>';

$date_format = 'Y-m-d';
$input = '2009-03-03';

$input = trim($input);
$time = strtotime($input);

$is_valid = date($date_format, $time) == $input;

print "Valid? ".($is_valid ? 'yes' : 'no');

function isValidDateTime( $dateTime )
{
    if ( preg_match( "/^(\d{4})-(\d{2})-(\d{2}) ([01][0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])$/", $dateTime, $matches ))
    {
        if ( checkdate( $matches[2], $matches[3], $matches[1] ))
        {
            return 'true';
        }
    }

    return 'false';
}

function is_valid_date( $value, $format = 'dd.mm.yyyy' )
{
    if( strlen( $value ) >= 6 && strlen( $format ) == 10)
    {
        // find separator. Remove all other characters from $format
        $separator_only = str_replace( array( 'm','d','y' ), '', $format );
        $separator = $separator_only[0]; // separator is first character

        if( $separator && strlen( $separator_only ) == 2 )
        {
            // make regex
            $regexp = str_replace( 'mm', '(0?[1-9]|1[0-2])', $format );
            $regexp = str_replace( 'dd', '(0?[1-9]|[1-2][0-9]|3[0-1])', $regexp );
            $regexp = str_replace( 'yyyy', '(19|20)?[0-9][0-9]', $regexp );
            $regexp = str_replace( $separator, "\\" . $separator, $regexp );
            if( $regexp != $value && preg_match( '/' . $regexp . '\z/', $value ))
            {
                // check date
                $arr = explode( $separator, $value );
                $day = $arr[0];
                $month = $arr[1];
                $year = $arr[2];
                if( @checkdate( $month, $day, $year ) )
                    return 'true';
            }
        }
    }
    return 'false';
}

function check_sql_date_format( $date )
{
    $date = substr( $date, 0, 10 );
    list( $year, $month, $day ) = explode( '-', $date );
    if ( !is_numeric( $year ) || !is_numeric( $month ) || !is_numeric( $day ))
    {
        return false;
    }
    return checkdate( $month, $day, $year );
}

function checkDateTime($data, $format = 'Y-m-d H:i:s')
{
    if ( date( $format, strtotime( $data )) == $data )
    {
        return 'true';
    } else {
        return 'false';
    }
}

echo '<p>' . date( 'Y-m-d' ) . ' timestamp is: ' . strtotime( date( 'Y-m-d' ) ). '</p>';
echo '<p>' . 'now timestamp is: ' . strtotime("now"), '<br/>';
echo '<p>' . '10 September 2000 timestamp is: ' . strtotime("10 September 2000"). '</p>';
echo '<p>' . '+1 day timestamp is: ' . strtotime("+1 day"). '</p>';
echo '<p>' . '+1 week timestamp is: ' . strtotime("+1 week"). '</p>';
echo '<p>' . '+1 week 2 days 4 hours 2 seconds timestamp is: ' . strtotime("+1 week 2 days 4 hours 2 seconds"). '</p>';
echo '<p>' . 'next Thursday timestamp is: ' . strtotime("next Thursday"). '</p>';
echo '<p>' . 'last Monday timestamp is: ' . strtotime("last Monday"). '</p>';

echo '===================> dates <=======================';

echo '<p>first day of this month: ' . date('m-01-Y 00:00:00', strtotime( 'this month' )). '</p>';
echo '<p>last day of this month: ' . date('m-t-Y 23:59:59', strtotime( 'this month' )). '</p>';
echo '<p>ISO8601 date for today (this month really): ' . date('c', strtotime( 'this month' )). '</p>';



echo '<p>ISO8601 date for July 1, 2014: ' . date("c", mktime(0, 0, 0, 7, 1, 2014)). '</p>';

$thisYear = 2014;
$thisMonth = 2;
$lastDay = date( "t", mktime(23, 59, 59, $thisMonth, 1, $thisYear) );

$start = date( "Y-m-d H:i:s", mktime(0, 0, 0, $thisMonth, 1, $thisYear) );
$end = date( "Y-m-t H:i:s", mktime(23, 59, 59, $thisMonth, 1, $thisYear) );

$europe = new DateTimeZone('Europe/Berlin');

$startD1 = new DateTime( $start, $europe );
$endD1 = new DateTime( $end, $europe );

//$dt->setTimezone($ESTTZ);

$startISO = date( "c", mktime(0, 0, 0, $thisMonth, 1, $thisYear), $europe );
//$startISO->setTimezone( $europe );
$endISO = date( "c", mktime(23, 59, 59, $thisMonth, $lastDay, $thisYear), $europe );
//$endISO->setTimezone( $europe );

echo '<p>Month = ' . $thisMonth . ', Year = ' . $thisYear . '</p>';
echo '<p>Start Date</p>';
echo '<p>' . $startD1->format( 'c' ) . '</p>';
echo '<p>End Date</p>';
echo '<p>' . $endD1->format( 'c' ) . '</p>';