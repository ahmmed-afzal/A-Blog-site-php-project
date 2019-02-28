<div class="sidebar clear">
			<div class="samesidebar clear">
				<h2>Categories</h2>
					<?php
						$query = "SELECT * FROM tbl_category";
						$category =$db->select($query);
						if($category){
							while ($result =$category->fetch_assoc()) {

 					?>
					<ul>
						<li><a href="posts.php?category=<?= $result['id']; ?>"><?= $result['name']; ?></a></li>
						<?php }}else{ ?>
						<li><a href="#">No category found</a></li>
						<?php } ?>
					</ul>

			</div>

			<div class="samesidebar clear">
				<h4>Latest articles</h4>
					<?php
						$query= "SELECT * FROM tbl_post limit 5";
						$article = $db->select($query);
						if($article){
							while($result = $article->fetch_assoc()){
 					?>
					<div class="popular clear">
						<h2><a href="post.php?id=<?php echo $result['id'];?>"><?php echo $result['title'];?></a></h2>
						<a href="#"><img src="admin/<?php echo $result['image'];?>" alt="post image"/></a>
						<?php echo $fm->textShorten($result['body'],150);?>
					</div>
				<?php }} ?>
			</div>

		</div>
