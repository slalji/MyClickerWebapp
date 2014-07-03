<?php
include ('../config.php');
 try{
                     
    $con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
    $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $sql = "SELECT channel FROM members WHERE email = :username  AND password = :password  LIMIT 1";


    $stmt = $con->prepare( $sql );
    $stmt->bindValue( "username", $this->username, PDO::PARAM_STR );
    $stmt->bindValue( "password", hash("sha1", $this->password . $this->salt), PDO::PARAM_STR );
    $cnt = $stmt->rowCount();


    return $cnt;
    

}catch (PDOException $e) {
      echo $e->getMessage()." userLogin";

    return -1;
}
 ?>