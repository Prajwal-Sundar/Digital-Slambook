<?php
	$GLOBALS["fileLoc"] = "includes/";
	include 'includes/functions.php';
	sec_session_start();
	$title = loginCheck() ? "Welcome to Home Management Software" : "Access Denied";
?>
<!DOCTYPE html>
<html>
	<head>
		<script src = "includes/jquery.min.js"></script>
		<!--<script src = "../plugins/popper.min.js"></script>
		<link rel = "stylesheet" href = "../plugins/bootstrap/css/bootstrap.min.css" />
		<script src = "../plugins/bootstrap/js/bootstrap.min.js"></script>-->
		<link rel = "stylesheet" href = "includes/style.css" />
		<script src = "includes/script.js"></script>
		<title><?php echo $title; ?></title>
	</head>
	<body>
<?php if (loginCheck()) : ?>
		<div class = "jumbotron header text-center">
			<h1>Welcome <?php echo $_SESSION['name']; ?> !</h1>
		</div>
		
		Access Profiles :
		<select id = "listM">
			<option>-----</option>
		
<?php
	$array = members();
	for ($i = 0; $i < count($array); $i++)
		echo '<option>' . $array[$i][0] . '</option>';
?>
		
		</select>
		
		<div id = "comments">
			Comments about the user will appear here.
		</div>
		
		<!--<h5 class = "text-center">FEATURES AVAILABLE</h5>
		<table class = "table table-bordered">
			<thead>
				<tr>
					<th>Feature</th>
					<th>Description</th>
					<th>Link</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Logout</td>
					<td>Logout of your email account</td>
					<td><a id = "logoutButton" class = "hover noHoverUnderline">>></a></td>
				</tr>
				<tr>
					<td>Diary</td>
					<td>Maintain a track of events taking place everyday</td>
					<td><a href = "diary" class = "noHoverUnderline">>></a></td>
				</tr>
				<tr>
					<td>Daily Study Portion</td>
					<td>Maintain a track of what you study daily</td>
					<td><a href = "dailyStudy" class = "noHoverUnderline">>></a></td>
				</tr>
				<tr>
					<td>Workdone Register</td>
					<td>Maintain a track of what is being taught in school</td>
					<td><a href = "workdone" class = "noHoverUnderline">>></a></td>
				</tr>
			</tbody>
		</table>-->
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
		
		<script>
			document.getElementById("listM").addEventListener('change', fun);
			
			function fun() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     var json = JSON.parse(this.responseText);
	 for (var i = 0; i < json.length; i++)
	 {
		 if (document.getElementById('listM').value == json[i][0])
		 {
			 var html = "<ul>";
			 for (var j = 0; j < json[i][5].length; j++)
			 {
				 html += '<li>' + json[i][5][j] + "</li>";
			 }
			 
			 html += "<li id = 'addC'>+ Add Comment</li>";
			 html += "</ul>";
			 document.getElementById("comments").innerHTML = html;
			 document.getElementById('addC').addEventListener('click', function() {
				let cmnt = prompt("Enter your comment");
				if (cmnt != null)
				{
					$.post("includes/functions.php", {
						perform: "addC",
						name: document.getElementById("listM").value,
						comment: cmnt
					}, function(data, status) {
						alert(data);
						fun();
					});
				}
			});
		 }
	 }
    }
  };
  xhttp.open("GET", "includes/database/members.json", true);
  xhttp.send();
			}
		</script>
		
	</body>
</html>