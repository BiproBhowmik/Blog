<!-- Database Initialisiged in main Content file -->

<div class="sidebar clear">
	<div class="samesidebar clear">
		<h2>Categories</h2>

		<?php
		$query = "select * from tbl_category";
		$categorys = $db->select($query);

		if($categorys)
		{
			while ($result = $categorys->fetch_assoc()) {
				
				?>
				<ul>
					<li><a href="index.php?category=<?php echo $result['id'];?>"><?php echo $result['name']; ?></a></li>						
				</ul>

				<?php 
			}
		}
		?>
	</div>
	
	<div class="samesidebar clear">
		<h2>Random Posts</h2>
		<?php
		$query = "select * from tbl_post order by rand() limit 5";
					$post  = $db->select($query);	//whole table
					if($post)
					{
					while ($result = $post->fetch_assoc()) {	//$result is eatch row
						?>
						<div class="popular clear">
							<h3><a href="post.php?id=<?php echo $result['id'];?>"><?php echo $result['title']; ?></a></h3>
							<a href="post.php?id=<?php echo $result['id'];?>"><img src="admin/<?php echo $result['image']; ?>" alt="post image"/></a>
							<?php echo substr($result['body'], 0, 100).'...'; ?> 	
						</div>

						<?php 
					}
				}
				else
				{
					header("Location:404.php");
				}
				?>
				
			</div>
			
		</div>