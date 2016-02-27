<?php

$connect = mysqli_connect('localhost', 'root', '');

if(!$connect){
    die("Sorry! we have encountered an error").mysqli_error();
}else{
    $db = mysqli_select_db($connect, 'blog');
}
?>