<?php
/**
* starfish_admin.php generates the dashboard page for Starfish on the Reef.
*/

// Required classes.
require('data_loader.class.php');
require('logic.class.php');
require('blog_ids.class.php');
require('domain_age.class.php');

// Instantiate classes.
$blog_ids_obj = new blog_ids();
$data_loader_obj = new data_loader();
$logic_obj = new logic();
$domain_age_obj = new domain_age();

// Print title.
echo ("<h1>Website Performance Index</h1>");

// Get the current blog/website ID.
$current_id = get_current_blog_id();   
echo ("<p>Current Blog ID = $current_id</p>");

$site_url = get_site_url();
echo ("<p>" . $site_url . "</p>");
#$trimmed_url = preg_replace('#^https?://reef-local.umiapps.com#', '', $site_url) . "/";
#echo ("<p>$trimmed_url</p>");

echo ("The website, $site_url is <br>");
$r_age = "125";
$r_days = $r_age . " days old.";
echo $r_days;

// Test login details.
$account = 'analyticsumi@gmail.com';
$password = '124adigital';
$profile_id = '82330474'; // Reef id.

$p_sum = $data_loader_obj->conn_GA($account, $password, $profile_id);

$logic_obj->normalise($r_days, $p_sum);



?>