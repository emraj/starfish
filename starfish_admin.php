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
#$gapi_obj = new gapi();

// Print title.
echo ("<h1>Website Performance Index</h1>");

// Get the current blog/website ID.
$current_id = get_current_blog_id();   
echo ("<p>Current Blog ID = $current_id</p>");

$site_url = get_site_url();
echo ("<p>" . $site_url . "</p>");
#$trimmed_url = preg_replace('#^https?://reef-local.umiapps.com#', '', $site_url) . "/";
#echo ("<p>$trimmed_url</p>");

// Website's age.
echo ("The website, $site_url is <br>");
$r_age = "125";
$r_days = $r_age . " days old.";
echo $r_days;

// Demo login details.
$account = 'analyticsumi@gmail.com';
$password = '124adigital';
$profile_id = '82330474'; // Reef id.


#$p_sum = $dim_met_obj->connect_account($account, $password, $profile_id);

$ga = $dim_met_obj->connect_account($account, $password, $profile_id);

// Initialise all attributes.
$dim_met_obj->request_report($ga, $attributes_obj->build_attribute($attributes_obj->new_users())); // 'New Users' attribute.
$dim_met_obj->request_report($ga, $attributes_obj->build_attribute($attributes_obj->existing_users())); // 'Existing Users' attribute.
$dim_met_obj->request_report($ga, $attributes_obj->build_attribute($attributes_obj->user_loyalty())); // 'User Loyalty' attribute.


#$logic_obj->normalise($r_days, $p_sum);



?>