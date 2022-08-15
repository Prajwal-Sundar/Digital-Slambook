<!DOCTYPE html>
<html>
	<head>
		<script src = "includes/jquery.min.js"></script>
		<!--<script src = "../plugins/popper.min.js"></script>
		<link rel = "stylesheet" href = "../plugins/bootstrap/css/bootstrap.min.css" />
		<script src = "../plugins/bootstrap/js/bootstrap.min.js"></script>-->
		<link rel = "stylesheet" href = "includes/style.css" />
		<script src = "includes/script.js"></script>
		<title>Welcome to Sundar Digital Slambook</title>
	</head>
	<body>
		<div class = "jumbotron header text-center">
			<h1>Welcome to Sundar Digital Slambook</h1>
		</div>
		<div class = "row">
			<div class = "col-sm-4 col-md-4 col-lg-4"></div>
			<div class = "col-sm-4 col-md-4 col-lg-4 text-center">
				<form class = "form-horizontal">
					<h4>LOGIN</h4>
					<br />
					<input type = "email" class = "form-control" placeholder = "Email ....." id = "emailLogin" />
					<br />
					<input type = "password" class = "form-control" placeholder = "Password ....." id = "passwordLogin" />
					<br />
					<div class = "checkbox">
						<label>
							<input type = "checkbox" id = "shPasswordLogin">
							&emsp; Show / Hide Password
						</label>
					</div>
					<button type = "button" id = "loginSubmit" class = "btn hover hoverButton">Login</button>
				</form>
				<a href = "" class = "btn" data-toggle = "modal" data-target = "#registerModal">Register here</a>
			</div>
			<div class = "col-sm-4 col-md-4 col-lg-4"></div>
		</div>
		<div id = "registerModal" class = "modal fade" role = "dialog">
			<div class = "modal-dialog">
				<div class = "modal-content">
					<div class = "modal-body">
						<form class = "form-horizontal text-center">
							<h4>REGISTER</h4>
							<hr />
							<input type = "text" class = "form-control" placeholder = "Name ....." id = "nameRegister" />
							<br />
							<input type = "text" class = "form-control" placeholder = "Class ....." id = "classRegister" />
							<br />
							<input type = "text" class = "form-control" placeholder = "Section ....." id = "sectionRegister" />
							<br />
							<input type = "email" class = "form-control" placeholder = "Email ....." id = "emailRegister" />
							<br />
							<input type = "password" class = "form-control" placeholder = "Password ....." id = "passwordRegister" />
							<br />
							<input type = "password" class = "form-control" placeholder = "Confirm Password ....." id = "passwordConfirmRegister" />
							<br />
							<div class = "checkbox">
								<label>
									<input type = "checkbox" id = "shPasswordRegister"> &emsp; Show / Hide Password
								</label>
							</div>
							<button type = "button" id = "registerSubmit" class = "btn hover hoverButton">Register</button>
						</form>
					</div>
				</div>
			</div>
		</div>
		<br />
		<footer class = "text-center">
			<br />
			<h5>&copy; <?php echo date("Y"); ?> Prajwal Sundar Coding</h5>
		</footer>
	</body>
</html>