<?php
require_once('class/auth.php');
?>
<html>
        <head>
             <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="dist/css/bootstrap.min.css">
 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/jquery.cookie.js"></script> 
    
 <script>
     /*
      * This javascript sets a timer before capturing the value of the input once button is clicked.
      * the value from PubNub network that gets broacasted as a message arrives with a delay
      * there is no change event for javascript to record, therefore delay will allow time to populate
      * the input box and capture its value
      */
     $(document).ready(function () {
     $("#sendMessageButton").click(function(){
   setTimeout(function() {
        if ( $("#inputsession").val() != ''){
           $.cookie("sessionId", $("#inputsession").val(), {expires: 367});
           $("#tag").append("<li class=list-group-item><a target=_blank href=gchart.php?link="+$.cookie("sessionId")+">"+$.cookie("sessionId"));
       }
   }, 100);
});
     });


 </script>
        </head>
            <body >
                <div class="container">
                   
<!-- Static navbar -->
      <div class="navbar navbar-default" role="navigation">
      
        <div class="navbar-collapse collapse">
     
          <ul class="nav navbar-nav navbar-right">
              <li class="active"><a href="gchart2.php" target="_blank">Full Page</a></li>
             
          </ul>
        </div><!--/.nav-collapse -->
      </div>

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <div class="jumbotron"><h1><a href="http://myclicker.ca"><img src="logoInv.png" width="50" class="img-thumbnail" alt="MyClicker.ca"></a>
          MyClicker, answering is free</h1> </a> 
        <p>Show your question slide and press Start</p>
       
            <div>
                
                <!--<label>Session Id:   </label> -->  
                <input type="text" id=inputsession placeholder=" session id"  type="text" readonly  size="50"/>
            </div>
        <div><!--<label>channel Id:   </label>   -->
<input type="hidden" id=inputchannel placeholder=" channel"    size="50"/> 
<!--<input type="text" id=current placeholder="current"  name="current



"  size="50"/> -->
            </div>

            </div>
                <input  id="sendMessageButton" class="btn btn-lg btn-warning" type="submit" value="Start new question">
            
                <p> </p>
    

    <!-- /container -->
    <h1>Results</h1>
    <div class="indent" >
            <ul class="list-group">
                    <div id="tag">  </div>
            </ul>
              </div>  
               
    <div id="graph"></div>
        
            </div>  
               
                <script src="http://cdn.pubnub.com/pubnub-3.4.4.js"></script>
                <script src="js/messenger.js"></script>
<?php include "gchart2.php";?>
        </body>
</html>
