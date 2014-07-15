<?php
/**
* starfish_admin.php generates the dashboard page for Starfish on the Reef.
*/

// Required classes.
require('dim_met.class.php');
require('logic.class.php');
require('blog_ids.class.php');
require('domain_age.class.php');
require('attributes.class.php');
require('gapi.class.php');

// Instantiate classes.
$blog_ids_obj = new blog_ids();
$dim_met_obj = new dim_met();
$logic_obj = new logic();
$domain_age_obj = new domain_age();
$attributes_obj = new attributes();

// Print title.
echo ("<h1>Website Performance Index</h1>");

// Get the current blog/website ID.
$current_id = get_current_blog_id();   
echo ("<p>Current Blog ID = $current_id</p>");

$site_url = get_site_url();
echo ("<p>" . $site_url . "</p>");

// Website's age.
echo ("The website, $site_url is <br>");
$r_age = "125"; // In days.
echo $r_age;

// Demo login details.
$account = 'analyticsumi@gmail.com';
$password = '124adigital';
$profile_id = '82330474'; // Reef id.

// Connect to account.
$ga = $dim_met_obj->connect_account($account, $password, $profile_id);


// Initialise attributes for the 'Advertising' category. *Adwords have not been set up.
#$advertising_points = array();
#array_push($advertising_points, $dim_met_obj->request_report($ga, $attributes_obj->build_attribute($attributes_obj->placed_ads()))); // 'Placed Ads' attribute.
#array_push($advertising_points, $dim_met_obj->request_report($ga, $attributes_obj->build_attribute($attributes_obj->ctr()))); // 'Clickthrough Rate' attribute.

// Initialise attributes for the 'User Engagement' category.
$engagement_points = array();
array_push($engagement_points, $dim_met_obj->request_report($ga, $attributes_obj->build_attribute($attributes_obj->new_users()))); // 'New Users' attribute.
array_push($engagement_points, $dim_met_obj->request_report($ga, $attributes_obj->build_attribute($attributes_obj->existing_users()))); // 'Existing Users' attribute.
array_push($engagement_points, $dim_met_obj->request_report($ga, $attributes_obj->build_attribute($attributes_obj->user_loyalty()))); // 'User Loyalty' attribute.

// Initialise attributes for the 'User Acquisition' category.
$acquisition_points = array();
array_push($acquisition_points, $dim_met_obj->request_report($ga, $attributes_obj->build_attribute($attributes_obj->social_net()))); // 'Social Networking' attribute.




#$advertising_subscore = array_sum($advertising_points); // Advertising subscore.
#echo "<p> Advertising subscore = $advertising_subscore </p>";

$engagement_subscore = array_sum($engagement_points); // User Engagement subscore.
echo "<p> User Engagement subscore = $engagement_subscore </p>";

$acquisition_subscore = array_sum($acquisition_points); // User Acquisition subscore.
echo "<p> User Acquisition subscore = $acquisition_subscore </p>";

// Aggregate score.
$agg = $engagement_subscore + $acquisition_subscore;
echo "<p> Aggregate Score (all categories) = $agg </p>";

// Apply logic.
$logic_obj->normalise($r_age, $agg);

?>