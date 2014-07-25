<?php
/**
* dashboard_2.php
* Displays attributes subscores.  
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
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
  </head>

  <body>

    <style>
    .row {
      margin-right: -15px;
      margin-left: -15px;
    }

    .row:before,
    .row:after {
      display: table;
      content: " ";
    }

    .row:after {
      clear: both;
    }

    .row:before,
    .row:after {
      display: table;
      content: " ";
    }

    .row:after {
      clear: both;
    }

    body{
      background-color: #e9e9e9;
      list-style: none;
    }
    body ul{
      list-style: none;
      font-family: arial;
      font-weight: normal;
    }
    .titles{
      text-align: center;
      font-size: 34px;
      font-family: Arial;
      color:#00aded;
      text-transform:uppercase;
      margin-top: 20px;
    }
    .titles ul{
      list-style: none;
    }
    .titles li:nth-child(1){
      float: left;
    }
    .titles li:nth-child(3){
      float: right;
      margin-top: -45px;
    }
    .linebrake{
      width: 100%;
      height: 1px;
      background-color: #d1cfcf;
      margin-top: 1px;
      margin-bottom: 10px;
    }
    .user{
      text-transform:uppercase;
      font-size: 30px;
      color: #6e6e6e;
    }
    .user li:nth-child(1){
      float: left;
    }
    .user li:nth-child(2){
      margin-left: 48%;
    }
    .viewblock{
      height: 36px;
      width: 133px;
      background-color: #CECECE;
      /* float: left; */
      border-radius: 5px;
      margin-left: 51px;
      margin-bottom: 20px;
      font-size: 16px;
      text-align: center;
      padding-top: 6px;
      padding-left:24px;
      color: #ffffff; 
    }
    .viewtext {
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
            font-size: 16px;
            font-family: 'Roboto', sans-serif;
            padding-top: 10px;
            padding-bottom: 10px;
            margin-top: 30px;

        }
            .viewtext a {
            padding-top: 10px;
            padding-bottom: 10px;
            text-decoration: none;
            color:white;
          }
            .viewtext:hover {
              background-color: #008ABD;
            
        }

        #login form input[type="submit"]:hover {
            background-color: #0074a2;
        }
    .panel-group{
      width: 100%;
    }
    .holder{
      margin-top: -40px;
    }
    .viewblock p{
      position: absolute;
    }
    .container{
      width: 85%;
      margin: 0 auto 0 auto;
    }
    .performancestats {
      width: 100%;
      text-align: center;
    }
    </style>

    <!-- Social Networking pie chart -->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
    google.load("visualization", "1", {packages:["corechart"]});
    google.setOnLoadCallback(drawChart);
    
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['Social networking site',    'sessions'],
        ['facebook.com',    14],
        ['m.facebook.com',  3],
        ['plus.google.com', 3],
        ['twitter.com',     1],
        ['linkedin.com',    0]
      ]);
      var options = {
        title: 'Social Networking',
        is3D: true,
        chartArea: {left:150,top:10,width:450,height:300},
        colors:['#0000FF','#0000FF','#FE2E2E','#2E9AFE'],
        legend: {position: 'none'}
      };

      var chart = new google.visualization.PieChart(document.getElementById('sonet_chart'));
      chart.draw(data, options);
    }
    </script>

    <!-- Site Speed gauge chart -->
    <script type='text/javascript'>
    google.load('visualization', '1', {packages:['gauge']});
    google.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['Label', 'Value'],
        ['Load Time', 80]
      ]);
      var options = {
        width: 400, height: 120,
        redFrom: 90, redTo: 100,
        yellowFrom:75, yellowTo: 90,
        minorTicks: 5,
        width:540,
        height:310,
      };

      var chart = new google.visualization.Gauge(document.getElementById('speed_chart'));
      chart.draw(data, options);
    }
    </script>

    <!-- User Loyalty geo chart -->
    <script type='text/javascript'>
    google.load('visualization', '1', {'packages': ['geochart']});
    google.setOnLoadCallback(drawRegionsMap);

    function drawRegionsMap() {
      var data = google.visualization.arrayToDataTable([
        ['Country', 'Popularity'],
        ['Germany', 200],
        ['United States', 300],
        ['Brazil', 400],
        ['Canada', 500],
        ['France', 600],
        ['RU', 700]
      ]);
      var options = {
        width:395,
        height:300,
      };
      var chart = new google.visualization.GeoChart(document.getElementById('loyalty_chart'));
      chart.draw(data, options);
    };
    </script>

    <div class="performancestats" style="height:2500px; background-color:#ffffff;">
    <div class="container">
      <div class="row">
        <div class="titles col-md-12">
          <ul>
            <!--<li>attribute</li>
            <li>subscore (%)</li>
            <li>chart</li>-->
          </ul>
          <div class="linebrake"></div>
        </div>
      </div>
      <div class="row">
        <div class="user col-md-12">
          <ul>
            <li>social networking</li>
            <li>18%</li>
            <div class="col-md-4 col-md-offset-8">
              <div class="holder">
                 <div id="sonet_chart" style="width: 500px; height: 300px; float:right;"></div>
                <div class="panel-group" id="accordion">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        
                      </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in">
                      <div class="panel-body">
                       
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </ul>
          <div class="row">
              <div class="">
                <div class="viewtext">
                  <a href="#">Improve Subscore</a>
                </div>
              </div>
          </div>
          <div class="linebrake"></div>
        </div>
      </div>
      
      <div class="row">
        <div class="user col-md-12">
          <ul>
            <li>site speed</li>
            <li>66%</li>
             <div class="col-md-4 col-md-offset-8">
              <div class="holder">
                <div id="speed_chart" style="width: 350px; height: 300px; float:right;"></div>
                <div class="panel-group" id="accordion">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        
                      </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in">
                      <div class="panel-body">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </ul>
          <div class="row">

              <div class="">
                <div class="viewtext">
                  <a href="#">Improve Subscore</a>
                </div>
              </div>
          </div>
          <div class="linebrake"></div>
        </div>
      </div>
      <div class="row">
        <div class="user col-md-12">
          <ul>
            <li>user loyalty</li>
            <li>46%</li>
             <div class="col-md-4 col-md-offset-8">
              <div class="holder">
                <div id="loyalty_chart" style="width: 350px; height: 300px; float:right;"></div>
                <div class="panel-group" id="accordion">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        
                      </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in">
                      <div class="panel-body">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </ul>
          <div class="row">
              <div class="">
                <div class="viewtext">
                  <a href="#">Improve Subscore</a>
                </div>
              </div>
          </div>
          <div class="linebrake"></div>
        </div>
      </div>
    </div>
  </div>

  </body>
  
</html>
