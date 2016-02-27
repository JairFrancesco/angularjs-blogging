<?php

include_once('config/config.php');

    $query = "SELECT * FROM users1";

    $result = mysqli_query($connect,$query);

    $answer = array();
    if($result){
		while($row = mysqli_fetch_array($result)){
			array_push($answer, array('firstName'=>$row[1], 'lastName'=>$row[2], 'index'=>$row[3], 'faculty'=>$row[4], 'birthDate'=>$row[5], 'issueDate'=>$row[6], 'expireDate'=>$row[7], 'imagePath'=>$row[8]));
		}
	
		echo json_encode(array("result"=>$answer));
	}else{
		echo json_encode(array("empty"=>"Sorry, Nothing found at the moment"));
	}
?>