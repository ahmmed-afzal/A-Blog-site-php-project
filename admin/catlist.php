<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<div class="grid_10">
  <div class="box round first grid">
    <h2>Category List</h2>

    <?php
    if(isset($_GET['delete'])){
      $delete =$_GET['delete'];
      $query = "delete from tbl_category where id=$delete";
      $result = $db->delete($query);
      if( $result){
        echo "<span class='success' >Data Deleted.</span>";
      }else{
        echo "<span class='error' >Something went wrong!</span>";
      }
    }
    ?>
    <div class="block">
      <table class="data display datatable" id="example">
        <thead>
          <tr>
            <th>Serial No.</th>
            <th>Category Name</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $query = "select * from tbl_category";
          $category = $db->select($query);
          if($category){
            $id = "";
            while($result =$category->fetch_assoc()){
                $id++;
              ?>
              <tr class="odd gradeX">
                <td> <?= $id; ?> </td>
                <td><?= $result['name']; ?></td>
                <td><a href="edit.php?edit=<?= $result['id']; ?>">Edit</a> || <a onclick="return confirm('Are sure to erase?');" href="?delete=<?= $result['id']; ?>">Delete</a></td>
              </tr>
            <?php }} ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <script type="text/javascript">

  $(document).ready(function () {
    setupLeftMenu();

    $('.datatable').dataTable();
    setSidebarHeight();


  });
</script>
<?php include 'inc/footer.php'; ?>
