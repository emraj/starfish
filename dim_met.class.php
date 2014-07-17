<?php
/**
* dim_met.class.php generates the dashboard page for Starfish on the Reef.
*/

class dim_met
{
  public $values_array;
	public $avg_met_value;

  public function connect_account($set_account, $set_password, $set_profile_id)
  {
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
    return $ga;
  }

  public function request_report($ga, $attribute_input)
  {
    // Date range for last 30 days (excluding today). Exactly the same as Google Analytics' last 30 Days range.
    $last_30_days = date("Y-m-d", strtotime("-30 days"));
    $yesterday = date("Y-m-d", strtotime("-1 days"));
    echo ("<br>Date Range: $last_30_days - $yesterday<br>");

    $dimensions = $attribute_input[0];
    $metrics = $attribute_input[1];
    $print_order = $attribute_input[2];
    $filter = $attribute_input[3];

    // Request report for the last 30 days.
    $ga->requestReportData(ga_profile_id, $dimensions, $metrics, $print_order, $filter, $start_date=$last_30_days, $end_date=$yesterday);
    $gaResults = $ga->getResults();
    
    // To print and confirm output. Remove snippet after development.
    $i=1;
    foreach($gaResults as $result)
    {
      printf("%-4d %-4s %-40s %-4s %-40s<br>", // d stands for decimal, s stands for string.
      $i++,
      ")",
      $result->$attribute_input[4](), // Dimension.
      "!",
      $result->$attribute_input[5]()); // Metric e.g. "getVisits".
    }
    echo "Total Results : {$ga->getTotalResults()}<br>";

    #public function avg_met_value($value)
    #{
    global $values_array;
    $values_array = array();

    foreach($gaResults as $met_value)
    {
      array_push($values_array, $met_value->$attribute_input[5]());
    }

    global $avg_met_value;
    $avg_met_value = array_sum($values_array) / count($values_array);
    echo "Attribute score = $avg_met_value <br>";
    echo "___________________________________________________<br>";
    return $avg_met_value;
  }
       
}

?>