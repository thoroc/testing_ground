<?php

// echo "<b>Today is</b>: " . date('l, F jS Y', strtotime( "today" )) . "<br/>";
// echo "<b>Tomorrow will be</b>: " . date('l jS \of F Y h:i:s A', strtotime ( "+1 day" )) . "<br/>";
// echo "<b>+1 week</b>: " . date('l jS \of F Y h:i:s A', strtotime ( "+1 week" )) . "<br/>";
// echo "<b>+1 week 2 days 4 hours 2 seconds</b>: " . date('l jS \of F Y h:i:s A', strtotime ( "+1 week 2 days 4 hours 2 seconds" )) . "<br/>";
// echo "<b>next Thursday will be</b>: " . date('l jS \of F Y h:i:s A', strtotime ( "next Thursday" )) . "<br/>";
// echo "<b>last Monday was</b>: " . date('l jS \of F Y h:i:s A', strtotime ( "last Monday" )) . "<br/>";


// echo "<br/>";
// echo date("jS F, Y", strtotime("11.12.10")); 
// outputs 10th December, 2011 
// echo "<br/>";

// echo date("jS F, Y", strtotime("11/12/10")); 
// outputs 12th November, 2010 
// echo "<br/>";

// echo date("jS F, Y", strtotime("11-12-10")); 
// outputs 11th December, 2010  
// echo "<br/>";



// set the default timezone to use. Available since PHP 5.1
// date_default_timezone_set('UTC');

// echo "<br/>";
// Prints something like: Monday
// echo "day of the week: " . date("l");
// echo "<br/>";
// Prints something like: Monday 8th of August 2005 03:12:46 PM
// echo "complete date and time: " . date('l jS \of F Y h:i:s A');
// echo "<br/>";
// Prints: July 1, 2000 is on a Saturday
// echo "July 1, 2000 is on a " . date("l", mktime(0, 0, 0, 7, 1, 2000));
// echo "<br/>";
/* use the constants in the format parameter */
// prints something like: Wed, 25 Sep 2013 15:28:57 -0700
// echo "short date and time with timezone: " . date(DATE_RFC2822);
// echo "<br/>";
// prints something like: 2000-07-01T00:00:00+00:00
// echo date(DATE_ATOM, mktime(0, 0, 0, 7, 1, 2000));
// echo "<br/>";

