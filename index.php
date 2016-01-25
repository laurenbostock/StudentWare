<?php

session_start();
include_once 'dbconnect.php';

/**
 * twitter PHP segment START
 */

require_once('twitteroauth/OAuth.php');
require_once('twitteroauth/twitteroauth.php');
// define the consumer key and secet and callback
define('CONSUMER_KEY', 'WTtRWwynGdgw8hBlpfJaqkLc9');
define('CONSUMER_SECRET', 'rhjlr4TTtYFA8h62XT4pHNbxQSurEy0IxRZoNbc64WZxwAlB0f');
define('OAUTH_CALLBACK', 'http://127.0.0.1:63342/studentware/modulePage.php');

$logout_error = false;
if (isset($_GET['logout'])) {
    try {
        //unset the session
        session_unset();
        // redirect to same page to remove url paramters
        $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
        header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
    } catch (Exception $e) {
        $logout_error = true;
    }
}

$api_call_error = false;
if (!isset($_SESSION['verified_twitter_user']) && !isset($_GET['oauth_token'])) {
    try {
        // create a new twitter connection object
        $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
        // get the token from connection object
        $request_token = $connection->getRequestToken(OAUTH_CALLBACK);
        // if request_token exists then get the token and secret and store in the session
        if ($request_token) {
            $token = $request_token['oauth_token'];
            $_SESSION['request_token'] = $token;
            $_SESSION['request_token_secret'] = $request_token['oauth_token_secret'];
            // get the login url from getauthorizeurl method
            $login_url = $connection->getAuthorizeURL($token);
        } else {

        }
    } catch (Exception $e) {
        $api_call_error = true;
    }
}

$api_oauth_error = false;
if (isset($_GET['oauth_token'])) {
    try {
        // create a new twitter connection object with request token
        $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['request_token'], $_SESSION['request_token_secret']);
        // get the access token from getAccesToken method
        $access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);
        if ($access_token) {
            // create another connection object with access token
            $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
            // set the parameters array with attributes include_entities false
            $params = array('include_entities' => 'false');
            // get the verified_twitter_user
            $verified_twitter_user = $connection->get('account/verify_credentials', $params);
            if ($verified_twitter_user) {
                // store the verified_twitter_user in the session
                $_SESSION['verified_twitter_user'] = $verified_twitter_user;
                // redirect to same page to remove url parameters
                $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
                header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
            }
        }
    } catch (Exception $e) {
        $api_oauth_error = true;
    }
}

$cookie_error = false;
if (!isset($login_url) && isset($_SESSION['verified_twitter_user'])) {
    //logged in via Twitter
    try {
        // get the data stored from the session
        setcookie('social_network', 'twitter');
        $verified_twitter_user = $_SESSION['verified_twitter_user'];
        setcookie('verified_twitter_user_id', $verified_twitter_user->id);
        setcookie('verified_twitter_user_name', $verified_twitter_user->screen_name);
        echo "Name : " . $verified_twitter_user->screen_name . "<br>";
        echo "Username : " . $verified_twitter_user->screen_name . "<br>";
        // echo the logout button
    } catch (Exception $e) {
        $cookie_error = true;
    }
}

/**
 * twitter PHP segment END
 */


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
    <!--    Facebook Sin in API -->
    <script src="js/Facebook-Sign.js"></script>
    <!--    Google Sign in API-->
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <meta name="google-signin-client_id"
          content="642496040558-bhvh1rlt1lpg6af7m2q8lgjdooe1cf3b.apps.googleusercontent.com">
    <meta http-equiv="content-type" content="text/html"/>
    <meta name="author" content="gencyolcu"/>
    <title>StudentWare</title>
</head>

<body id="body">
<?php
if ($logout_error) {
    echo '<br>';
    echo 'logout_error';
}
if ($api_call_error) {
    echo '<br>';
    echo 'api_call_error';
}
if ($api_oauth_error) {
    echo '<br>';
    echo 'api_oauth_error';
}
if ($cookie_error) {
    echo '<br>';
    echo 'cookie_error';
}
?>
<center><img src="images/logo.png"/></center>
<div id="mainDiv">
    <center>
        <!--Code below is logging in using your Facebook/Google/Twitter account.-->
        <div id="loginDivOne">
            <p>Sign in quickly below with one of your social media accounts to get started!</p>
            <!--button segment for Facebook-->
            <center>
                <a class="btn btn-block btn-social btn-facebook"
                   onclick="FB.login();" onlogin="getLoginState();" ;"
                style=" font-size: 21px; width: 300px; margin-bottom: 20px;"
                <span style="padding-top: 5px;" class="fa fa-facebook"></span> Sign in with Facebook
                </a>
            </center>
            <!--button segment for Twitter-->
            <center>
                <a href='<?php echo $login_url ?>'
                   class="btn btn-block btn-social btn-twitter"
                   style=" font-size: 21px; width: 300px; margin-bottom: 20px;"
                   onclick="gaq.push(['_trackEvent', 'btn-social', 'click', 'btn-twitter']);">
                    <span style="padding-top: 5px;" class="fa fa-twitter"></span> Sign in with Twitter
                </a>
            </center>
            <!--button segment for Google-->
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

<!--Google API JS src files-->
<script src="js/Google-Sign.js"></script>
<script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script>


</body>
</html>
