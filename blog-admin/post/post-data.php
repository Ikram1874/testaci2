<?php
include("../config/db.php");
include("../function.php");

if(isset($_POST['post'])){

    $title = $_POST['title'];
    $subtitle = $_POST['subtitle'];
    $detail = $_POST['details'];
    $img = $_FILES["img"]['name'];
    $user = $_SESSION['user_id'];

    $type = null;
    $msg = null;

    $fileName = upload($img, $_FILES['img']['tmp_name']);

    if( $fileName == 'fnu'){
        $type = "error";
        $msg = "File Not Found";
    }elseif($fileName == "ift"){
        $type = "error";
        $msg = "Invalid File Type";
    }else{
            $sql = "INSERT INTO 
                posts(user_id,title,sub_title,details,img,created_at) 
                VALUES('$user','$title','$subtitle','$detail','$fileName',NOW())";

                if($conn->query($sql)){
                    $type = "success";
                    $msg = "data successfully added";
                    
                }else{
                    $type = "error";
                    $msg = "Data not saved";
                }
  }

header('Location: post.php?type='.$type.'&'.'msg='.$msg);

    
}

if(isset($_POST['update'])){
    $user = $_SESSION['user_id'];
    $id = $_POST['id'];
    $title = $_POST['title'];
    $detail = $_POST['details'];
    $old_img = $_POST['old-img'];
    $img = $_FILES["img"]['name'];
    $subtitle = $_POST['subtitle'];
    $fileName = upload($img,$_FILES["img"]['tmp_name']);

    $type = null;
    $msg = null;
    
    if($img > 0){

        $target_dir = "../assets/img/";

            if($fileName == 'ift'){
                $type = "error";
                $msg = "Invalid File Type";
            }elseif($fileName == 'fnu'){
                $type = "error";
                $msg = "File Not Uploaded";
            }else{
                if(unlink($target_dir.$old_img)){

                    $sql = "UPDATE posts SET 
                    title = '$title',
                    sub_title = '$subtitle', 
                    details = '$detail',
                    img = '$fileName'
                    WHERE id = '$id' and user_id = '$user'";

                    if($conn->query($sql)){
                        $type = "success";
                        $msg = "Data Updated Successfully";
                    }else{
                        $type = "error";
                        $msg = "Failed to update Data";
                    }

                }else{
                    $type = "error";
                    $msg = "Img Not Found!";
                }
         }

    }
    else{
        $sql = "UPDATE posts SET 
                title = '$title',
                sub_title = '$subtitle', 
                details = '$detail' 
                WHERE id = '$id' and user_id = '$user'";

        if($conn->query($sql)){
            $type = "success";
            $msg = "Data Updated Successfully";
        }else{
            $type = "error";
            $msg = "Failed to update Data";
        }
    }
    header('Location: update-post.php?id='.$id.'&type='.$type.'&'.'msg='.$msg);
}


if(isset($_POST['delete'])){
    $id = $_POST['id'];
    $img = $_POST['img'];
    $target_dir = "../assets/img/";
    $user = $_SESSION['user_id'];
        $sql = "DELETE FROM posts WHERE id = '$id' and user_id = $user";
        if(!$conn->query($sql)){
            echo "Something Went Wrong";
        }else{
            if(unlink($target_dir.$img)){
                 header('Location: all-post.php');
            }else{
                echo "Something Went Wrong";
            }
        }
}



$conn->close();