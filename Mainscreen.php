<?php
require 'functions.php';
session_start();
 
if(isset($_POST['loginButton'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
      
	
	if($username=="" || $password==""){
          echo "Please enter the fields username and password";
	}else{    
	     $permission = validateUserCredentails($username,$password);
	     //validate the values with the database 
	     if($permission){
	     	 // user is verified
	   		//login + set session
	     	$_SESSION['username']=$username;
	     	header('Location: Profile.php');
	      }else{
	     	$status = "Authentication failed. Please check whether the username and password you have entered are correct or not.";
	     	echo $status;
	     }
     }
}

if(isset($_POST['singupButton'])){
     	header('Location: SignUP.php');
}


?>
<!doctype html>
<html>
<head></head>
<body>
 
<form action="Mainscreen.php" method="post">
<ul>
	<li>
		<label name="usrname" id="usrname">Username:</label>
		<input type="text" name="username" id="username">
	</li>
	<br>
	<li>
		<label name="pwd" id="pwd">Password:</label>
		<input type="password" name="password" id="password">
	</li>
	<br>
	<input type="submit" value="login"  name="loginButton">
	<input type="submit" value="Sign UP"  name="singupButton">
</ul>
</form>
</body>
</html>
