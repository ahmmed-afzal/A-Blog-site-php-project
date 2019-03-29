<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<style media="screen">
.leftside{float: left;width: 70%;}
.rightside{float: left;width: 20%;}
.rightside img{height: 160px;width: 170px;}
</style>
<div class="grid_10">
  <div class="box round first grid">
    <h2>Update Site Title and Description</h2>
    <?php
    if($_SERVER['REQUEST_METHOD']=="POST"){
      $title = $fm->validation($_POST['title']);
      $slogan = $fm->validation($_POST['slogan']);
      $title  = mysqli_real_escape_string($db->link,$title);
      $slogan  = mysqli_real_escape_string($db->link,$slogan);

      $permitted = array('png');
      $file_name = $_FILES['logo']['name'];
      $file_size = $_FILES['logo']['size'];
      $file_temp = $_FILES['logo']['tmp_name'];

      $div = explode('.', $file_name);
      $file_ext =  strtolower(end($div ));
      $same_image = substr(md5(time()), 0,10).'.'.$file_ext;
      $upload_image = 'uploads/'.$same_image;
      if($title ==" " || $slogan == " "){
        echo "< class='error'>file must not be empty!</span>";
      }else{
        if(!empty($file_name)){
          if($file_size>1048567){
            echo "<span class='error'>Image size should be less then 1MB!</span>";
          }elseif(in_array($file_ext, $permitted)==false) {
            echo "<span class='error'>You can upload only:-".implode(',',$permitted)."</span>";
          }else {
            move_uploaded_file($file_temp, $upload_image);
            $query = "UPDATE title_slogan
            SET
            title = '$title',
            slogan   = '$slogan',
            logo   = '$upload_image'
            WHERE id ='1'";
            $UpdateRow = $db->update($query);
            if($UpdateRow>0){
              echo "<span class='success'>Data Update Successfully.</span>";
            }else {
              echo "<span class='success'>Data Not Update </span>";
            }
          }
        }else {
          $query = "UPDATE title_slogan
          SET
          title = '$title',
          slogan   = '$slogan'
          WHERE id ='1'";
          $UpdateRow = $db->update($query);
          if($UpdateRow>0){
            echo "<span class='success'>Data Update Successfully.</span>";
          }else {
            echo "<span class='success'>Data Not Update </span>";
          }
        }
      }
    }
    ?>
    <?php
    $query = "SELECT * FROM title_slogan WHERE id ='1'";
    $blog_title = $db->select($query);
    if($blog_title){
      while($result = $blog_title->fetch_assoc()){

        ?>
        <div class="block sloginblock">
          <div class="leftside">
            <form method="post" enctype="multipart/form-data">
              <table class="form">
                <tr>
                  <td>
                    <label>Website Title</label>
                  </td>
                  <td>
                    <input type="text" value="<?= $result['title']; ?>"  name="title" class="medium" />
                  </td>
                </tr>
                <tr>
                  <td>
                    <label>Website Slogan</label>
                  </td>
                  <td>
                    <input type="text" value="<?= $result['slogan']; ?>" name="slogan" class="medium" />
                  </td>
                </tr>

                <tr>
                  <td>
                    <label>Upload Logo</label>
                  </td>
                  <td>
                    <input type="file" name="logo"/>
                  </td>
                </tr>
                <tr>
                  <td>
                  </td>
                  <td>
                    <input type="submit" name="submit" Value="Update" />
                  </td>
                </tr>
              </table>
            </form>
          </div>
          <div class="rightside">
            <img src="<?= $result['logo']; ?>" alt="logo">
          </div>
        </div>
      <?php }} ?>
    </div>
  </div>
  <?php include 'inc/footer.php'; ?>
