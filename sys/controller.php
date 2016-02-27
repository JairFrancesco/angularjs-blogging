<?php

error_reporting(0);
$call = $_GET["mission"];

switch($call)
{
    case create :
        create();
        break;
     case read :
        readAll();
        break;
     case readID :
        readId();
        break;
      case deleteID :
        deleteID();
        break;
    default:
        echo "Please Enter Parameter";
}



function create()
{
    $servername = "localhost";
    $username = "root";
    $password = "Akiki#@2014";
    $dbname = "murat_api";


    $post = json_decode(file_get_contents("php://input"));

    $firstname = $post->firstName;
    $lastname = $post->lastName;
    $index_n = $post->index;
    $faculty = $post->major;
    $b_day = $post->birthDate;
    $issue_d = $post->issueDate;
    $ex_date = $post->expireDate;
    $image = $post->uploadImage;


    if($firstname && $lastname && $index_n && $faculty  && $b_day && $issue_d && $ex_date && $image){

            try {
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                // set the PDO error mode to exception
                 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                 $sql = "INSERT INTO users1 (firstname,lastname, index_n, faculty, b_day, issue_d, ex_date, image) VALUES ('$firstname','$lastname','$index_n','$faculty','$b_day','$issue_d','$ex_date', '$image')";
                 //use exec() because no results are returned
                 $conn->exec($sql);
                 
                 echo json_encode(array("success"=>"New record created successfully"));
            }
            catch(PDOException $e){
                echo $sql . "<br>" . $e->getMessage();
            }

     }else{
       echo json_encode(array("error"=>"Sorry!, omething went wrong."));
       echo json_encode(array("$firstname, $lastname, $index_n, $faculty, $b_day, $issue_d, $ex_date, $image"));
     }     

    

    $conn = null;
}


function readAll(){

    include_once('config/config.php');
    


        $query = "SELECT * FROM users1 ORDER BY index_n";

        $result = mysqli_query($connect,$query);

        $answer = array();
        if($result){
            while($row = mysqli_fetch_array($result)){
                array_push($answer, array('id'=>$row[0], 'firstName'=>$row[1], 'lastName'=>$row[2], 'index'=>$row[3], 'faculty'=>$row[4], 'birthDate'=>$row[5], 'issueDate'=>$row[6], 'expireDate'=>$row[7], 'imagePath'=>$row[8]));
            }
        
            echo json_encode(array("result"=>$answer));
        }else{
            echo json_encode(array("empty"=>"Sorry, Nothing found at the moment"));
        }

  
}


function readId(){
     include_once('config/config.php');

     if(isset($_GET["id"])){

        $id = $_GET["id"];

        $query = "SELECT * FROM users1 WHERE index_n = '$id'";

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

     }
}


function deleteID(){

    include_once('config/config.php');

     if(isset($_GET["del"])){

        $id = $_GET["del"];

        $query = "DELETE FROM users1 WHERE index_n = '$id'";

        $result = mysqli_query($connect,$query);

    
        if($result){
            echo json_encode(array("result"=>Delete));
        }else{
            echo json_encode(array("empty"=>"Sorry, Nothing found at the moment"));
        }

     }

}



?>