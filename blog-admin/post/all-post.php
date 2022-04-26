<?php
    require("../function.php"); 
    require("../layouts/navbar.php");
    require("../config/db.php");

    $id = $_SESSION['user_id'];
    $sql = "SELECT * From posts WHERE user_id = '$id' ORDER BY created_at DESC ";
    $res = $conn->query($sql);

    // if($res->num_rows > 0){
        
    //     // var_dump($row);
    //     while($row = $res->fetch_assoc())
    //     {
    //         echo $row['id'] ;
    //         echo $row['title'] ;
    //         echo $row['sub_title'] ;
    //         echo $row['details'] ;
    //     }
    // }
   

?>
<h1 class="mt-4">All Posts</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Title</th>
      <th scope="col">Sub-Title</th>
      <th scope="col">Details</th>
      <th scope="col">Image</th>
      <th scope="col">Post Date</th>
      <th scope="col">Last Update</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
      <?
      if($res->num_rows > 0){
        
        // var_dump($row);
        $count = 0;
        while($row = $res->fetch_assoc())
        {$count++;
      ?>
    <tr>
      <th scope="row"><?= $count?></th>
      <td><?echo $row['title'] ;?></td>
      <td><?echo $row['sub_title'] ;?></td>
      <td><?echo $row['details'] ;?></td>
      <td>
          <img src="../assets/img/<?echo $row['img'] ;?>" width="100">
        </td>
      <td><?echo $row['created_at'] ;?></td>
      <td><?echo $row['updated_at'] ;?></td>
      <td>
          <a href="view-post.php?id=<?= $row['id']?>" class="badge rounded-pill bg-warning"><i class="fa fa-eye" aria-hidden="true"></i> View</a>
          <a href="update-post.php?id=<?= $row['id']?>" class="badge rounded-pill bg-primary"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a>
          <form action="post-data.php" method="post">
              <input type="hidden" name="img" value="<?= $row['img']?>">
              <input type="hidden" name="id" value="<?= $row['id']?>">
              <button class="badge rounded-pill bg-danger border-0" name="delete" onClick="return confirm('Please confirm deletion')"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
          </form>
      </td>
    </tr>
    <? 
     }
    }else{
    ?>
    <tr>
        <span  class="text-danger">No Record Found!</span>
    </tr>
    <?}?>
  </tbody>
</table>

<?
    require_once("../layouts/footer.php");
    $conn->close();
?>