<?php

include "config.php";

if( isset( $_REQUEST['username'] ) and !isset( $_REQUEST['password'] ) ) {
     $username = (stripslashes(trim($_REQUEST['username'])));
     
	try{
                     
            $con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
            $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            $sql = "SELECT channel FROM members WHERE email = :username  LIMIT 1";


            $stmt = $con->prepare( $sql );
            $stmt->bindValue( "username", $username, PDO::PARAM_STR );
            
            $stmt->execute();

             $data = $stmt->fetch(PDO::FETCH_ASSOC);  
             $rows = $stmt->rowCount();
           
             
            $con = null; 
            echo $rows;//"".$data['channel'];
            
            

        }catch (PDOException $e) {
                 //echo $e->getMessage()." check.php";

               echo -1;
        }
                     
       
    }
    
    
?>