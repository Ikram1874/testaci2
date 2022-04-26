<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "blogs";

// create connection
$conn = new mysqli($servername,$username,$password,$db);

// check connection
if($conn->connect_error){
    die("Connection Failed:".$conn->connect_error);
}
// $conn->close();