$fiscalmonths = array(
    array( "id" =>  2, "name" => "November", "startdate" => "2010-10-31", "enddate" => "2010-11-27", "fiscalyear" => "FY 2011", "fiscalquarter" => "Q2" ),
    array( "id" =>  3, "name" => "December", "startdate" => "2010-11-28", "enddate" => "2010-12-25", "fiscalyear" => "FY 2011", "fiscalquarter" => "Q2" ),
    array( "id" =>  4, "name" => "January", "startdate" => "2010-12-26", "enddate" => "2011-01-29", "fiscalyear" => "FY 2011", "fiscalquarter" => "Q2" ),
    array( "id" =>  5, "name" => "February", "startdate" => "2011-01-30", "enddate" => "2011-02-26", "fiscalyear" => "FY 2011", "fiscalquarter" => "Q3" ),
    array( "id" =>  6, "name" => "March", "startdate" => "2011-02-27", "enddate" => "2011-03-26", "fiscalyear" => "FY 2011", "fiscalquarter" => "Q3" ),
    array( "id" =>  7, "name" => "April", "startdate" => "2011-03-27", "enddate" => "2011-04-30", "fiscalyear" => "FY 2011", "fiscalquarter" => "Q3" ),
    array( "id" =>  8, "name" => "May", "startdate" => "2011-05-01", "enddate" => "2011-05-28", "fiscalyear" => "FY 2011", "fiscalquarter" => "Q4" ),
    array( "id" =>  9, "name" => "June", "startdate" => "2011-05-29", "enddate" => "2011-06-25", "fiscalyear" => "FY 2011", "fiscalquarter" => "Q4" ),
    array( "id" => 10, "name" => "July", "startdate" => "2011-06-26", "enddate" => "2011-07-30", "fiscalyear" => "FY 2011", "fiscalquarter" => "Q4" ),
    array( "id" => 11, "name" => "August", "startdate" => "2011-07-31", "enddate" => "2011-08-27", "fiscalyear" => "FY 2012", "fiscalquarter" => "Q1" ),
    array( "id" => 12, "name" => "September", "startdate" => "2011-08-28", "enddate" => "2011-09-24", "fiscalyear" => "FY 2012", "fiscalquarter" => "Q1" ),
    array( "id" => 13, "name" => "October", "startdate" => "2011-09-25", "enddate" => "2011-10-29", "fiscalyear" => "FY 2012", "fiscalquarter" => "Q1" ),
    array( "id" => 14, "name" => "November", "startdate" => "2011-10-30", "enddate" => "2011-11-26", "fiscalyear" => "FY 2012", "fiscalquarter" => "Q2" ),
    array( "id" => 15, "name" => "December", "startdate" => "2011-11-27", "enddate" => "2011-12-24", "fiscalyear" => "FY 2012", "fiscalquarter" => "Q2" ),
    array( "id" => 16, "name" => "January", "startdate" => "2011-12-25", "enddate" => "2012-01-28", "fiscalyear" => "FY 2012", "fiscalquarter" => "Q2" ),
    array( "id" => 17, "name" => "February", "startdate" => "2012-01-29", "enddate" => "2012-02-25", "fiscalyear" => "FY 2012", "fiscalquarter" => "Q3" ),
    array( "id" => 18, "name" => "March", "startdate" => "2012-02-26", "enddate" => "2012-03-24", "fiscalyear" => "FY 2012", "fiscalquarter" => "Q3" ),
    array( "id" => 19, "name" => "April", "startdate" => "2012-03-25", "enddate" => "2012-04-28", "fiscalyear" => "FY 2012", "fiscalquarter" => "Q3" ),
    array( "id" => 20, "name" => "May", "startdate" => "2012-04-29", "enddate" => "2012-05-26", "fiscalyear" => "FY 2012", "fiscalquarter" => "Q4" ),
    array( "id" => 21, "name" => "June", "startdate" => "2012-05-27", "enddate" => "2012-06-23", "fiscalyear" => "FY 2012", "fiscalquarter" => "Q4" ),
    array( "id" => 22, "name" => "July", "startdate" => "2012-06-24", "enddate" => "2012-07-28", "fiscalyear" => "FY 2012", "fiscalquarter" => "Q4" ),
    array( "id" => 23, "name" => "October", "startdate" => "2010-09-26", "enddate" => "2010-10-30", "fiscalyear" => "FY 2011", "fiscalquarter" => "Q1" ),
    array( "id" => 24, "name" => "September", "startdate" => "2010-08-29", "enddate" => "2010-09-25", "fiscalyear" => "FY 2011", "fiscalquarter" => "Q1" ),
    array( "id" => 25, "name" => "August", "startdate" => "2010-08-01", "enddate" => "2010-08-28", "fiscalyear" => "FY 2011", "fiscalquarter" => "Q1" ),
    array( "id" => 26, "name" => "August", "startdate" => "2009-07-26", "enddate" => "2009-08-22", "fiscalyear" => "FY 2010", "fiscalquarter" => "Q1" ),
    array( "id" => 27, "name" => "September", "startdate" => "2009-08-23", "enddate" => "2009-09-19", "fiscalyear" => "FY 2010", "fiscalquarter" => "Q1" ),
    array( "id" => 28, "name" => "October", "startdate" => "2009-09-20", "enddate" => "2009-10-24", "fiscalyear" => "FY 2010", "fiscalquarter" => "Q1" ),
    array( "id" => 29, "name" => "November", "startdate" => "2009-10-25", "enddate" => "2009-11-21", "fiscalyear" => "FY 2010", "fiscalquarter" => "Q2" ),
    array( "id" => 30, "name" => "December", "startdate" => "2009-11-22", "enddate" => "2009-12-19", "fiscalyear" => "FY 2010", "fiscalquarter" => "Q2" ),
    array( "id" => 31, "name" => "January", "startdate" => "2009-12-20", "enddate" => "2010-01-23", "fiscalyear" => "FY 2010", "fiscalquarter" => "Q2" ),
    array( "id" => 32, "name" => "February", "startdate" => "2010-01-24", "enddate" => "2010-02-27", "fiscalyear" => "FY 2010", "fiscalquarter" => "Q3" ),
    array( "id" => 33, "name" => "March", "startdate" => "2010-02-28", "enddate" => "2010-03-27", "fiscalyear" => "FY 2010", "fiscalquarter" => "Q3" ),
    array( "id" => 34, "name" => "April", "startdate" => "2010-03-28", "enddate" => "2010-05-01", "fiscalyear" => "FY 2010", "fiscalquarter" => "Q3" ),
    array( "id" => 35, "name" => "May", "startdate" => "2010-05-02", "enddate" => "2010-05-29", "fiscalyear" => "FY 2010", "fiscalquarter" => "Q4" ),
    array( "id" => 36, "name" => "June", "startdate" => "2010-05-30", "enddate" => "2010-06-26", "fiscalyear" => "FY 2010", "fiscalquarter" => "Q4" ),
    array( "id" => 37, "name" => "July", "startdate" => "2010-06-27", "enddate" => "2010-07-31", "fiscalyear" => "FY 2010", "fiscalquarter" => "Q4" ),
    array( "id" => 39, "name" => "August", "startdate" => "2012-07-29", "enddate" => "2012-08-25", "fiscalyear" => "FY 2013", "fiscalquarter" => "Q1" ),
    array( "id" => 40, "name" => "September", "startdate" => "2012-08-26", "enddate" => "2012-09-22", "fiscalyear" => "FY 2013", "fiscalquarter" => "Q1" ),
    array( "id" => 41, "name" => "October", "startdate" => "2012-09-23", "enddate" => "2012-10-27", "fiscalyear" => "FY 2013", "fiscalquarter" => "Q1" ),
    array( "id" => 42, "name" => "November", "startdate" => "2012-10-28", "enddate" => "2012-11-24", "fiscalyear" => "FY 2013", "fiscalquarter" => "Q2" ),
    array( "id" => 43, "name" => "December", "startdate" => "2012-11-25", "enddate" => "2012-12-22", "fiscalyear" => "FY 2013", "fiscalquarter" => "Q2" ),
    array( "id" => 44, "name" => "January", "startdate" => "2012-12-23", "enddate" => "2013-01-26", "fiscalyear" => "FY 2013", "fiscalquarter" => "Q2" ),
    array( "id" => 45, "name" => "February", "startdate" => "2013-01-27", "enddate" => "2013-02-23", "fiscalyear" => "FY 2013", "fiscalquarter" => "Q3" ),
    array( "id" => 46, "name" => "March", "startdate" => "2013-02-24", "enddate" => "2013-03-23", "fiscalyear" => "FY 2013", "fiscalquarter" => "Q3" ),
    array( "id" => 47, "name" => "April", "startdate" => "2013-03-24", "enddate" => "2013-04-27", "fiscalyear" => "FY 2013", "fiscalquarter" => "Q3" ),
    array( "id" => 48, "name" => "May", "startdate" => "2013-04-28", "enddate" => "2013-05-25", "fiscalyear" => "FY 2013", "fiscalquarter" => "Q4" ),
    array( "id" => 49, "name" => "June", "startdate" => "2013-05-26", "enddate" => "2013-06-22", "fiscalyear" => "FY 2013", "fiscalquarter" => "Q4" ),
    array( "id" => 50, "name" => "July", "startdate" => "2013-06-23", "enddate" => "2013-07-27", "fiscalyear" => "FY 2013", "fiscalquarter" => "Q4" ),
    array( "id" => 51, "name" => "August", "startdate" => "2013-07-28", "enddate" => "2013-08-24", "fiscalyear" => "FY 2014", "fiscalquarter" => "Q1" ),
    array( "id" => 52, "name" => "September", "startdate" => "2013-08-25", "enddate" => "2013-09-21", "fiscalyear" => "FY 2014", "fiscalquarter" => "Q1" ),
    array( "id" => 53, "name" => "October", "startdate" => "2013-09-22", "enddate" => "2013-10-26", "fiscalyear" => "FY 2014", "fiscalquarter" => "Q1" ),
    array( "id" => 54, "name" => "November", "startdate" => "2013-10-27", "enddate" => "2013-11-23", "fiscalyear" => "FY 2014", "fiscalquarter" => "Q2" ),
    array( "id" => 55, "name" => "December", "startdate" => "2013-11-24", "enddate" => "2013-12-21", "fiscalyear" => "FY 2014", "fiscalquarter" => "Q2" ),
    array( "id" => 56, "name" => "January", "startdate" => "2013-12-22", "enddate" => "2014-01-25", "fiscalyear" => "FY 2014", "fiscalquarter" => "Q2" ),
    array( "id" => 57, "name" => "February", "startdate" => "2014-01-26", "enddate" => "2014-02-22", "fiscalyear" => "FY 2014", "fiscalquarter" => "Q3" ),
    array( "id" => 58, "name" => "March", "startdate" => "2014-02-23", "enddate" => "2014-03-22", "fiscalyear" => "FY 2014", "fiscalquarter" => "Q3" ),
    array( "id" => 59, "name" => "April", "startdate" => "2014-03-23", "enddate" => "2014-04-26", "fiscalyear" => "FY 2014", "fiscalquarter" => "Q3" ),
    array( "id" => 60, "name" => "May", "startdate" => "2014-04-27", "enddate" => "2014-05-24", "fiscalyear" => "FY 2014", "fiscalquarter" => "Q4" ),
    array( "id" => 61, "name" => "June", "startdate" => "2014-05-25", "enddate" => "2014-06-21", "fiscalyear" => "FY 2014", "fiscalquarter" => "Q4" ),
    array( "id" => 62, "name" => "July", "startdate" => "2014-06-22", "enddate" => "2014-07-26", "fiscalyear" => "FY 2014", "fiscalquarter" => "Q4" ),
);