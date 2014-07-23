<!DOCTYPE html>
<html lang="en">
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">
    <title>starfish</title>
    </head>

<body>

<?php
/**
* starfish_dashboard.php generates the dashboard page for Starfish on the Reef.
*/

// Required classes.
require('dim_met.class.php');
require('logic.class.php');
require('domain_age.class.php');
require('attributes.class.php');
require('gapi.class.php');
#require('starfish_admin.php');

// Instantiate classes.
$dim_met_obj = new dim_met();
$logic_obj = new logic();
$domain_age_obj = new domain_age();
$attributes_obj = new attributes();
#$admin_obj = new starfish_admin();

?>

<div>
  <style>
    @charset "utf-8";
        /* CSS Document */

        /* ---------- FONTAWESOME ---------- */
        /* ---------- http://fortawesome.github.com/Font-Awesome/ ---------- */
        /* ---------- http://weloveiconfonts.com/ ---------- */

        @import url(http://weloveiconfonts.com/api/?family=fontawesome);

        /* ---------- ERIC MEYER'S RESET CSS ---------- */
        /* ---------- http://meyerweb.com/eric/tools/css/reset/ ---------- */

        @import url(http://meyerweb.com/eric/tools/css/reset/reset.css);

        /* ---------- FONTAWESOME ---------- */

        [class*="fontawesome-"]:before {
          font-family: 'FontAwesome', sans-serif;
        }

        /* ---------- GENERAL ---------- */

        body {
            background: #fff;
            color: #D1D1D1;
          font: 87.5%/1.5em 'Open Sans', sans-serif;
          margin: 0;
        }

        a {
            color: #eee;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        input {
            border: none;
            font-family: 'Open Sans', Arial, sans-serif;
            font-size: 12px;
            line-height: 1.5em;
            padding: 0;
            -webkit-appearance: none;
        }

        p {
            line-height: 1.5em;
        }

        .clearfix { *zoom: 1; } /* For IE 6/7 */
        .clearfix:before, .clearfix:after {
            display: table;
            content: "";
        }
        .clearfix:after { clear: both; }

        /* ---------- LOGIN ---------- */

        #login {
            margin: 50px auto;
            width: 100%;
        }

        #login form span {
            background-color: #363b41;
            border-radius: 3px 3px 3px 3px;
            color: #D1D1D1;
            display: block;
            float: left;
            height: 50px;
            line-height: 50px;
            text-align: center;
            width: 50px;
        }

        #login form input {
            height: 50px;
        }

        #login form input[type="text"], input[type="password"] {
            background-color: #fff;
            border-radius: 0px 3px 3px 0px;
            color: #606468;
            margin-bottom: 1.5em;margin-left: 7px;
            padding: 0 16px;
            width: 30%;
        }
        #login form input[type="email"], input[type="email"] {
            background-color: #fff;
            border-radius: 0px 3px 3px 0px;
            color: #606468;
            margin-bottom: 1.5em;
            margin-left: 7px;
            padding: 0 16px;
            width: 30%;
        }
        #login form input[type="id"], input[type="id"] {
            background-color: #fff;
            border-radius: 0px 3px 3px 0px;
            color: #606468;
            margin-bottom: 1.5em;
            margin-left: 7px;
            padding: 0 16px;
            width: 30%;
        }

        #login form input[type="submit"] {
            border-radius: 3px;
            -moz-border-radius: 3px;
            -webkit-border-radius: 3px;
            background-color: #00aded;
            color: #eee;
            font-weight: bold;
            margin-bottom: 2em;
            margin-left: 57px;
            text-transform: uppercase;
            width: 30%;
        }

        #login form input[type="submit"]:hover {
            background-color: #0074a2;
        }

        #login > p {
            text-align: center;
        }

        #login > p span {
            padding-left: 5px;
        }
        </style>

            <div id="login">

<?php
$email = null;
$password = null;
$id = null;
if(isset($_POST['email'])) {
  $email = $_POST['email'];
}
if(isset($_POST['password'])) {
  $password = $_POST['password'];
}
if(isset($_POST['id'])) {
  $id = $_POST['id'];
}
?>

