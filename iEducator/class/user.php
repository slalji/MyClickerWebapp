<?php


 /*
  * Every registration form needs basic inputs, username password and all inputs need to be validated
  * and inserted finally into a database, therefore class allows oops functionality
  */
 class Users {
         public $id = null;
	 public $username = null;
	 public $password = null;
         public $course = null;
         public $crname=null;
         public $salt = "Zo4rU5Z1YyKJAASY0PT6EUg7BBYdlEhPaNLuxAwU8lqu1ElzHv0Ri7EM6irpx5w";
         public $secret= 'M6irpx5w';
         public $errmsg_arr = array();
         
	 
		 
	 public function __construct( $data = array() ) {
                 if( isset( $data['username'] ) ) $this->username = stripslashes( strip_tags( $data['username'] ) );
		 if( isset( $data['password'] ) ) $this->password = stripslashes( strip_tags( $data['password'] ) );
                 if( isset( $data['course'] ) ) $this->course = stripslashes( strip_tags( $data['course'] ) );
                 if( isset( $data['crname'] ) ) $this->crname = stripslashes( strip_tags( $data['crname'] ) );

	 }
	 
	 public function storeFormValues( $params ) {
		//store the parameters 
             
		$this->__construct( $params ); 
	 }
	 
	 public function userLogin() {
              
		 try{
                     
			$con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
			$con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			$sql = "SELECT channel FROM members WHERE email = :username  AND password = :password  LIMIT 1";
                      
			 
			$stmt = $con->prepare( $sql );
			$stmt->bindValue( "username", $this->username, PDO::PARAM_STR );
			$stmt->bindValue( "password", hash("sha1", $this->password . $this->salt), PDO::PARAM_STR );
			$stmt->execute();
                         
                        $data = $stmt->fetch(PDO::FETCH_ASSOC);  
                        $valid  = $data['channel'];  
                     
			$con = null; 
                        return $valid;
			
		 }catch (PDOException $e) {
			  echo $e->getMessage()." userLogin";
			                 
                        return -1;
		 }
	 }
         
          public function validate(){
           
             try{
			$con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
			$con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			$sql = "SELECT email FROM members WHERE email = :username LIMIT 1";
                       
			 
			$stmt = $con->prepare( $sql );
			$stmt->bindValue( "username", $this->username, PDO::PARAM_STR );
			$stmt->execute();
                        
                        $num_rows = $stmt->rowCount();
                        if ($num_rows >0 )
                             $this->errmsg_arr[] = "Username, <i>".$_POST['username']."</i>, already exists";
                        
                         //check password validity
                        $pwd = $this->password; 
                      /*   if(!preg_match((?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$), $_POST['password']):
                       * Could have used above regex to check password valid, but I wanted to send precise message to let 
                       * them know where they are wrong with their password
                       */
                      if (strlen($pwd) < 8) {
                           $this->errmsg_arr[] = "Password too short! Minimum of 8 characters";
                      }


                      if (!preg_match("#[0-9]+#", $pwd)) {
                           $this->errmsg_arr[] = "Password must include at least one number!";
                      }

                      if (!preg_match("#[a-zA-Z]+#", $pwd)) {
                           $this->errmsg_arr[] = "Password must include at least one letter!";
                      }     
                       //check password match
                       if( $pwd != $_POST['conpassword'] ) {
                      //echo "Password and Confirm password not match";
                               $this->errmsg_arr[] = "Password and Confirm password not match";
                       }  
                       if( $_POST['secret'] != $this->secret ) {
                      //echo "Password and Confirm password not match";
                               $this->errmsg_arr[] = "Invitation Code not match ";
                       } 
              
              return   $this->errmsg_arr;
             
                    
             }catch (PDOException $e) {
			  echo $e->getMessage()." validate username";                 
                    return -1;
		 }
                    
            
              
             
         }
	 /*
          * randomize array of Mag  numbers and save them to user's database to ensure no survey is done twice
          */
	  public function register() {
           
		 $rand = rand();
                            

              try{
			$con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
			$con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			$sql = "INSERT INTO members(email, password, channel, course, date) VALUES(:username, :password, :rand, :course, now());"
                                . "INSERT INTO courses(email, course, crname) VALUES(:username, :course, :crname);";
                      

			$stmt = $con->prepare( $sql );
			$stmt->bindValue( "username", $this->username, PDO::PARAM_STR );
			$stmt->bindValue( "password", hash("sha1", $this->password . $this->salt), PDO::PARAM_STR );
			$stmt->bindValue( "rand", $rand, PDO::PARAM_INT);
                        $stmt->bindValue( "course", $this->course, PDO::PARAM_STR);
                        $stmt->bindValue( "crname", $this->crname, PDO::PARAM_STR);
                        
                        $stmt->execute();
                        // login the register user if all good                         
                        //$this->userLogin(); 
                        
                        //send channel via get, javascript messanger gets channel via get only
                        return $rand;
                        
		 }catch (PDOException $e) {
			echo $e->getMessage();	
                        echo $e->getCode();
                       
		 }
	 }
         

        // Generate a random character string
        public function rand_str()        {
            $length = 32;
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';

            // Length of character list
            $chars_length = (strlen($chars) - 1);

            // Start our string
            $string = $chars{rand(0, $chars_length)};

            // Generate random string
            for ($i = 1; $i < $length; $i = strlen($string))
            {
                // Grab a random character from our list
                $r = $chars{rand(0, $chars_length)};

                // Make sure the same two characters don't appear next to each other
                if ($r != $string{$i - 1}) $string .=  $r;
            }

            // Return the string
            return $string;
        }

 }
 
?>