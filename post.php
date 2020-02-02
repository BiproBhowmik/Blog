<?php include 'header.php'?>
<?php include 'lib/Database.php';?>
<?php include 'config/config.php';?>

<?php 
if (!isset($_GET['id']) || $_GET['id'] == NULL) {
	header("Location: 404.php");
} else {
	$id = $_GET['id'];
}

?>

<div class="navsection templete">
	<ul>
		<li><a href="index.php">Home</a></li>
		<li><a href="about.php">About</a></li>	
		<li><a href="contact.php">Contact</a></li>
	</ul>
</div>

<div class="contentsection contemplete clear">
	<div class="maincontent clear">
		<div class="about">
			<?php
			$query = "select * from tbl_post where id = $id";
			$db = new Database();
			$post = $db->select($query);
			$cat = "";
			if($post)
			{
				while ($result = $post->fetch_assoc()) {
					$cat = $result['category'];
					?>
					<h2><?php echo $result['title'];?></h2>
					<h4><?php echo date("F j, Y, g:i a", strtotime($result['date'])); ?>, By <?php echo $result['author'];?></h4>
					<img src="admin/<?php echo $result['image'];?>" alt="MyImage"/>

					<?php echo $result['body']; ?>

					<?php
				}
			}else{
				header("Location: 404.php");
			}
			?>

			<div class="relatedpost clear">
				<h2>Related articles</h2>

				<?php 
				$rp_query = "select * from tbl_post where category = $cat order by rand() limit 6";
				$rp_db_query = $db->select($rp_query);
				if ($rp_db_query) {
					while ($rresult = $rp_db_query->fetch_assoc()) {

						?>
						<a href="#"><img src="admin/<?php echo $rresult['image'];?>" alt="post image"/>
							<?php
						}
					} else {
						echo "NO RELATED POST";
					}


					?>

				</div>
			</div>

		</div>
		<?php include 'sidebar.php'; ?>
	</div>

	<?php include 'footer.php'?>