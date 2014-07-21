<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">
    <script language="JavaScript" type="text/javascript" src="js/jquery.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
    <script language="JavaScript" type="text/javascript" src="js/skrollr.js"></script>
    <title>starfish</title>
        <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->


    <script type="text/javascript" src="https://www.google.com/jsapi"></script>

    <!-- pie chart -->
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Work',     11],
          ['Eat',      2],
          ['Commute',  2],
          ['Watch TV', 2],
          ['Sleep',    7]
        ]);

        var options = {
          title: 'My Daily Activities'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
      }
    </script>

  </head>

  <body>
    <div class="container">
      <div class="row">
        <div class="titles col-md-12">
          <ul>
            <li>category</li>
            <li>subscore(%)</li>
            <li>trend</li>
          </ul>
          <div class="linebrake"></div>
        </div>
      </div>
      <div class="row">
        <div class="user col-md-12">
          <ul>
            <li>ADVERTISING</li>
            <li>46%</li>
            <div class="col-md-4 col-md-offset-8">
              <div class="holder">
                <div class="panel-group" id="accordion">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                          GRAPH 
                        </a>
                      </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in">
                      <div class="panel-body">
                        <div id="piechart" style="width: 350px; height: 300px;"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </ul>
          <div class="row">
            <a href="#">
              <div class="viewblock">
                <div class="viewtext">
                  <p>view details</p>
                </div>
              </div>
            </a>
          </div>
          <div class="linebrake"></div>
        </div>
      </div>
      <div class="row">
        <div class="user col-md-12">
          <ul>
            <li>ACQUISITION</li>
            <li>46%</li>
             <div class="col-md-4 col-md-offset-8">
              <div class="holder">
                <div class="panel-group" id="accordion">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                          GRAPH 
                        </a>
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
            <a href="#">
              <div class="viewblock">
                <div class="viewtext">
                  <p>view details</p>
                </div>
              </div>
            </a>
          </div>
          <div class="linebrake"></div>
        </div>
      </div>
      <div class="row">
        <div class="user col-md-12">
          <ul>
            <li>USABILITY</li>
            <li>46%</li>
             <div class="col-md-4 col-md-offset-8">
              <div class="holder">
                <div class="panel-group" id="accordion">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                          GRAPH 
                        </a>
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
            <a href="#">
              <div class="viewblock">
                <div class="viewtext">
                  <p>view details</p>
                </div>
              </div>
            </a>
          </div>
          <div class="linebrake"></div>
        </div>
      </div>
      <div class="row">
        <div class="user col-md-12">
          <ul>
            <li>ENGAGEMENT</li>
            <li>46%</li>
             <div class="col-md-4 col-md-offset-8">
              <div class="holder">
                <div class="panel-group" id="accordion">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                          GRAPH 
                        </a>
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
            <a href="#">
              <div class="viewblock">
                <div class="viewtext">
                  <p>view details</p>
                </div>
              </div>
            </a>
          </div>
          <div class="linebrake"></div>
        </div>
      </div>
      <div class="row">
        <div class="user col-md-12">
          <ul>
            <li>E-COMMERCE</li>
            <li>46%</li>
             <div class="col-md-4 col-md-offset-8">
              <div class="holder">
                <div class="panel-default" id="accordion">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                         GRAPH 
                        </a>
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
            <a href="#">
              <div class="viewblock">
                <div class="viewtext">
                  <p>view details</p>
                </div>
              </div>
            </a>
          </div>
          <div class="linebrake"></div>
        </div>
      </div>
    </div>
  </body>
</html>
