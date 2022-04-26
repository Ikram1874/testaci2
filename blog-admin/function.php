<?php
session_start();

function upload($img,$tempName)
{
    $target_dir = "../assets/img/";
    $target_file = $target_dir . basename($img);

    // Select file type
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Valid file extensions
    $extensions_arr = array("jpg","jpeg","png","gif");
    // change image name
    $fileName = time().".".$imageFileType;
     // Check extension
  if( in_array($imageFileType,$extensions_arr) ){
     // Upload file
     if(move_uploaded_file($tempName,$target_dir.$fileName)){
        return $fileName;
     }else{
        return "fnu"; 
     }

  }else{
      return "ift";
  }
  
}

function checkLogin(){
   if(!isset($_SESSION['user_id'])){
      echo "<script> location.replace('../auth/login.php'); </script>";
  }
}

checkLogin();