<?php if (empty($login_details)) { ?>

                    <fieldset class="clearfix">
                        <form method="post">
                        <p><span class="fontawesome-envelope"></span><input type="email" name="email" placeholder="Google Analytics Email" value="<?php echo $email; ?>" required></p> <!-- JS because of IE support; better: placeholder="Username" -->
                        <p><span class="fontawesome-lock"></span><input type="password" name="password" placeholder="Google Analytics Password" value="<?php echo $password; ?>" required></p> <!-- JS because of IE support; better: placeholder="Username" -->
                        <p><span class="fontawesome-user"></span><input type="id"  name="id" placeholder="Website Profile ID eg. 12345678" value="<?php echo $id; ?>" required></p> <!-- JS because of IE support; better: placeholder="Password" -->
                        <p><input type="submit" value="Sign In"></p>
                        </form>
                    </fieldset>
<?php } ?>

            </div> <!-- end login -->

</div>

<?php

function login($set_account, $set_password, $set_profile_id)
{
  $account = $set_account;
  $password = $set_password;
  $profile_id = $set_profile_id;
  $login_details = array($account, $password, $profile_id);
  return $login_details;
}


?>

<?php

// Print title.
#echo ("<h1>Website Performance Index</h1>");

// Get the current blog/website ID.
$current_id = get_current_blog_id();   
#echo ("<p>Current Blog ID = $current_id</p>");

$site_url = get_site_url();
#echo ("<p>" . $site_url . "</p>");

// Website's age.
#echo ("The website, $site_url is <br>");
$r_age = 125; // In days.

// Login details.
$login_details = login($email, $password, $id);
#$account = 'analyticsumi@gmail.com';
#$password = '124adigital';
#$profile_id = '82330474'; // Reef id.


// Connect to account.
if (isset($login_details)) {
$ga = $dim_met_obj->connect_account($login_details[0], $login_details[1], $login_details[2]);
#$ga = $dim_met_obj->connect_account($account, $password, $profile_id);
}


// Initialise attributes for the 'Advertising' category. *Adwords have not been set up.
#$advertising_points = array();
#array_push($advertising_points, $dim_met_obj->request_report($ga, $attributes_obj->build_attribute($attributes_obj->placed_ads()))); // 'Placed Ads' attribute.
#array_push($advertising_points, $dim_met_obj->request_report($ga, $attributes_obj->build_attribute($attributes_obj->ctr()))); // 'Clickthrough Rate' attribute.

// Initialise attributes for the 'Acquisition' category.
$acquisition_points = array();
array_push($acquisition_points, $dim_met_obj->request_report($ga, $attributes_obj->build_attribute($attributes_obj->social_net()))); // 'Social Networking' attribute.
$posts_count = wp_count_posts();
$published_posts_count = $posts_count->publish;
$comments_count = 7;
$posts_comments_count = $published_posts_count * $comments_count;
#echo "Number of published blog posts: $published_posts"; // Confirm number of published blog posts.
array_push($acquisition_points, $posts_comments_count); // 'Blogging' attribute.

// Initialise attributes for the 'Usability' category.
$usability_points = array();
array_push($usability_points, $dim_met_obj->request_report($ga, $attributes_obj->build_attribute($attributes_obj->site_speed()))); // 'Site Speed' attribute.


// Initialise attributes for the 'Engagement' category.
$engagement_points = array();
array_push($engagement_points, $dim_met_obj->request_report($ga, $attributes_obj->build_attribute($attributes_obj->new_users()))); // 'New Users' attribute.
array_push($engagement_points, $dim_met_obj->request_report($ga, $attributes_obj->build_attribute($attributes_obj->existing_users()))); // 'Existing Users' attribute.
array_push($engagement_points, $dim_met_obj->request_report($ga, $attributes_obj->build_attribute($attributes_obj->user_loyalty()))); // 'User Loyalty' attribute.

