<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
if(isset($_GET['edit'])){
  $id = $_GET['edit'];
}
?>

<div class="grid_10">

  <div class="box round first grid">
    <h2>Update Category</h2>
    <?php
    if(isset($_POST['name'])){
      $name = $_POST['name'];
      if(empty($name)){
        echo "<span class='error' >empty feild can,t insert.</span>";
      }else{
        $query = "update tbl_category set name = '$name' where id=$id";
        $result = $db->update($query);
        if($result){
          echo "<span class='success' >Data Updated.</span>";
        }else{
          echo "<span class='error' >Data not Updated.</span>";
        }
      }
    }
    ?>
    <div class="block copyblock">
      <?php
      $query = "select * from tbl_category where id =$id";
      $updatecat =$db-> select($query);
      while ($result = $updatecat->fetch_assoc()) {
        ?>
        <form action="" method="post">
          <table class="form">
            <tr>
              <td>
                <input type="text" name="name" placeholder="Enter Category Name..." class="medium" value="<?= $result['name']; ?>"/>
              </td>
            </tr>
            <tr>
              <td>
                <input type="submit" name="submit" Value="Update" />
              </td>
            </tr>
          </table>
        </form>
      <?php } ?>
    </div>
  </div>
</div>
<?php include 'inc/footer.php'; ?>
