<?php 

session_start();

/*
 * If register, validate input, create and save new user to database and allow login
 * Else show error messages and allow them to make corrections and try again
 * Use JQuery Ajax call to allow distinict username by check database
 * Inviation code ensure only those that got email with that secrete password can register
 */
	include("config.php");
        include("class/user.php");
  // 
    $ch='';
    
    if( isset( $_POST['username'] )  ) {
     
	$usr = new Users;
       
	$usr->storeFormValues( $_POST );        
        $ch = $usr->userLogin(); 
       
        if ($ch == ''){   
            $_SESSION["authenticated"]= 'false';          
            header('location:index.html?err=1');
           
        }
        else{
            $_SESSION["authenticated"]= 'true'; 
            header('location:sessionStart.php?ch='.$ch);   
        }
                     
       
    }
    
        
       
        
     
?>
 