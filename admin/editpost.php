<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
if(!isset($_GET['editpostId']) || isset($_GET['editpostId'])==null){
  echo "<script>
  window.location='postlist.php';
  </script";
}else{
  $postId = $_GET['editpostId'];
}
?>
<div class="grid_10">
  <div class="box round first grid">
    <h2>Update Post</h2>
    <?php
    if($_SERVER['REQUEST_METHOD']=="POST"){
      $title   = $_POST['title'];
      $cat     = $_POST['cat'];
      $image   = $_FILES['image']['name'];
      $uploads = 'uploads/'.$image;
      $body    = $_POST['body'];
      $author  = $_POST['author'];
      $tags    = $_POST['tags'];

      if(!empty($image)){

        $query = "UPDATE tbl_post
        SET
        title = '$title',
        cat   = '$cat',
        body  = '$body',
        image = '$uploads',
        author= '$author',
        tags  = '$tags'
        WHERE id ='$postId'";
        $UpdateRow = $db->update($query);
        if($UpdateRow>0){
          echo "<span class='success'>Data Update Successfully.</span>";
                echo "<script>
                window.location='postlist.php';
                </script";
        }else{
          echo "<span class='error' >Something Went Wrong!</span>";
        }
      }
      else{

        $query = "UPDATE tbl_post
        SET
        title = '$title',
        cat   = '$cat',
        image = '$uploads',
        body  = '$body',
        author= '$author',
        tags  = '$tags'
        WHERE id ='$postId'";
        $UpdateRow = $db->update($query);
        if($UpdateRow>0){
          echo "<span class='success'>Data Update Successfully.</span>";
            move_uploaded_file($_FILES['image']['tmp_name'], $uploads);
              echo "<script>
              window.location='postlist.php';
              </script";
        }else{
          echo "<span class='error' >Something Went Wrong!</span>";

        }

      }
    }
    ?>
    <div class="block">
      <?php
      $query = "SELECT * FROM tbl_post WHERE id='$postId'";
      $getpost = $db->select($query);
      if($getpost){
        while($postResult =$getpost->fetch_assoc()){

          ?>
          <form action="" method="POST" enctype="multipart/form-data">
            <table class="form">

              <tr>
                <td>
                  <label>Title</label>
                </td>
                <td>
                  <input type="text" name="title" value="<?= $postResult['title']; ?>" class="medium" />
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
                        <option
                        <?php if($postResult['cat'] ==$result['id']){ ?>
                          selected="selected"
                        <?php } ?>  value="<?= $result['id']; ?>"><?= $result['name']; ?></option>
                      <?php }} ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>
                    <label>Upload Image</label>
                  </td>
                  <td>
                    <input type="file" name="image" /><br>
                    <img src="<?= $postResult['image']; ?>" height="40px" width="80px">
                  </td>
                </tr>
                <tr>
                  <td style="vertical-align: top; padding-top: 9px;">
                    <label>Content</label>
                  </td>
                  <td>
                    <textarea name="body" class="tinymce">
                      <?= $postResult['body']; ?>
                    </textarea>
                  </td>
                </tr>

                <tr>
                  <td>
                    <label>Author</label>
                  </td>
                  <td>
                    <input type="text" name="author" value="<?= $postResult['author']; ?>" class="medium" />
                  </td>
                </tr>
                <tr>
                  <td>
                    <label>Tags</label>
                  </td>
                  <td>
                    <input type="text" name="tags"value="<?= $postResult['tags']; ?>" class="medium" />
                  </td>
                </tr>
                <tr>
                  <td></td>
                  <td>
                    <input type="submit" name="add" Value="Update Record" />
                  </td>
                </tr>

              </table>
            </form>
          <?php }} ?>
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
