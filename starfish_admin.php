<?php
/**
* starfish_admin.php generates the dashboard page for Starfish on the Reef.
*/

// Required files.
require('data_loader.class.php');
require('logic.class.php');
require('blog_ids.class.php');

// Instantiate classes.
$blog_ids_obj = new blog_ids();
$data_loader_obj = new data_loader();
$logic_obj = new logic();

// Print title.
echo ("<h1>Website Performance Index</h1>");

// Get the current blog/website ID.
$current_id = get_current_blog_id();   
echo ("<p>Current Blog ID = $current_id</p>");

$site_url = get_site_url();
echo ("<p>" . $site_url . "</p>");
$trimmed_url = preg_replace('#^https?://reef-local.umiapps.com#', '', $site_url) . "/";
echo ("<p>$trimmed_url</p>");

#$ids_array = array($blog_ids_obj->load_csv());
$blog_ids_obj->load_csv();

$blog_ids_obj->compare($current_id);
$r_days = $blog_ids_obj->get_mydomain();
#$p_sum = $data_loader_obj->conn_GA($blog_ids_obj->get_myprofile());
$p_sum = $data_loader_obj->conn_GA('65103190');

$logic_obj->normalise($r_days, $p_sum);

?>