<?php
session_start();
include("../config/db.php");
include("../function.php");

if(isset($_POST['register'])){

    $first = $_POST['first'];
    $last = $_POST['last'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];
    $profile = $_FILES['profile']['name'];
    $fileName = upload($profile, $_FILES['profile']['tmp_name']);
    
    $type = null;
    $msg = null;

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        if(emailValidate($email,$conn)){
            $type = "error";
            $msg = "This email is already Exits";
        }else{
            if($pass === $cpass){
                
                if( $fileName == 'fnu'){
                    $type = "error";
                    $msg = "File Not Found";
                }elseif($fileName == "ift"){
                    $type = "error";
                    $msg = "Invalid File Type";
                }else{
                    $pass = md5($pass);
                    // $pass = password_hash($pass,PASSWORD_BCRYPT);
                    $sql = "INSERT INTO 
                    users(firstname,lastname,email,password,img,created_at)
                    VALUES('$first','$last','$email','$pass','$fileName',NOW())";
                    if($conn->query($sql)){
                        $type = "success";
                        $msg = "User Registered Successfully";
                    }else{
                        $type = "error";
                        $msg = "Something went wrong";
                    }
                }

            }else{
                $type = "error";
                $msg = "Password did not match with confirm password";
            }
        }
      } else {
        $type = "error";
        $msg = "This is not an email";
      }
      header('Location: register.php?type='.$type.'&'.'msg='.$msg);
}

function emailValidate($email,$conn)
{
    $sql = "SELECT email FROM users WHERE email = '$email'";
    $res = $conn->query($sql);
    if($res->num_rows > 0){
        return true;
    }else{
        return false;
    }
}


// login
if(isset($_POST['login'])){

    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $sql = "SELECT id,password,firstname FROM users WHERE email = '$email'";
    $res = $conn->query($sql);
    if($res->num_rows > 0){
        $data = $res->fetch_assoc();
        if(md5($pass) == $data['password']){

            $_SESSION['user_id'] = $data['id'];
            $_SESSION['name'] = $data['firstname'];
            
            header('Location: ../public/');
        }else{
            echo "password not match";
        }
    }else{
        return false;
    }
    // echo "passed";
}