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

    function indexPage() {
        window.location = 'index.php';
    }


</script>

<?php
session_start();
if (isset($_SESSION['user']) != "") {
    header("Location: homepage.php");
}
include_once 'dbconnect.php';

if (isset($_POST['btn-signup'])) {


    $uname = mysql_real_escape_string($_POST['uname']);
    $checkname = ($_POST['uname']);
    $email = mysql_real_escape_string($_POST['email']);
    $upass = md5(mysql_real_escape_string($_POST['password']));
    $passTextbox = ($_POST['password']);
    $cpass = ($_POST['passwordc']);
    $count = mysql_query("SELECT * FROM accounts WHERE email");
    $emailCheck = mysql_query("SELECT * FROM accounts WHERE email='$email'");
    $verifyEmail = mysql_fetch_array($emailCheck);
    $emailtextbox = ($_POST['email']);

    $nameCheck = mysql_query("SELECT * FROM accounts WHERE name='$uname'");
    $verifyName = mysql_fetch_array($nameCheck);


    if ($verifyEmail['email'] == $emailtextbox) {
        echo('
		
		
		
	  <p>email exists, try again</p>
		
		');


        return false;
    }


    if ($verifyName['name'] == $checkname) {
        echo('
		
		
		
		<h1> Sorry the user name exists, try again.</h1>
		
		
		
		
		');
        return false;
    }


    //password check to the retype text box.
    if ($passTextbox == $cpass) {

    } else {
        echo('
		
		
		<p> Sorry, the password is incorrect. Try again.</p>
		
		
		
		
		');
        return false;
    }

    if (mysql_query("INSERT INTO accounts(name,email,password) VALUES('$uname','$email','$upass')")) {


        innerhtml . "<script>alert('successfully registered ');</script>";


    } else {
        ?>
        <script>alert('error while registering you...');</script>
        <?php
    }

}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>StudentWare Registration</title>
    <link rel="stylesheet" href="css/register.css" type="text/css"/>

</head>
<body>

<center><img src="images/logo.png"/></center>
<br/>
<center>
    <div id="login-form"><br/>

        <form method="post" id="register_fillin"><br>
            <table align="center" width="30%" border="0">
                <tr>
                    <td><input id="usernameTextbox" type="text" name="uname" placeholder="Username" required/></td>
                </tr>
                <tr>
                    <td><input id="emailTextbox" type="email" name="email" placeholder="Your Email" required/></td>
                </tr>
                <tr>
                    <td><input id="password" type="password" name="password" placeholder="Your Password"
                               onkeyup="matchPass(); return false;" required/></td>
                </tr>

                <tr>
                    <td><input id="passwordc" type="password" name="passwordc" placeholder="Retype Password"
                               onkeyup="matchPass(); return false;" required/></td>
                </tr>


                <tr>
                    <td>
                        <center>
                            <button id="sign_up" type="submit" name="btn-signup">Sign Up</button>
                        </center>
                    </td>
                </tr>

                <tr>
                    <td>
                        <center><p style="position:relative; top:15px; font-size:18px;">Already registered?</p></center>
                    </td>
                </tr>
                <tr>

                    <td></td>
                </tr>

                <tr>
                    <td>
                        <center><span id="iscorrect"></span>
                            <center>
                    </td>
                </tr>


            </table>

        </form>

        <center>
            <button id="sign_in" style="position:relative; bottom:220px;" onclick="indexPage();">Sign In</button>
        </center>
    </div>

</center>

<center><h2 id="sentence">Want a place to organise your work? Join StudentWare and expereince an all in one place to
        organise your events.</h2></center>


</body>
</html>