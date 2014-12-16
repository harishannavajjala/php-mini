<?php
/** This function gets the connection object and returns it to the calling function **/
function getConnection(){
	try{
		$conn = new PDO('mysql:host=localhost;dbname=evibe','root','password');
  		//$conn->setAttribute(PDO::ATTR_ERRORMODE,PDO::ERRORMODE_EXCEPTION);
  		return $conn;
  		}catch(PDOException $e){
  			echo 'ERROR : '.$e->getMessage();
	}
}

/* This function verifies the authenticity of user entered values in login screen */
function validateUserCredentails($username,$password){
	$conn = getConnection(); // Getting the connection object
	$stmt = $conn->prepare('SELECT * FROM userDB where username LIKE :username AND password LIKE :password');
	$stmt->setFetchMode(PDO::FETCH_OBJ);
	$stmt->bindParam('username',$username,PDO::PARAM_STR);
	$stmt->bindParam('password',$password,PDO::PARAM_STR);
	$stmt->execute();
	$results = $stmt->fetchAll();
	return $results ? true : false;
}
 
/* This function returns the record of a particular user */
function getUserDetails($username){
	$conn = getConnection();  // Getting the connection object
	$stmt = $conn->prepare('SELECT * FROM userDB where username LIKE :username');
	$stmt->setFetchMode(PDO::FETCH_OBJ);
	$stmt->bindParam('username',$username,PDO::PARAM_STR);
	$stmt->execute();
	$results = $stmt->fetchAll();
	return $results;
}

/* This function checks the availability of username before inserting the record into the database */
function validateAndInsert($fullname,$phone,$username,$password){
	$conn = getConnection();  // Getting the connection object
	$results = getUserDetails($username);
	if(sizeof($results) != 0){
		return false; 		// The entered username is not unique
	}else{
		//The username entered by user is unique
		$stmt = $conn->prepare('INSERT INTO userDB(fullname,phonenumber,username,password) VALUES(:fullname,:phone,:username,:password)');
		$stmt->bindParam('fullname',$fullname,PDO::PARAM_STR);
		$stmt->bindParam('phone',$phone,PDO::PARAM_STR);
		$stmt->bindParam('username',$username,PDO::PARAM_STR);
		$stmt->bindParam('password',$password,PDO::PARAM_STR);
		$stmt->execute();
		session_start();
		$_SESSION['username']=$username;
     	return true;
	}
}

?>
