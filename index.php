<?php
session_start();
include_once 'dbconnect.php';

if (isset($_SESSION['user']) != "") {
    header("Location: homepage.php");
}

if (isset($_POST['btn-login'])) {
    $email = mysql_real_escape_string($_POST['email']);
    $upass = mysql_real_escape_string($_POST['pass']);
    $res = mysql_query("SELECT * FROM accounts WHERE email='$email'");
    $row = mysql_fetch_array($res);

    if ($row['password'] == md5($upass)) {
        $_SESSION['user'] = $row['user_id'];
        header("Location: homepage.php");
    } else {
        ?>
        <script>alert('wrong details');</script>
        <?php
    }

}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>


    <link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="css/docs.css"/>
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css"/>
    <link rel="stylesheet" type="text/css" href="css/bootstrap-social.css"/>
    <link rel="stylesheet" type="text/css" href="css/login.css"/>
    <!--Google Sign in API-->
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <meta name="google-signin-client_id"
          content="642496040558-bhvh1rlt1lpg6af7m2q8lgjdooe1cf3b.apps.googleusercontent.com">


    <meta http-equiv="content-type" content="text/html"/>
    <meta name="author" content="gencyolcu"/>
    <title>StudentWare</title>
</head>

<body id="body">

<center><img src="images/logo.png"/></center>

<div id="mainDiv">

    <center>

        <!--Code below is logging in using your Facebook/Google/Twitter account.-->
        <div id="loginDivOne">

            <p>Sign in quickly below with one of your social media accounts to get started!</p>

            <center>
                <a class="btn btn-block btn-social btn-facebook"
                   style="font-size: 21px; width: 300px;  margin-top: 50px; margin-bottom: 20px;"
                   onclick="_gaq.push(['_trackEvent', 'btn-social', 'click', 'btn-facebook']);">
                    <span style="padding-top: 5px;" class="fa fa-facebook"></span> Sign in with Facebook
                </a>
            </center>
            <center>
                <a class="btn btn-block btn-social btn-twitter"
                   style=" font-size: 21px; width: 300px; margin-bottom: 20px;"
                   onclick="_gaq.push(['_trackEvent', 'btn-social', 'click', 'btn-twitter']);">
                    <span style="padding-top: 5px;" class="fa fa-twitter"></span> Sign in with Twitter
                </a>
            </center>
            <center>

                <div class="g-signin2" data-onsuccess="onSignIn"
                     data-width="300" data-height="44" data-longtitle="true"></div>


            </center>


            <center>
                <br/>

                <p> Or you can register the traditional way using the<a href="register.php"> following link.</a></p>
            </center>


        </div>
    </center>

    <!--This implements the line in the middle-->
    <div style="" id="middleLine" class="vertical-line" style="height:30px;">

    </div>


    <!--Code below is for logging into StudentWare-->
    <center>
        <div id="loginDivTwo">

            <p style="">Alternatively login with your registered email and password!</p>


            <center>
                <form method="post">
                    <br>

                    <div id="textBox">
                        <img src="images/login_user.png" width="23px"/>
                        <input id="loginTextBoxes" type="text" name="email" placeholder="Your Email" required/>
                    </div>
                    <br>
                    <br>

                    <div id="textBox" style="margin-left: 10px;">
                        <img src="images/padlock_login.png" width="15px"/>
                        <input id="loginTextBoxes" type="password" name="pass" placeholder="Your Password" required/>
                    </div>


                    <br/>
                    <center>
                        <button id="sign_in" type="submit" name="btn-login">Sign In</button>
                    </center>
                </form>

            </center>

        </div>

    </center>


</div>

<!--Google API JS src file-->
<script src="js/Google-Sign.js"></script>
<script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script>

</body>
</html>