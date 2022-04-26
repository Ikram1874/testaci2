
<?php
    require("../function.php");
    require("../layouts/navbar.php");
    require("../config/db.php");

if(isset($_REQUEST['id'])){
    $id = $_REQUEST['id'];
    $user = $_SESSION['user_id'];
    $sql = "SELECT * From posts WHERE id = $id and user_id = $user";
    $res = $conn->query($sql);

    if($res->num_rows > 0){

        $data = $res->fetch_assoc();
?>

    <h1 class="mt-4">Update Post</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <?if(isset($_GET['type']) && isset($_GET['msg'])){?>
    <div class="alert alert-<?= ($_GET['type']=='error'? 'danger': 'success')?> alert-dismissible fade show text-capitalize" role="alert">
        <strong class="text-uppercase"><?= $_GET['type']?>!</strong> <?= $_GET['msg']?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?}?>
    <div class="card">
        <div class="card-body">
            <form class="form" method="post" action="post-data.php" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="title">Title</label>
                        <input type="title" class="form-control" name="title" id="title" value="<?= $data['title']?>">
                        <input type="hidden"  name="id"  value="<?= $data['id']?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="subtitle">Sub-Title</label>
                        <input type="subtitle" class="form-control" name="subtitle" id="subtitle" value="<?= $data['sub_title']?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="details">Add Post Details</label>
                        <textarea class="form-control" id="details" name="details"><?= $data['details']?></textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="file">Add Image</label>
                        <input type="file" name="img" class="form-control" id="file" accept="image/*">
                    </div>
                    <div class="form-group col-md-6 mt-2">
                        <!-- <span>Image</span> -->
                        <img src="../assets/img/<?= $data['img']?>" width="200">
                        <input type="hidden" value="<?= $data['img']?>" name="old-img">
                    </div>

                </div> 
                <button type="submit" name="update" class="btn btn-primary mt-3">Post</button>
            </form>
         </div>
    </div>
<?
}
else{
    echo "Data Not Found";
}
}else{
    
    echo "<script> location.replace('all-post.php'); </script>";
}
    require_once("../layouts/footer.php");
?>