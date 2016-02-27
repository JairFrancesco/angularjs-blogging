<?php

include_once('config/config.php');

        $post = json_decode(file_get_contents("php://input"));
		
		$title = test_input($post->title);
		$description = test_input($post->description);
		$username = test_input($post->username);
		$userId = test_input($post->user);
		
		 if($title && $description && $username && $userId){
			 
			 $title = sanitize($connect, $title);
			 $description = sanitize($connect, $description);
			 $username = sanitize($connect, $username);
			 
			$query="INSERT INTO post(title, description, username, user) VALUES ('$title', '$description', '$username', '$userId')";
			
			$result = mysqli_query($connect, $query);
			
			 if ($result) {
				echo  json_encode($result);
			} else {
				echo  json_encode($result);
			}		
			 	
		 }else{
			 	echo  json_encode($result);
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