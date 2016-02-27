<?php

include_once('config/config.php');

        $user = json_decode(file_get_contents("php://input"));
		
		$email = test_input($user->email);
		$password = test_input($user->password);
		
		
		if($email && $password){
				 
			 $email = sanitize($connect, $email);
			 $password = sanitize($connect, $password);
									 
			 $query="SELECT * FROM user WHERE email = '{$email}' LIMIT 1";
			 
			 $result = mysqli_query($connect, $query);
			 
			 if($result){
				 
				 while($rows = mysqli_fetch_array($result)){
					 $user_id = $rows['uid'];
					 $user_name = $rows['name'];
					 $user_email = $rows['email'];
					 $pass = $rows['password'];
				 }
				 
				 //$user = array();
				 
				 $password = hash_password($password);
				 
				 if($password == $pass){
					 
					 $token = md5(2);
					 //
					 
					 echo json_encode(array("result"=>"true", "id"=>$user_id, "name"=>$user_name, "email"=>$user_email, "tokenSession"=>$token));
					 
				 }else{
					 echo json_encode(array("error"=>"Username or Password is wrong."));
				 }
			 }else{
				 echo json_encode(array("error"=>"Username or Password is wrongsss.".$pass.'|'.sha1('$password')));
			 }
			
		}else{
			echo json_encode(array("error"=>"Username ex or Password is wrong."));
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