// Initialise attributes for the 'E-Commerce' category.
#$ecommerce_points = array();
#array_push($ecommerce_points, $dim_met_obj->request_report($ga, $attributes_obj->build_attribute($attributes_obj->sales()))); // 'Sales' attribute.
#array_push($ecommerce_points, $dim_met_obj->request_report($ga, $attributes_obj->build_attribute($attributes_obj->rooms_booked()))); // 'Rooms Booked' attribute.


#$advertising_subscore = array_sum($advertising_points); // Advertising subscore.
#echo "<p> Advertising subscore = $advertising_subscore </p>";

$acquisition_subscore = array_sum($acquisition_points); // User Acquisition subscore.
#echo "<p> User Acquisition subscore = $acquisition_subscore </p>";

$usability_subscore = array_sum($usability_points); // Usability subscore.
#echo "<p> Usability subscore = $usability_subscore </p>";

$engagement_subscore = array_sum($engagement_points); // User Engagement subscore.
#echo "<p> User Engagement subscore = $engagement_subscore </p>";

#$ecommerce_subscore = array_sum($ecommerce_points); // User Engagement subscore.
#echo "<p> User Engagement subscore = $ecommerce_subscore </p>";


// Aggregate score.
static $agg;
#$agg = $acquisition_subscore + $usability_subscore + $engagement_subscore;
$agg = 72;
#echo "<p> Aggregate Score (all categories) = $agg </p>";

// Apply logic.
$logic_obj->normalise($r_age, $agg);

?>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>

    <!-- pie chart -->
    <script type="text/javascript">
      jQuery( document ).ready(function() {
        jQuery('#index').html('<center><font color="black"><h2>Website\'s Performance Index: <?php echo $agg; ?> %</h2>The Index represents the cumulative score of metrics from your website.<br> Click on any metric category below to find out more.<br></font></center>');
      });

      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Category',    'Subscore'],
          ['Acquisition', 27],
          ['Usability', 11],
          ['Engagement', 62],
          //['Acquisition', <?php echo intval($acquisition_subscore); ?>],
          //['Usability',   <?php echo intval($usability_subscore); ?>],
          //['Engagement',  <?php echo intval($engagement_subscore); ?>]
        ]);

        var options = {
          title: 'CATEGORIES',
          //is3D: true,
          chartArea: {left:20,top:20,width:500,height:300},
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));


        function selectHandler() {
          var selectedItem = chart.getSelection()[0];
          if (selectedItem) {
            var value = data.getValue(selectedItem.row, 0);
            //alert('The user selected ' + value);
            if (value == 'Acquisition') {
              jQuery( document ).ready(function() {
                jQuery('#description').html('USER ACQUISITION <BR> The process of persuading a consumer to purchase a company\'s goods or services. The cost associated with the important customer acquisition process is an important measure for a business to evaluate in combination with how much value having each customer typically brings to the business. <a href="<?php echo site_url() ?>/wp-content/plugins/starfish/dashboard_2.php">View details!</a>');
              });
            }
            else if (value == 'Usability') {
              jQuery( document ).ready(function() {
                jQuery('#description').html('SITE USABILITY: The ease of use of a website. <a href="<?php echo site_url() ?>/wp-content/plugins/starfish/dashboard_2.php">View details!</a>');
              });
            }
            else if (value == 'Engagement') {
              jQuery( document ).ready(function() {
                jQuery('#description').html('USER ENGAGEMENT <BR> The engagement of customers with one another, with a company or a brand. <a href="<?php echo site_url() ?>/wp-content/plugins/starfish/dashboard_2.php">View details!</a>');
              });
            }
            
          }
        }

        google.visualization.events.addListener(chart, 'select', selectHandler);

        chart.draw(data, options);
      }

    </script>

<?php if (isset($login_details)) { ?>
    <div style="width:850px; height:550px; background-color:#ffffff;">
      <div id="index" style="width: 850px; height: 150px; margin-top:50px;"></div>
      <div id="piechart" style="width: 500px; height: 300px; float:left;"></div>
      <div id="description" style="width: 300px; height: 100px; float:right; margin-right:10px; margin-top:20px; z-index: 45;"></div>
    </div>
<?php } ?>
</body>
</html>