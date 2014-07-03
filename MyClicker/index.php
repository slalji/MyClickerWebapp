
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="favicon.ico">

    <title>MyClicker, answering is free</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="dist/css/bootstrap-theme.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/theme.css" rel="stylesheet">
    
      <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
      <script src="js/jquery.cookie.js"></script> 
    <script src="js/myclicker.js"></script> 
   
    

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  
  </head>

  <body role="document">   

    <div class="container theme-showcase" role="main">

      <!-- Main jumbotron for a primary marketing message or call to action -->
     <div class="jumbotron">
        <h1><img src="logoInv.png" class="logo" width="10%"> MyClicker, answering is free</h2>
        <p>Subscribe List</p>
        <div class="indent" >
            <ul class="list-group">
               
                <?php
                include("config.php");
               
                 try{
                        $con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
			$con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			$sql = "SELECT channel, courses.course, courses.crname FROM members, courses WHERE members.email = courses.email GROUP BY members.email ";
                        $stmt = $con->prepare( $sql );
			
                        $stmt->execute();
                        while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            
                            echo '<li class="list-group-item"><a href="answerForm.html?ch='.$rows['channel'].'" >'.$rows['course'].':  '.$rows['crname'].'</a>';
                         
                        }
                           
                         
			
		 }catch (Exception $e) {
			  echo $e->getMessage()." userLogin";
			                 
                         
		 }
                
                ?>
              
            </ul>
        </div>
     </div>
   </div> <!-- /container -->  
<footer>
    <p><a href="http://myclicker.ca"><img src="logoInv.png" width="50" class="img-thumbnail" alt="MyClicker.ca"></a>
&copy; Kewl Technologies BC 2014 <a href="#">salma@kewltechnologies.ca</a> <a href="#">604.723.7108</a></p>
</footer>
    

           <!-- Pubnub core JavaScript
                custom messenger.js
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
          <script src="http://cdn.pubnub.com/pubnub-3.4.4.js"></script>
                <script src="js/messenger.js"></script> 
                


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
   
    <script src="dist/js/bootstrap.min.js"></script>
    <script src="js/docs.min.js"></script>
  </body>
</html>

