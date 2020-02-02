<?php include 'lib/Database.php';?>
<?php include 'config/config.php';?>

<?php $db = new Database(); ?>


<div class="maincontent clear">

	<!-- Pagination -->
	<?php
	$per_page = 3;
	if (isset($_GET["page"])) {
		$page = $_GET["page"];
	} else {
		$page = 1;
	}

	$start_from = ($page - 1) * $per_page;


	?>
	<!-- Pagination -->

	<?php 
	if (isset($_GET["category"])) { //Show category related posts
		$cat = $_GET["category"];
		$query = "select * from tbl_post where category = $cat order by id desc";
		$post  = $db->select($query);	//whole table
		$pagi = $query;	//Query For Pagination
	}
	elseif (isset($_GET["keyword"]) && $_GET != NULL) {
		$keyword = $_GET["keyword"];
		$query = "select * from tbl_post where title like '%$keyword%' or tags like '%$keyword%' limit $start_from, $per_page";
		$post  = $db->select($query);	//whole table
		$pagi = "select * from tbl_post where title like '%$keyword%' or tags like '%$keyword%'";	//Query For Pagination
	}
	 else {	//Normal Posts
		$query = "select * from tbl_post order by id desc limit $start_from, $per_page";
		$post  = $db->select($query);	//whole table
		$pagi = "select * from tbl_post";	//Query For Pagination
	}
	if($post)
	{
			while ($result = $post->fetch_assoc()) {	//$result is eatch row
				?>

				<div class="samepost clear">
					<h2><a href=""> <?php echo $result['title']; ?> </a></h2>
					<h4> <?php echo date("F j, Y, g:i a", strtotime($result['date'])); ?> , By <a href="#"> <?php echo $result['author']; ?> </a></h4>
					<a href="#"><img src="admin/<?php echo $result['image']; ?>" alt="post image"/></a>
					<?php echo substr($result['body'], 0, 400).'...'; ?> 
					<div class="readmore clear">
						<a href="post.php?id=<?php echo $result['id'];?>">Read More</a>
					</div>
				</div>

				<?php 
			}
		}
		else
		{
			header("Location:404.php");
		}
		?>
		<!-- Pagination -->
		<?php

		//$query = "select * from tbl_post";
		$result = $db->select($pagi);
		$total_rows = mysqli_num_rows($result);
		$last_page = ceil($total_rows / $per_page);

		echo "<span class='pagination'> <a href='index.php?page=1'> First Page </a>";

		for ($i=1; $i <=  $last_page; $i++) { 
			echo "<a href='index.php?page=$i'> $i </a>";
		}

		echo " <a href='index.php?page=$last_page'> Last Page </a> </span> ";


		?>
		<!-- Pagination -->

	</div>