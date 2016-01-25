<script type="text/javascript">

function matchPass() {
    var password = document.getElementById("password");
    var cpassword = document.getElementById("passwordc");
    var iscorrect = document.getElementById('iscorrect');
    if (password.value == cpassword.value) {
      iscorrect.innerHTML = '<span class="infotext" style="font-size:20px; position:relative; top:70px; color:green;"><span class="correct">&#10004;</span> <p>Passwords match!</p></span>';
      return true;
    } else {
      iscorrect.innerHTML = '<span class="infotext" style="font-size:20px; position:relative; top:80px; color:red;"><span class="incorrect">&#10008;</span> Passwords do not match!</span>';
      return false;
    }
  }
  
  function indexPage(){
	  window.location = 'index.php';
  }  

</script>

<?php
session_start();
require_once 'dbconnect.php';

if(isset($_SESSION['user']))
{
	header("Location: homepage.php");
}

if(isset($_POST['btn-signup']))
{
	$uname = $_POST['uname'];
	$email = $_POST['email'];
	$passEncrypt = md5($_POST['password']);
	$pass = $_POST['password'];
	$cpass = $_POST['passwordc'];

	//check if email already exists in db
	$emailCheck = $conn->prepare("SELECT * FROM Accounts WHERE email= :email");
	$emailCheck->bindParam(':email', $email);
	$emailCheck->execute();
	$rows = $emailCheck->fetch(PDO::FETCH_NUM);
	if($rows > 0) {
		echo ('<p>email exists, try again</p>');
		return false;
	}

	//check if username already exists in db
	$nameCheck = $conn->prepare("SELECT * FROM Accounts WHERE name= :uname");
	$nameCheck->bindParam(':uname', $uname);
	$nameCheck->execute();
	$rows = $nameCheck->fetch(PDO::FETCH_NUM);
	if($rows > 0) {
		echo ('<h1> Sorry the user name exists, try again.</h1>');
		return false;
	}
	
	//password check to the retype text box.
	if($pass != $cpass) {
		echo('<p> Sorry, the passwords dont match. Try again.</p>');	
		return false;
	}

	//insert user into db
	$stmt=$conn->prepare("INSERT INTO Accounts VALUES (NULL, :uname, :email, :passEncrypt)");
	$stmt->bindValue(':uname', $uname);
	$stmt->bindValue(':email', $email);
	$stmt->bindValue(':passEncrypt', $passEncrypt);
	$stmt->execute();
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
      <form method="POST" id="register_fillin">
	      	<input id="usernameTextbox" type="text" class="form-control test" placeholder="Username">
		  	<input id="emailTextbox" type="email" class="form-control test" placeholder="Your Email">
		  	<input id="password" type="password" class="form-control test" placeholder="Your Password" onkeyup="matchPass(); return false;">
		  	<input id="passwordc" type="password" class="form-control test" placeholder="Retype Password" onkeyup="matchPass(); return false;">
			<button id="sign_up" type="submit" class="btn btn-primary">Sign Up</button>
			<p>Already registered?</p>
        	 <button id="sign_in" type="submit" class="btn btn-primary" name="btn-login">Sign In</button>
	  </form>
	 </div>
	  <div class="row">
		<h2 id="sentence">Want a place to organise your work? Join StudentWare and experience an all in one place to organise your events.</h2>
	</div>
	</div>
	</div>
  </body>
</html>