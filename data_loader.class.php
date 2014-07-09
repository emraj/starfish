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
      

      $account = $set_account;
      $password = $set_password;
      $profile_id = $set_profile_id;

      // Google Analytics credentials.
    	define('ga_account'    , $account);
      define('ga_password'   , $password);
      define('ga_profile_id' , $profile_id);

      // Confirm login details in use.
      echo ("<p>$account</p>");
      echo ("<p>$password</p>");
      echo ("<p>$profile_id</p>");
      
      $ga = new gapi(ga_account,ga_password);

      $dim1 = 'source';
      $met1 = 'visits';
      $met2 = 'bounceRate';

      $dimensions = array($dim1);
      $metrics    = array($met1, $met2); #, 'bounceRate');
      $call_dim1="get".ucwords($dim1); // e.g. getSource.
      $call_met1="get".ucwords($met1); // e.g. getVisits.
      $call_met2="get".ucwords($met2); // e.g. getBounceRate.
      $print_order = '-'.$met1;
      
      // Date range for last 30 days (excluding today). Exactly the same as Google Analytics' last 30 Days range.
      $last_30_days = date("Y-m-d", strtotime("-30 days"));
      $yesterday = date("Y-m-d", strtotime("-1 days"));
      echo ("<p>Date Range: $last_30_days - $yesterday</p>");

      // We are using the 'source' dimension and the 'visits' metrics
      $ga->requestReportData(ga_profile_id, $dimensions, $metrics, $print_order, $filter=null, $start_date=$last_30_days, $end_date=$yesterday);
      $gaResults = $ga->getResults();
      $i=1;
      foreach($gaResults as $result)
      {
        printf("%-4d %-40s %5d %5d<br>", // d stands for decimal, s stands for string.
        $i++,
        $result->$call_dim1(),
        $result->$call_met1(),
        $result->$call_met2());
      }

       global $array1;
       global $array2;
       $array1 = array();
       $array2 = array();

       foreach($gaResults as $met1Value)
       {
        $array1 = array($met1Value->$call_met1());
       }

       foreach($gaResults as $met2Value)
       {
        $array2 = array($met2Value->$call_met2());
       }

       echo "<br>-----------------------------------------<br>";
       echo "Total Results : {$ga->getTotalResults()}<br>";

       var_dump($array1);
       var_dump($array2);

      $meanMet1 = array_sum($array1) / count($array1);
      $meanMet2 = array_sum($array2) / count($array2);
      echo "<br> $met1 subscore = $meanMet1 <br>";
      echo "<br> $met2 subscore 	= $meanMet2 <br>";

      global $percentageSum;
      $percentageSum = $meanMet1 + $meanMet2;
      echo "<br> Percentage Sum = $percentageSum <br>";
      return $percentageSum;

    
    }

}
?>