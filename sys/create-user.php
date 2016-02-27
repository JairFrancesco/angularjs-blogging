<?php

include_once('config/config.php');

        $user = json_decode(file_get_contents("php://input"));
		
		$name = test_input($user->name);
		$email = test_input($user->email);
		$password = test_input($user->password);
		
		$check_user_if_exist = "SELECT count(uid) FROM user WHERE email = '$email'";
		$result_check = mysqli_query($connect, $check_user_if_exist);
		
		
		$rows = mysqli_fetch_array($result_check);
		$result_fetch = $rows[0];
		
		if($result_fetch >= 1){
			echo  json_encode(array("exist"=>"Sorry, Email you entered already registered"));
		}else{
			 if($name && $email && $password){
				 
				 $name = sanitize($connect, $name);
				 $email = sanitize($connect, $email);
				 $password = sanitize($connect, $password);
				 
						 
					
					 $password = hash_password($password);
				 
					 $query="INSERT INTO user(name, email, password) VALUES ('$name', '$email', '$password')";
					
					 $result = mysqli_query($connect, $query);
				
					if ($result) {
						echo  json_encode(array("registered"=>"You account was created successful"));
					} else {
						echo  json_encode(array("failed"=>"Please, Fill all the fields correctlly"));
					}		 	 
					
			 }else{			 	    
					  echo  json_encode(array("failed"=>"Please, Fill all the fields correctlly"));
			 }
		}
		 
	 function hash_password($pass){
		 return sha1('$pass');
	 }
		 
	
	
	 function sanitize($sql, $data){
		 return mysqli_real_escape_string($sql, $data);
	 }
	
	 function test_input($data){
		   $data = trim($data);
		   $data = stripslashes($data);
		   $data = htmlspecialchars($data);
		   
		   return $data;
	   }

?>