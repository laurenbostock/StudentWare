<?php
session_start();
require_once 'dbconnect.php';

$usernameExists = false;
$emailExists = false;

if(isset($_SESSION['user']))
{
	header("Location: homepage.php");
}

if(isset($_POST['btn-signup']))
{
	$uname = $_POST['uname'];
	$email = $_POST['email'];
	$passEncrypt =password_hash($_POST['password'], PASSWORD_DEFAULT);

	//check if email already exists in db
	$emailCheck = $conn->prepare("SELECT * FROM accounts WHERE email= :email");
	$emailCheck->bindParam(':email', $email);
	$emailCheck->execute();
	$rows = $emailCheck->fetch(PDO::FETCH_NUM);
	if($rows > 0) {
		$emailExists = true;
	}

	$nameCheck = $conn->prepare("SELECT * FROM accounts WHERE name= :uname");
	$nameCheck->bindParam(':uname', $uname);
	$nameCheck->execute();
	$rows = $nameCheck->fetch(PDO::FETCH_NUM);
	if($rows > 0) {
		$usernameExists = true;
	} 

	if (!$emailExists and !$usernameExists) {
		$stmt=$conn->prepare("INSERT INTO accounts VALUES (NULL, :uname, :email, :passEncrypt)");
		$stmt->bindValue(':uname', $uname);
		$stmt->bindValue(':email', $email);
		$stmt->bindValue(':passEncrypt', $passEncrypt);
		$stmt->execute();
	}
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>StudentWare Registration</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>

<body>
	<div class="container text-center">
		<div class="row">
			<img src="images/logo.png"/>
		</div>
		<div class="row form">
			<form method="POST" id="register_fillin" onsubmit="return validateForm()">
				<input id="usernameTextbox" type="text" name="uname" class="form-control test" placeholder="Username">
				<span id="usernameVal" class="valError"></span>

				<?php if($usernameExists == true) { ?>
				<span class="error">Username already exists, please try again</span>
				<?php } ?>

				<input id="emailTextbox" type="email" name="email" class="form-control test" placeholder="Your Email">
				<span id="emailVal" class="valError"></span>

				<?php if ($emailExists == true) { ?>
				<span class="error">Email already exists, please try again</span>
				<?php } ?>

				<input id="password" type="password" name="password" class="form-control test" placeholder="Your Password">
				<span id="passVal" class="valError"></span>

				<input id="passwordc" type="password" name="passwordc" class="form-control test" placeholder="Retype Password">
				<span id="cPassVal" class="valError"></span>

				<button id="sign_up" type="submit" name="btn-signup" class="btn btn-primary">Sign Up</button>
				<p>Already registered?</p>
				<a href="index.php" class="btn btn-primary">Sign In</a>
			</form>
		</div>
		<div class="row">
			<h2 id="sentence">Want a place to organise your work? Join StudentWare and experience an all in one place to organise your events.</h2>
		</div>
	</div>
</div>
<script src="./js/register.js" type="text/javascript"></script>
</body>
</html>