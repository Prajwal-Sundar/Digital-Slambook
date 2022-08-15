<?php
	$GLOBALS["fileLoc"] = "includes/";
	include 'includes/functions.php';
	sec_session_start();
	$title = loginCheck() ? "Maintain a public diary" : "Access Denied";
?>
<!DOCTYPE html>
<html>
	<head>
		<script src = "../plugins/jquery.min.js"></script>
		<script src = "../plugins/popper.min.js"></script>
		<link rel = "stylesheet" href = "../plugins/bootstrap/css/bootstrap.min.css" />
		<script src = "../plugins/bootstrap/js/bootstrap.min.js"></script>
		<link rel = "stylesheet" href = "includes/style.css" />
		<script src = "includes/script.js"></script>
		<title><?php echo $title; ?></title>
	</head>
	<body>
<?php if (loginCheck()) : ?>
		<div class = "jumbotron header text-center">
			<h1>Maintain a diary, <?php echo $_SESSION['name']; ?> !</h1>
		</div>
<?php else : ?>
		<div class = "jumbotron header text-center">
			<h1>Access Denied !</h1>
		</div>
		<h5 class = "text-center">You are denied access to this page, which only members can see. If you want, you can register or login <a href = "index">here.</a></h5>
<?php endif; ?>
		<br />
		<footer class = "text-center">
			<br />
			<h5>&copy; <?php echo date("Y"); ?> Prajwal Sundar Coding</h5>
		</footer>
	</body>
</html>