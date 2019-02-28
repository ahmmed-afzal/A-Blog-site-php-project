<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<div class="grid_10">

  <div class="box round first grid">
    <h2>Add New Post</h2>
    <?php
    if($_SERVER['REQUEST_METHOD']=="POST"){
      $title   = $_POST['title'];
      $cat     = $_POST['cat'];
      $image   = $_FILES['image']['name'];
      $uploads = 'uploads/'.$image;
      $body    = $_POST['body'];
      $author  = $_POST['author'];
      $tags    = $_POST['tags'];

      $query = "INSERT INTO tbl_post(title,cat,image,body,author,tags) VALUES('$title','$cat','$uploads','$body','$author','$tags')";
      $InsertRow = $db->insert($query);
      if($InsertRow>0){
        echo "<span class='success'>Data Inserted Successfully.</span>";
      }else{
        echo "<span class='error' >Something Went Wrong!</span>";
      }
      move_uploaded_file($_FILES['image']['tmp_name'], $uploads);
    }
    ?>
    <div class="block">
      <form action="" method="POST" enctype="multipart/form-data">
        <table class="form">

          <tr>
            <td>
              <label>Title</label>
            </td>
            <td>
              <input type="text" name="title" placeholder="Enter Post Title..." class="medium" />
            </td>
          </tr>

          <tr>
            <td>
              <label>Category</label>
            </td>
            <td>
              <select id="select" name="cat">
                <option >Select Category</option>
                <?php
                $query = "select * from tbl_category";
                $cat =$db->select($query);
                if($cat){
                  while ($result = $cat->fetch_assoc()) {

                    ?>
                    <option value="<?= $result['id']; ?>"><?= $result['name']; ?></option>
                  <?php }} ?>
                </select>
              </td>
            </tr>
            <tr>
              <td>
                <label>Upload Image</label>
              </td>
              <td>
                <input type="file" name="image"/>
              </td>
            </tr>
            <tr>
              <td style="vertical-align: top; padding-top: 9px;">
                <label>Content</label>
              </td>
              <td>
                <textarea name="body" class="tinymce"></textarea>
              </td>
            </tr>

            <tr>
              <td>
                <label>Author</label>
              </td>
              <td>
                <input type="text" name="author" placeholder="Enter authors name..." class="medium" />
              </td>
            </tr>
            <tr>
              <td>
                <label>Tags</label>
              </td>
              <td>
                <input type="text" name="tags" placeholder="Enter tags Title..." class="medium" />
              </td>
            </tr>
            <tr>
              <td></td>
              <td>
                <input type="submit" name="add" Value="Add Record" />
              </td>
            </tr>

          </table>
        </form>
      </div>
    </div>
  </div>
  <!-- Load TinyMCE -->
  <script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
  <script type="text/javascript">
  $(document).ready(function () {
    setupTinyMCE();
    setDatePicker('date-picker');
    $('input[type="checkbox"]').fancybutton();
    $('input[type="radio"]').fancybutton();
  });
</script>

<?php include 'inc/footer.php'; ?>
