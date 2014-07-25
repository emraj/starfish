<?php
/**
* dashboard.php
* Computes output and displays elements, for the Starfish dashboard. 
*/
?>

<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
  </head>

  <body>

  <?php
  // Load required classes.
  require('report.class.php');
  require('normalise.class.php');
  require('domain_age.class.php');
  require('attributes.class.php');
  require('gapi.class.php');

  // Instantiate classes.
  $report_obj = new report();
  $normalise_obj = new normalise();
  $domain_age_obj = new domain_age();
  $attributes_obj = new attributes();
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
  </div>

  <?php
    // Connect login variables to form input.
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

  <?php
  if (isset($email, $password, $id)){

    // Get login details.
    function login($set_account, $set_password, $set_profile_id)
    {
      $account = $set_account;
      $password = $set_password;
      $profile_id = $set_profile_id;
      $login_details = array($account, $password, $profile_id);
      return $login_details;
    }

    $login_details = login($email, $password, $id);

    // Connect to account.
    if (isset($login_details)) {
      $ga = $report_obj->connect_account($login_details[0], $login_details[1], $login_details[2]);
    }

    // Insert Snippet 1 here from extra_code.txt; 'Advertising' category.

    // Calculate total score for 'Acquisition' category.
    $acquisition_subscores = array();
    array_push($acquisition_subscores, $report_obj->request_report($ga, $attributes_obj->build_attribute($attributes_obj->social_net()))); // Subscore for 'Social Networking' attribute.
    $posts_count = wp_count_posts(); // Number of blogs.
    $published_posts_count = $posts_count->publish; // Number of published blogs.
    $comments_count = 7; // Number of total comments.
    $posts_comments_count = $published_posts_count * $comments_count; // Total blogs * Total comments.
    array_push($acquisition_subscores, $posts_comments_count); // Subscore for 'Blogging' attribute.
    $acquisition_score = array_sum($acquisition_subscores); // Total score for 'User Acquisition' category.

    // Calculate total score for 'Usability' category.
    $usability_subscores = array();
    array_push($usability_subscores, $report_obj->request_report($ga, $attributes_obj->build_attribute($attributes_obj->site_speed()))); // Subscore for 'Site Speed' attribute.
    $usability_score = array_sum($usability_subscores); // Total score for 'Usability' category.

    // Calculate total score for 'Engagement' category.
    $engagement_subscores = array();
    array_push($engagement_subscores, $report_obj->request_report($ga, $attributes_obj->build_attribute($attributes_obj->new_users()))); // Subscore for 'New Users' attribute.
    array_push($engagement_subscores, $report_obj->request_report($ga, $attributes_obj->build_attribute($attributes_obj->existing_users()))); // Subscore for 'Existing Users' attribute.
    array_push($engagement_subscores, $report_obj->request_report($ga, $attributes_obj->build_attribute($attributes_obj->user_loyalty()))); // Subscore for 'User Loyalty' attribute.
    $engagement_score = array_sum($engagement_subscores); // Total score for 'User Engagement' category.

    // Insert Snippet 2 here from extra_code.txt; 'E-Commerce' category.

    // Calculate the Performance Index (aggregage of all categories' scores).
    static $index;
    $index = $acquisition_score + $usability_score + $engagement_score;

    // Get current blog/website ID.
    $current_blog_id = get_current_blog_id();   

    // Get current website URL.
    $site_url = get_site_url();

    // Get website's age.
    $site_age = 125; // In days.

    // Normalise website's index and age.
    $normalise_obj->normalise_age_index($site_age, $index);

    ?>

    <!-- Display pie chart. -->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
    jQuery( document ).ready(function() {
      jQuery('#index').html('<center><font color="black"><h2>Website\'s Performance Index: <?php echo $index; ?> %</h2>The Index represents the cumulative score of metrics from your website.<br> Click on any metric category below to find out more.<br></font></center>');
    });
    google.load("visualization", "1", {packages:["corechart"]});
    google.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['Category',    'Subscore'],
        ['Acquisition', <?php echo intval($acquisition_score); ?>],
        ['Usability',   <?php echo intval($usability_score); ?>],
        ['Engagement',  <?php echo intval($engagement_score); ?>]
        ]);
      var options = {
        title: 'CATEGORIES',
        chartArea: {left:20,top:20,width:500,height:300},
        pieHole: 0.4
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

  }
  ?>

  <div id="login"> <!-- Display login form. -->
    <?php if (!isset($login_details)) { ?>
      <fieldset class="clearfix">
        <form method="post">
          <p><span class="fontawesome-envelope"></span><input type="email" name="email" placeholder="Google Analytics Email" value="<?php echo $email; ?>" required></p> <!-- JS because of IE support; better: placeholder="Username" -->
          <p><span class="fontawesome-lock"></span><input type="password" name="password" placeholder="Google Analytics Password" value="<?php echo $password; ?>" required></p> <!-- JS because of IE support; better: placeholder="Username" -->
          <p><span class="fontawesome-user"></span><input type="id"  name="id" placeholder="Website Profile ID eg. 12345678" value="<?php echo $id; ?>" required></p> <!-- JS because of IE support; better: placeholder="Password" -->
          <p><input type="submit" value="Sign In"></p>
        </form>
      </fieldset>
    <?php } ?>
  </div>

  <?php if (isset($login_details)) { ?>
    <div style="width:850px; height:550px; background-color:#ffffff;">
        <div id="index" style="width: 850px; height: 150px; margin-top:50px;"></div>
        <div id="piechart" style="width: 500px; height: 300px; float:left;"></div>
        <div id="description" style="width: 300px; height: 100px; float:right; margin-right:10px; margin-top:20px; z-index: 45;"></div>
    </div>
  <?php } ?>



  </body>

</html>