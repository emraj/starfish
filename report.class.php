<?php
/**
* report.class.php
* Generates report from Google Analytics.
*/

class report
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
    $ga = new gapi(ga_account,ga_password);
    return $ga;
  }

  public function request_report($ga, $attribute_input)
  {
    // Date range for last 30 days (excluding today). Exactly the same as Google Analytics' last 30 Days range.
    $last_30_days = date("Y-m-d", strtotime("-30 days"));
    $yesterday = date("Y-m-d", strtotime("-1 days"));

    $dimensions = $attribute_input[0];
    $metrics = $attribute_input[1];
    $print_order = $attribute_input[2];
    $filter = $attribute_input[3];

    // Request report for the last 30 days.
    $ga->requestReportData(ga_profile_id, $dimensions, $metrics, $print_order, $filter, $start_date=$last_30_days, $end_date=$yesterday);
    $gaResults = $ga->getResults();
    
    // Insert Snippet 4 here from extra_code.txt; To print and confirm requested Analytics data.

    // Calculate average metric value.
    global $values_array;
    $values_array = array();
    foreach($gaResults as $met_value){
      array_push($values_array, $met_value->$attribute_input[5]());
    }
    global $avg_met_value;
    $avg_met_value = array_sum($values_array) / count($values_array);
    return $avg_met_value;
  }
       
}

?>