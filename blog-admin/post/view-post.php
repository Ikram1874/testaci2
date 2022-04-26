<?php
require("../function.php");
require("../layouts/navbar.php");
require("../config/db.php");

if(isset($_REQUEST['id'])){
    $id = $_REQUEST['id'];
    $user = $_SESSION['user_id'];
    $sql = "SELECT * From posts WHERE id = $id and user_id = $user ORDER BY created_at DESC ";
    $res = $conn->query($sql);

    if($res->num_rows > 0){

        $data = $res->fetch_assoc();


?>
<h1 class="mt-4"><?= $data['title']?></h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active"><?= $data['sub_title']?></li>
    </ol>
    <div class="d-flex">
        <small class="m-2">Post date: <?= $data['created_at']?> </small>
        <small class="m-2">Last Update: <?= $data['updated_at']?></small>
    </div>
    <div>
        <img src="../assets/img/<?= $data['img']?>" width="250" alt="<?= $data['title']?>">
        <p>
        <?= $data['details']?>
        </p>
        <div class="d-flex">
            <button class="btn btn-success m-4">Edit</button>
            <button class="btn btn-danger m-4">Delete</button>
        </div>
    </div>

<?php
}
else{
    echo "Data Not Found";
}
}else{
    
    echo "<script> location.replace('all-post.php'); </script>";
}
    require_once("../layouts/footer.php");
    $conn->close();
?>