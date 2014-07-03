<?php
session_start();
// -----> Query MySQL and parse into JSON below. <------

include("config.php");

$ans = array();
$projid = null;
$hours = null;
$session = '';
if (isset($_REQUEST['sessionId'])){
    $session = htmlspecialchars(stripslashes(trim($_REQUEST['sessionId'])));
}
 else {
    header('location:index.html?error=graph');
}


    
//setup Json array
$rows = array();
  $table = array();
  $table['cols'] = array(
    
       array('id' => "",'role' => 'style', 'type' => 'string')
     
      
);
 try{
                     
            $con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
            $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
             $sql = "SELECT answer, COUNT( answer ) 
                        FROM answers
                        WHERE answer = (  'A' ) and sessionId = :session
                        UNION SELECT answer, COUNT( answer ) 
                        FROM answers
                        WHERE answer = (  'B' )  and sessionId = :session
                        UNION SELECT answer, COUNT( answer ) 
                        FROM answers
                        WHERE answer = (  'C' )  and sessionId = :session
                        UNION SELECT answer, COUNT( answer ) 
                        FROM answers
                        WHERE answer = (  'D' )  and sessionId = :session
                        GROUP BY answer";  


            $stmt = $con->prepare( $sql );
            $stmt->bindValue( "session", $session, PDO::PARAM_STR );
            $stmt->execute();

            //$data = $stmt->fetch(PDO::FETCH_ASSOC);  
            //$valid  = $data['channel'];  

            
            /* Extract the information from $result */

            while($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $temp = array();
                // the following line will be used to slice the Pie chart
                $temp[] = array('v' => (string) $r['answer']); 

                // Values of each slice
                $temp[] = array('v' => (int) $r['COUNT( answer )']); 
                switch ( $r['answer']){
                    case 'A': $temp[] = array('v' => (string) "blue");
                        break;
                    case 'B': $temp[] = array('v' => (string) "red");
                        break;
                    case 'C': $temp[] = array('v' => (string) "orange");
                        break;        
                    case 'D': $temp[] = array('v' => (string) "green");
                        break;

                }    
         
                $rows[] = array('c' => $temp);
            }
            $con = null;
            $table['rows'] = $rows;

            // convert data into JSON format
            $jsonTable = json_encode($table);
             
            echo $jsonTable;

     }catch (PDOException $e) {
              echo $e->getMessage()." graph";

     }

?>
