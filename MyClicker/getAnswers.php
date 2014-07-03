<?php 
session_start();

include("config.php");
 if (isset($_POST['inputsession']) and isset($_POST['studentID'])){
    $session = htmlspecialchars(stripslashes(trim($_POST['inputsession'])));
    $student = htmlspecialchars(stripslashes(trim(preg_replace("/[^a-zA-Z0-9]+/", "",$_POST['studentID']))));
    $channel = htmlspecialchars(stripslashes(trim($_POST['inputchannel'])));
    $answer =   htmlspecialchars(stripslashes(trim($_POST['answer'])));
 }
 else {
     header('location:index.html?msg='.$session);
 }
      
       try{
            $con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
            $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            $sql = "INSERT INTO answers (sessionId, studentId, channel, answer, savedat)
                VALUES (:session, :student, :channel, :answer, now())";


            $stmt = $con->prepare( $sql );
            $stmt->bindValue( "session", $session, PDO::PARAM_STR );
            $stmt->bindValue( "student", $student, PDO::PARAM_STR );
            $stmt->bindValue( "answer", $answer, PDO::PARAM_STR);
            $stmt->bindValue( "channel", $channel, PDO::PARAM_STR);
           
            $stmt->execute();
            $_SESSION['sessionId'] = $session;
            $_SESSION['channel'] = $channel;
                header('location:success.php'); 

        }catch (PDOException $e) {
            echo $e->getMessage()." /getAnswer";	
            echo $e->getCode();

     }
?>

 