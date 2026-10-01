<?php 

session_start();

function show_form() {
	$form_data  = "<html><body>Please login:<form action='show_login_via_session_7_0.php' method='POST'>";
	$form_data .= "Username:<input type='text' name='user'><br>";
	$form_data .= "Password:<input type='password' name='password'>";
	$form_data .= "<input type='submit' value='login'>";
	$form_data .= "</form></body></html>";
	echo $form_data;
}
if (isset($_POST['user']) && isset($_POST['password'])) {
    $user = $_POST['user'];
	$password = $_POST['password'];
	if ($user == "admin" && $password == "admin") {
		$_SESSION['user'] = $_POST['user'];
	}
}

if (isset($_SESSION['user'])) {
	echo "Welcome ".$_SESSION['user'].", you are logged in!";
} else {
	show_form();
}
?>