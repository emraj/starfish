<?php
/**
* Test class for 'data_loader.class.php'.
*/

require 'gapi.class.php';

// Set your Google Analytics credentials.
define('ga_account'     ,'analyticsumi@gmail.com');
define('ga_password'    ,'124adigital');
$profileid = 82330474; // Reef ID.
echo ("<p>$profileid</p>");
define('ga_profile_id'  ,$profileid);

$ga = new gapi(ga_account,ga_password);

$dimensions = array('pagePathLevel1');
$metrics    = array('visits', 'bounceRate');

// Testing with 'princeshouse'.
$ga->requestReportData(ga_profile_id, $dimensions, $metrics, '-visits', $filter='ga:pagePathLevel1 == /princeshouse/', $start_date='2014-05-28', $end_date='2014-06-27');
$gaResults = $ga->getResults();
$i=1;

foreach($gaResults as $result){
  printf("%-4d %-40s %5d %5d<br>", // d stands for decimal, s stands for string.
    $i++,
    $result->getPagePathLevel1(),
    $result->getVisits(),
    $result->getBounceRate());
}

$array1 = array();
$array2 = array();

foreach($gaResults as $visitValue){
  $array1 = array($visitValue->getVisits());
}

foreach($gaResults as $bounceRateValue){
  $array2 = array($bounceRateValue->getBounceRate());
}

echo "<br>-----------------------------------------<br>";
echo "Total Results : {$ga->getTotalResults()}<br>";

var_dump($array1);
var_dump($array2);

$meanVisits = array_sum($array1) / count($array1);
$meanBounceRate = array_sum($array2) / count($array2);
echo "<br> Visits subscore = $meanVisits <br>";
echo "<br> Bounce Rate subscore   = $meanBounceRate <br>";

global $percentageSum;
$percentageSum = $meanVisits + $meanBounceRate;
echo "<br> percentageSum = $percentageSum <br>";

?>