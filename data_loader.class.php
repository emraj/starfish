<?php
/**
* data_loader.class.php generates the dashboard page for Starfish on the Reef.
*/

class data_loader
{
  public $array1;
  public $array2;
	public static $percentageSum;
	#public $website;

    public function conn_GA($set_account, $set_password, $set_profile_id)
    {
    	require 'gapi.class.php';
      
      #$account = 'analyticsumi@gmail.com';
      #$password = '124adigital';

      $account = $set_account;
      $password = $set_password;
      $profile_id = $set_profile_id;

      // Google Analytics credentials.
    	define('ga_account'    , $account);
      define('ga_password'   , $password);
      define('ga_profile_id' , $profile_id);

      echo ("<p>$account</p>");
      echo ("<p>$password</p>");
      echo ("<p>$profile_id</p>");
      
      $ga = new gapi(ga_account,ga_password);

      // We are using the 'source' dimension and the 'visits' metrics
      $dimensions = array('source');
      $metrics    = array('visits', 'bounceRate');

      /* We will sort the result by desending order of visits, 
      and hence the '-' sign before the 'visits' string */
      $ga->requestReportData(ga_profile_id, $dimensions, $metrics, '-visits');
      $gaResults = $ga->getResults();
       $i=1;
       foreach($gaResults as $result)
       {
       printf("%-4d %-40s %5d %5d<br>", // d stands for decimal, s stands for string.
       $i++,
       $result->getSource(),
       $result->getVisits(),
       $result->getBounceRate());
       }

       global $array1;
       global $array2;
       $array1 = array();
       $array2 = array();

       foreach($gaResults as $visitValue)
       {
       	$array1 = array($visitValue->getVisits());
       }

       foreach($gaResults as $bounceRateValue)
       {
        $array2 = array($bounceRateValue->getBounceRate());
       }

       echo "<br>-----------------------------------------<br>";
       echo "Total Results : {$ga->getTotalResults()}<br>";

       var_dump($array1);
       var_dump($array2);

    $meanVisits = array_sum($array1) / count($array1);
    $meanBounceRate = array_sum($array2) / count($array2);
    echo "<br> Visits subscore = $meanVisits <br>";
    echo "<br> Bounce Rate subscore 	= $meanBounceRate <br>";

    global $percentageSum;
    $percentageSum = $meanVisits + $meanBounceRate;
    echo "<br> percentageSum = $percentageSum <br>";
    return $percentageSum;

    
    }

}
?>