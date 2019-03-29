<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<div class="grid_10">
  <div class="box round first grid">
    <h2>Post List</h2>
    <div class="block">
      <table class="data display datatable" id="example">
        <thead>
          <tr>
            <th width="5%">Serial NO</th>
            <th width="10%">Category</th>
            <th width="15%">Post Title</th>
            <th width="20%">Description</th>
            <th width="10%">Image</th>
            <th width="10%">Author</th>
            <th width="10%">Tags</th>
            <th width="10%">Date</th>
            <th width="10%">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $query = "SELECT tbl_post.*,tbl_category.name FROM tbl_post
          INNER JOIN tbl_category
          ON tbl_post.cat = tbl_category.id
          ORDER BY tbl_post.title DESC";

          $post = $db->select($query);
          if($post){
            $i=0;
            while($result=$post->fetch_assoc()){
              $i++;

              ?>

              <tr class="odd gradeX">
                <td><?= $i;  ?></td>
                <td><?=  $result['name']; ?></td>
                <td><?=  $result['title']; ?></td>
                <td><?= $fm->textShorten($result['body'],50); ?></td>
                <td><img src="<?= $result['image'];?>" height="40px" width="60px"/></td>
                <td><?=  $result['author']; ?></td>
                <td><?=  $result['tags']; ?></td>
                <td><?=  $fm->formatDate($result['date']); ?></td>
                <td>
                  <a href="editpost.php?editpostId=<?=$result['id']; ?>">Edit</a> ||
                  <a  href="deletepost.php?deletepostId=<?=$result['id'];?>">Delete</a>
                </td>
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
