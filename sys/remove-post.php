<?php

include_once('config/config.php');

        $post = json_decode(file_get_contents("php://input"));
		
		$userId = test_input($post->user);
		$title = test_input($post->title);
		
		 if($userId){
			 $user = sanitize($connect, $username);
			 
			$query="DELETE FROM post WHERE user = '$userId' AND title = '$title'";
			
			$result = mysqli_query($connect, $query);
			
			 if ($result) {
				echo json_encode(array("success"=>"Your post was successfully deleted"));
			} else {
				echo json_encode(array("failure"=>"Sorry, something went wrong"));
			}		
			 	
		 }else{
			 	echo json_encode(array("failure"=>"Sorry, something went wrong"));
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