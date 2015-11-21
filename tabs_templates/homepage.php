<?php
session_start();
include_once 'dbconnect.php';

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
}
$res = mysql_query("SELECT * FROM accounts WHERE user_id=" . $_SESSION['user']);
$userRow = mysql_fetch_array($res);
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


    <div id="top">


        <div id="menubox" class="menu-wrap" style="float: left;">
            <a><img src="images/logo.png" style="float: left; width: 200px; margin-left: 10px; margin-top: 4px;"/>
            </a>
            <nav class="menu" style="float: right;">
                <ul class="clearfix">

                    <li>
                        <a href="#"><img src="images/theme_pic.png" width="40px;"/> <span
                                class="arrow">&#9660;</span></a>

                        <ul class="sub-menu" id="subMenu">
                            <li id="button1"><a type="submit" onclick="switch_style1();return false;" href="#">Theme
                                    One</a></li>
                            <li><a href="#" onclick="switch_style2();return false;">Theme Two</a></li>
                            <li><a href="#" onclick="switch_style3();return false;">Theme Three</a></li>
                            <li><a href="#" onclick="original_style();return false;">Theme Four</a></li>


                        </ul>
                    </li>
                    <li><a href="#"><img src="images/settinglogo.png" width="40px"/></a></li>
                    <li><a href="logout.php?logout"><img src="images/logoutpic.png" width="40px"/></a></li>

                </ul>
            </nav>
        </div>


    </div>


</head>

<body style="margin-left: auto; margin-right: auto;">


<div>


    <div id="main" class="main">


        <div id="firstMain">

            <button class="addButton" type="button"><img src="images/deletepic.png" style="width: 20px;"/></button>
            <button class="addButton" type="button"><img src="images/addpic.png"
                                                         style="width: 20px;   padding-top: 3px;"/></button>


        </div>

        <div id="secondMain">


            <div id="tab1" style="float: left;">
                <div id="tabtitle">
                    <img src="images/timetable.png" width="25px" style="float: left; margin-right: 3px;"/>

                    <p id="p1" style="float: left; font-size: 25px; color: white; position: relative; bottom: 25px;">My
                        Timetable</p>
                    <button class="addButton" type="button" style="float: right;"><img src="images/deletepic.png"
                                                                                       style=" width: 20px; "/></button>
                    <button class="addButton" style=" position: relative; left:235px;" type="button"><img
                            src="images/addpic.png" style="width: 20px; "/></button>

                </div>

                <div id="tabbody">


                </div>

            </div>

            <div id="tab2" style=" width: 500px; float: left; ">
                <div id="tabtitle2">
                    <img src="images/bellicon.png" width="25px" style="float: left; margin-right: 3px;"/>

                    <p id="p2" style=" float: left; font-size: 25px; position: relative; bottom: 25px; color: white;">My
                        Reminders</p>
                    <button class="addButton" type="button" style="float: right;"><img src="images/deletepic.png"
                                                                                       style=" width: 20px; "/></button>
                    <button class="addButton" style=" position: relative; left:225px;" type="button"><img
                            src="images/addpic.png" style="width: 20px; "/></button>

                </div>

                <div id="tabbody2">

                </div>
            </div>

            <div id="tab2" style=" width: 500px; float: left;">
                <div id="tabtitle3">
                    <img src="images/moduleicon.png" width="25px" style="float: left; margin-right: 3px;"/>

                    <p id="p3" style=" float: left; position: relative; bottom: 25px; font-size: 25px; color: white;">My
                        Modules</p>
                    <button class="addButton" type="button" style="float: right;"><img src="images/deletepic.png"
                                                                                       style=" width: 20px; "/></button>
                    <button class="addButton" style=" position: relative; left:245px;" type="button"><img
                            src="images/addpic.png" style="width: 20px; "/></button>

                </div>

                <div id="tabbody3">

                </div>
            </div>

            <div id="tab2" style=" width: 500px; float: left;margin-bottom: 30px;: 30px;">
                <div id="tabtitle4">
                    <img src="images/calendaricon.png" width="25px" style="float: left; margin-right: 3px;"/>

                    <p id="p4" style=" float: left; font-size: 25px; position: relative; bottom: 25px; color: white;">My
                        Calendar</p>
                    <button class="addButton" type="button" style="float: right;"><img src="images/deletepic.png"
                                                                                       style=" width: 20px; "/></button>
                    <button class="addButton" style=" position: relative; left:240px;" type="button"><img
                            src="images/addpic.png" style="width: 20px; "/></button>

                </div>

                <div id="tabbody4">

                </div>
            </div>


        </div>


    </div>

    <div id="bottom">

    </div>


</div>

</body>
</html>