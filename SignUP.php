<?php
require 'functions.php';
if(isset($_POST['createAccount'])){
     	 // call a function in functions.php which inserts this data into the database
			$fullname = $_POST['flname'];
			$phone = $_POST['PhNo'];
			$username = $_POST['username'];
			$password = $_POST['password'];

			
			$insertFlag = validateAndInsert($fullname,$phone,$username,$password);
			
			if(!$insertFlag){
				echo "The username is entered is not available , please enter a different one";
			}else{
				$_POST['SignUp']=true;
				header('Location: Profile.php');
			}
}

?>

<!doctype html>
<html>
<head></head>
<body>
 
<form action="SignUp.php" method="post">
<ul>
	<li>
		<label name="fullName" id="fullName">Full Name:</label>
		<input type="text" name="flname" id="flname">
	</li>
	<br>
	<li>
		<label name="phone" id="phone">Phone Number:</label>
		<input type="text" name="PhNo" id="PhNo">
	</li>
	<br>
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


	<input type="submit" value="Create Account"  name="createAccount">
</ul>	 
</form>
</body>
</html>
