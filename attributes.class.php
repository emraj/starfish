
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
		$filter = $dim_met[3];

		$call_dim1="get".ucwords($dimensions[0]); // e.g. "getSource".
	    $call_met1="get".ucwords($metrics[0]); // e.g. "getVisits".

		$attribute_input = array($dimensions, $metrics, $print_order, $filter, $call_dim1, $call_met1);
		return $attribute_input;
	}

	// 'Placed Ads' attribute.
	public function placed_ads()
	{
		$dim_met = array('adGroup', 'impressions', '-impressions', null);
		return $dim_met;
	}

	// 'Clickthrough Rate' attribute.
	public function ctr()
	{
		$dim_met = array('adTargetingType', 'CTR', '-CTR', null);
		return $dim_met;
	}

	// 'New Users' attribute.
	public function new_users()
	{
		$dim_met = array('userType', 'newUsers', '-newUsers', null);
		return $dim_met;
	}

	// 'Existing Users' attribute.
	public function existing_users()
	{
		$dim_met = array('userType', 'users', '-users', null);
		return $dim_met;
	}

	// 'User Loyalty' attribute.
	public function user_loyalty()
	{
		$dim_met = array('daysSinceLastSession', 'users', '-users', null);
		return $dim_met;
	}

	// 'Social Networking' attribute.
	public function social_net()
	{
		$dim_met = array('source', 'visits', '-visits', $filter='ga:source == facebook.com || source == m.facebook.com || source == twitter.com || source == linkedin.com
			             || source == touch.www.linkedin.com || source == pinterest.com || source == plus.google.com || source == tumblr.com || source == instagram || source == vk.com
			             || source == flickr.com || source == myspace.com || source == meetup.com || source == tagged.com || source == askfm.com
			             || source == meetme.com || source == classmates.com');
		return $dim_met;
	}

	// 'Site speed' attribute.
	public function site_speed()
	{
		$dim_met = array('pagePath', 'pageLoadTime', '-pageLoadTime', null);
		return $dim_met;
	}

	// 'Sales' attribute.
	public function sales()
	{
		$dim_met = array('transactionId', 'transaction', '-transaction', null);
		return $dim_met;
	}

	// 'Rooms Booked' attribute.
	public function rooms_booked()
	{
		$dim_met = array('productName', 'itemQuantity', '-itemQuantity', null);
		return $dim_met;
	}


}

?>