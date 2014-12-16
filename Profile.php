<?php
require 'functions.php';
session_start();

if(!isset($_SESSION['username'])){
	header('Location:Mainscreen.php');
}else{
	$results = getUserDetails($_SESSION['username']);
}

if(isset($_POST['logoutButton'])){
	header('Location: Mainscreen.php');
	session_destroy();
	$_SESSION = array();
}


?>
<!doctype html>
<html>
<head></head>
<body>
	<h2>Welcome <?= $results[0]->fullname; ?>
    </h2>
	<form action="Profile.php" method="post">
	<ul>
		<li>
			<label name="fullname">Fullname : <?= $results[0]->fullname; ?></label>
		</li>
		<li>
		    <label name="phonenumber">Phone Number : <?= $results[0]->phonenumber; ?></label>
		</li>
	</ul>
		<input type="submit" name="logoutButton" value="logout"> 
	</form>
</body>
</html>
