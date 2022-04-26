
<?php
    require("../function.php");
    require("../layouts/navbar.php");
?>

    <h1 class="mt-4">Create a Post</h1>
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
                        <input type="title" class="form-control" name="title" id="title">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="subtitle">Sub-Title</label>
                        <input type="subtitle" class="form-control" name="subtitle" id="subtitle">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="details">Add Post Details</label>
                        <textarea class="form-control" id="details" name="details"></textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="file">Add Image</label>
                        <input type="file" name="img" class="form-control" id="file" accept="image/*">
                    </div>
                </div> 
                <button type="submit" name="post" class="btn btn-primary mt-3">Post</button>
            </form>
         </div>
    </div>
<?
    require_once("../layouts/footer.php");
?>