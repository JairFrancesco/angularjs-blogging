<?php

include_once('config/config.php');

    $query = "SELECT * FROM post";

    $result = mysqli_query($connect,$query);

    $answer = array();
    if($result){
		while($row = mysqli_fetch_array($result)){
			array_push($answer, array('title'=>$row[1], 'description'=>$row[2], 'username'=>$row[3]));
		}
	
		echo json_encode(array("result"=>$answer));
	}
?>