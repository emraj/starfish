
<?php
/**
* blog_ids.class.php gets data from websites.csv file.
*/

class attributes
{
	// For USERS attribute.
	public function new_users()
	{
		$dimensions = array('userType');
		$metrics = array('newUsers');
		$print_order = '-newUsers';

		$call_dim1="get".ucwords($dimensions[0]); // e.g. "getSource".
	    $call_met1="get".ucwords($metrics[0]); // e.g. "getVisits".

		$new_users_input = array($dimensions, $metrics, $print_order, $call_dim1, $call_met1);
		return $new_users_input;
	}

	public function existing_users()
	{
		$dimensions = array('userType');
		$metrics = array('users');
		$print_order = '-users';
	}

	public function user_loyalty()
	{
		$dimensions = array('daysSinceLastSession');
		$metrics = array('users');
		$print_order = '-users';
	}

}

?>