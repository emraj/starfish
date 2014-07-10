<?php
/**
* dim_met.class.php stores the current Dimensions and Metrics in use by Starfish.
*/

class dim_met{

	public function get_dim_met()
	{
		$dimensions = array('userType', 'daysSinceLastSession', 'sessionCount');
		$metrics = array('newUsers', 'users');
		$print_order = '-users';
	}

	public function create_attributes()
	{
		// Date range for last 30 days (excluding today). Exactly the same as Google Analytics' last 30 Days range.
		$last_30_days = date("Y-m-d", strtotime("-30 days"));
		$yesterday = date("Y-m-d", strtotime("-1 days"));
		echo ("<p>Date Range: $last_30_days - $yesterday</p>");

		//
		$ga->requestReportData(ga_profile_id, $dimensions, $metrics, $print_order, $filter=null, $start_date=$last_30_days, $end_date=$yesterday);
		$gaResults = $ga->getResults();
		$i=1;

		// To print and confirm output. Remove snippet after development.
		foreach($gaResults as $result)
		{
		printf("%-4d %-40s %5d %5d<br>", // d stands for decimal, s stands for string.
		$i++,
		$result->$call_dim1(),
		$result->$call_met1(),
		$result->$call_met2());
		}


	}

	public function get_met_value()
	{
		$array1 = array();

		foreach($gaResults as $met_value)
		{
			$array1 = array($met_value->$get_met());
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