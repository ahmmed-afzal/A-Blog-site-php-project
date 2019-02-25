<?php include"inc/header.php" ?>
<?php include"inc/slider.php"; ?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">

		<!--Start of paginition-->
		<?php
			$page = 1;
			if(isset($_GET['page'])){
				$page = $_GET['page'];
			}
			$limit = 2;
			$offset = 	$page*$limit-$limit;
		?>
		<!--end of paginition-->

			<?php
				$query = "select * from tbl_post limit $limit offset $offset  ";
				$post = $db ->select($query);
				if($post){
					while($result = $post->fetch_assoc()){
			?>
		<div class="samepost clear">
				<h2><a href="post.php?id=<?php echo $result['id'];?>"><?php echo $result['title'];?></a></h2>
				<h4><?php echo $fm->formatDate($result['date']);?>, By <a href="#"><?php echo $result['author'];?></a></h4>
				 <a href="#"><img src="admin/uploads/<?php echo $result['image'];?>" alt="post image"/></a>
				 <?php echo $fm->textShorten($result['body']);?>
				<div class="readmore clear">
				<a href="post.php?id=<?php echo $result['id'];?>">Read More</a>
				</div>
		</div>
				<?php } ?> <!--end while loop-->
				<?php
					$query = "select * from tbl_post ";
					$result = $db ->select($query);
					$total_rows = mysqli_num_rows($result );
					$total_pages = ceil($total_rows/$limit);

 				?>
				<!--Start of paginition-->
					<nav aria-label="..." >
					  <ul class="pagination mt-5">
					    <li class="page-item <?= $page<=1 ? 'disabled':'' ?>">
					      <a class="page-link" href="?page=<?= $page-1 ?>" tabindex="-1" aria-disabled="true">Previous</a>
					    </li>
							<?php for ($i = 1; $i <=$total_pages ; $i++): ?>
					    <li class="page-item <?= $i==$page ? 'active':'' ?>"><a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a></li>
							<?php endfor; ?>
					    <li class="page-item <?= $page>=$total_pages ? 'disabled':'' ?>">
					      <a class="page-link " href="?page=<?= $page+1 ?>">Next</a>
					    </li>
					  </ul>
					</nav>
				<!--end of paginition-->
				<?php }else{header('location:index.php');} ?>

		</div>
		<?php include "inc/sidebar.php";?>
		<?php include "inc/footer.php"; ?>
