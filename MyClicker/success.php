<?php
 session_start();  
 $channel = htmlspecialchars(stripslashes(trim($_SESSION['channel'])));
 $session = htmlspecialchars(stripslashes(trim($_SESSION['sessionId'])));

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="favicon.ico">
     
    <title>Theme Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="../../dist/css/bootstrap-theme.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/theme.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
<SCRIPT type="text/javascript">    
             window.history.forward();
             function noBack() { 
                  window.history.forward(); 
             }
        </SCRIPT>
  </head>

  <body role="document" xonload="noBack();" onpageshow="if (event.persisted) noBack();" onunload="">

      <!-- Fixed navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">MyClicker.ca</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li ><a href="index.php">Subscribe</a></li>
            <li><a href="gchart2.php?fullpage=1">Full Screen</a></li>
            <?php echo'<li class="active"><a href="answerForm.html?ch='.$channel.'" >Next</a>'; ?>
           <?php echo '<META http-equiv="refresh" content="1;URL= http://myclicker.ca/answerForm.html?ch='.$channel.'">'; ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
    <div class="container theme-showcase" role="main">

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron">
          <h1>Submitted Successfully !</h1>
            <h3>Results for: <?php  echo $session; ?> Channel: <?php   echo $channel?> </h3>
      </div> 



 </div> <!-- /container -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>
    <script src="js/docs.min.js"></script>
  </body>
</html>

