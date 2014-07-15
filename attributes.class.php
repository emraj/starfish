
<?php
/**
* blog_ids.class.php gets data from websites.csv file.
*/

class attributes
{
	// Main function: for generating each attribute.
	public function build_attribute($dim_met)
	{
		$dimensions = array($dim_met[0]);
		$metrics = array($dim_met[1]);
		$print_order = $dim_met[2];

		$call_dim1="get".ucwords($dimensions[0]); // e.g. "getSource".
	    $call_met1="get".ucwords($metrics[0]); // e.g. "getVisits".

		$attribute_input = array($dimensions, $metrics, $print_order, $call_dim1, $call_met1);
		return $attribute_input;
	}

	// 'Placed Ads' attribute.
	public function placed_ads()
	{
		$dim_met = array('adGroup', 'impressions', '-impressions');
		return $dim_met;
	}

	// 'Clickthrough Rate' attribute.
	public function ctr()
	{
		$dim_met = array('adTargetingType', 'CTR', '-CTR');
		return $dim_met;
	}

	// 'New Users' attribute.
	public function new_users()
	{
		$dim_met = array('userType', 'newUsers', '-newUsers');
		return $dim_met;
	}

	// 'Existing Users' attribute.
	public function existing_users()
	{
		$dim_met = array('userType', 'users', '-users');
		return $dim_met;
	}

	// 'User Loyalty' attribute.
	public function user_loyalty()
	{
		$dim_met = array('daysSinceLastSession', 'users', '-users');
		return $dim_met;
	}

	// 'Social Networking' attribute.
	public function social_net()
	{
		$dim_met = array('source', 'visits', '-visits');
		return $dim_met;
	}


}

?>