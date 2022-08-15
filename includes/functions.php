<?php
	
	if (isset($_POST['perform'])) $_POST['perform']();
	
	function sec_session_start() {
		if (ini_set('session.use_only_cookies', 1) === FALSE) die("alert('A technical error occured. Please contact your administrator.');");
		$cookieParams = session_get_cookie_params();
		session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], FALSE, TRUE);
		session_name("sec_session_id");
		session_start();
		session_regenerate_id();
		if (!isset($_SESSION['login_string'])) $_SESSION['login_string'] = "";
		if (!isset($_SESSION['email'])) $_SESSION['email'] = "";
		if (!isset($_SESSION['name'])) $_SESSION['name'] = "";
		if (!isset($_SESSION['class'])) $_SESSION['class'] = "";
		if (!isset($_SESSION['section'])) $_SESSION['section'] = "";
	}
	
	function members() {
		if (!isset($GLOBALS["fileLoc"])) $GLOBALS["fileLoc"] = "";
		$file = fopen($GLOBALS["fileLoc"] . "database/members.json", "r");
		$json = fread($file, filesize($GLOBALS["fileLoc"] . "database/members.json"));
		$array = json_decode($json, TRUE);
		fclose($file);
		return $array;
	}
	
	function login() {
		sec_session_start();
		$email = filter_input(INPUT_POST, 'emailL', FILTER_SANITIZE_EMAIL);
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) die("alert('Please enter a valid email adress');$('input#emailLogin').focus();");
		$password = filter_input(INPUT_POST, 'passwordL', FILTER_SANITIZE_STRING);
		$password = hash('sha512', $password);
		if (strlen($password) != 128) die("alert('Invalid password configuration. Please try again.');$('input#passwordLogin').focus();");
		$array = members();
		$stats = FALSE;
		$pass = $name = $class = $section = "";
		for ($i = 0; $i < count($array); $i++) if ($array[$i][3] == $email) {
			$stats = TRUE;
			$pass = $array[$i][4];
			$name = $array[$i][0];
			$class = $array[$i][1];
			$section = $array[$i][2];
		}
		if ($stats == FALSE) die("alert('There is no user registered with this email adress. Please register if you have not or check the email you have entered again.');$('input#emailLogin').focus();");
		if ($password != $pass) die("alert('The password you entered is incorrect. Please enter the correct password.');$('input#passwordLogin').focus();");
		$_SESSION['login_string'] = hash('sha512', $pass . $_SERVER['HTTP_USER_AGENT']);
		$_SESSION['email'] = $email;
		$_SESSION['name'] = $name;
		$_SESSION['class'] = $class;
		$_SESSION['section'] = $section;
		echo "alert('You have successfully logged in');window.location.href = 'members.php'";
	}
	
	function register() {
		$name = filter_input(INPUT_POST, 'nameR', FILTER_SANITIZE_STRING);
		$class = filter_input(INPUT_POST, 'classR', FILTER_SANITIZE_STRING);
		$section = filter_input(INPUT_POST, 'sectionR', FILTER_SANITIZE_STRING);
		$email = filter_input(INPUT_POST, 'emailR', FILTER_SANITIZE_EMAIL);
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) die("alert('Please type a valid email');$('input#emailRegister').val('').focus();");
		$password = filter_input(INPUT_POST, 'passwordR', FILTER_SANITIZE_STRING);
		$password = hash('sha512', $password);
		if (strlen($password) != 128) die("alert('Invalid password configuration. Please try again.');$('input#passwordConfirmRegister').val('');$('input#passwordRegister').val('').focus();");
		$array = members();
		for ($i = 0; $i < count($array); $i++) if ($email == $array[$i][3]) die("alert('Another user has already registered an account with this email account. Please type another email adress, or if you have previously registered with this adress, login.');");
		$array[] = array($name, $class, $section, $email, $password, array());
		$text = json_encode($array);
		/*if (!fwrite(fopen("database/diaryPublic/" . $password . ".json", "w"), "[]")) die("A serious problem has occured. Please contact your administrator.");
		if (!fwrite(fopen("database/diaryPersonal/" . $password . ".json", "w"), "[]")) die("A serious problem has occured. Please contact your administrator.");
		if (!fwrite(fopen("database/editStudy/" . $password . ".json", "w"), "[]")) die("A serious problem has occured. Please contact your administrator.");
		if (!fwrite(fopen("database/dailyStudy/" . $password . ".json", "w"), "[]")) die("A serious problem has occured. Please contact your administrator.");
		if (!fwrite(fopen("database/workdone/" . $password . ".json", "w"), "[]")) die("A serious problem has occured. Please contact your administrator.");
		if (!fwrite(fopen("database/examSettings/" . $password . ".json", "w"), "[]")) die("A serious problem has occured. Please contact your administrator.");
		if (!fwrite(fopen("database/marksheet/" . $password . ".json", "w"), "[]")) die("A serious problem has occured. Please contact your administrator.");*/
		if (fwrite(fopen("database/members.json", "w"), $text)) echo "alert('You have successfully registered yourself. You can now login.');$.function.successRegister();";
		else die("alert('A technical error occured while completing your registration. Please contat your administrator.');");
	}
	
	function loginCheck() {
		$loginString = $_SESSION['login_string'];
		$email = $_SESSION['email'];
		$array = members();
		$pass = "";
		for ($i = 0; $i < count($array); $i++) if ($array[$i][3] == $email) $pass = $array[$i][4];
		$pass = hash('sha512', $pass . $_SERVER['HTTP_USER_AGENT']);
		if ($loginString != $pass) return FALSE;
		else return TRUE;
	}
	
	function logout() {
		sec_session_start();
		$keys = array_keys($_SESSION);
		for ($i = 0; $i < count($_SESSION); $i++) $_SESSION[$keys[$i]] = '';
		$params = session_get_cookie_params();
		setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
		session_destroy();
		echo "alert('You have successfully logged out');window.location.href = 'index';";
	}
	
	function addC()
	{
		$c = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING);
		$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
		$array = members();
		
		for ($i = 0; $i < count($array); $i++)
		{
			if ($array[$i][0] == $name)
			{
				$array[$i][5][] = $c;
			}
		}
		
		$text = json_encode($array);
		if (fwrite(fopen("database/members.json", "w"), $text)) echo "Comment added successfully.";
		else die("A technical error occured while completing your registration. Please contat your administrator.");
	}