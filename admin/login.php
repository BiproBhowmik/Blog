<?php 
	include '../lib/Session.php';
	Session::init();
?>
<?php include '../lib/Database.php';?>
<?php include '../config/config.php';?>
<?php include '../helpers/helper.php';?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">

		<?php
		$fm = new helper();
				$db = new Database();
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$username = $fm->validation($_POST['username']);
				$password = md5($_POST['password']);

				$username = mysqli_real_escape_string($db->link, $username);

				$query = "select * from tbl_user where username = '$username' and password = '$password'";
				$result = $db->select($query);
				if ($result != false) {
					$value = mysqli_fetch_array($result);
					$row = mysqli_num_rows($result);
					if ($row > 0) {
						Session::set("login", true);
						Session::set("username", $value['username']);
						Session::set("userID", $value['id']);
						header("Location:index.php");
					} else {
						echo "Not match";
					}
					
				} else {
					echo "Not found";
				}
			}
			
		?>

		<form action="login.php" method="post">
			<h1>Admin Login</h1>
			<div>
				<input type="text" placeholder="Username" required="" name="username"/>
			</div>
			<div>
				<input type="password" placeholder="Password" required="" name="password"/>
			</div>
			<div>
				<input type="submit" value="Log in" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="#">Training with live project</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>