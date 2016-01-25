<?php
session_start();
include_once 'dbconnect.php';


if (!isset($_SESSION['user'])) {
    header("Location: google.php");
}

?>


<!DOCTYPE HTML>
<html>
<head id="head">


    <script src="js/themeControl.js"></script>
    <link rel="stylesheet" type="text/css" href="css/menu_styles.css"/>
    <link rel="stylesheet" type="text/css" title="themeOne" href="css/style1.css"/>
    <link rel="stylesheet" type="text/css" href="css/homepage.css"/>
    <meta http-equiv="content-type" content="text/html"/>
    <meta name="author" content="gencyolcu"/>

    <title>StudentWare Homepage</title>


</head>

<body style="margin-left: auto; margin-right: auto;">

<div id="top">


    <div id="menu_bar_left">
        <a href="logout.php?logout"><img src="images/logoutpic.png" width="40px"/></a>
    </div>


</div>


<div>

    <div id="main" class="main">

        <div>
            <form action="" method="post">
                <div>
                    <strong>Module Name: *</strong> <input type="text" name="module_name"
                                                           value="<?php echo "module_name"; ?>"/><br/>

                    <p>* required</p>
                    <input type="submit" name="submit" value="Submit">
                </div>
            </form>

            <?php
            include 'tabs/modules_tab.php';

            ?>


            <p><a href="new.php">Add a new record</a></p>
        </div>

    </div>


    <div id="bottom">


    </div>


</div>

</body>
</html>