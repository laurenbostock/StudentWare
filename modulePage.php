<!DOCTYPE HTML>
<html>
<head id="head">
    <script src="js/themeControl.js"></script>
    <link rel="stylesheet" type="text/css" href="css/menu_styles.css"/>
    <link rel="stylesheet" type="text/css" href="css/modulePage.css"/>
    <meta http-equiv="content-type" content="text/html"/>
    <meta name="author" content="gencyolcu"/>

    <title>StudentWare Module</title>


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


    <div id="main">


        <div id="firstMain">

            <button class="addButton" type="button"><img src="images/deletepic.png" style="width: 20px;"/></button>
            <button class="addButton" type="button"><img src="images/addpic.png"
                                                         style="width: 20px;   padding-top: 3px;"/></button>


        </div>

        <div id="secondMain">


            <div id="tab1" style="float: left;">
                <div id="tabtitle">
                    <img src="images/checklist.png" width="25px" style="float: left; margin-right: 3px;"/>

                    <p style="float: left; font-size: 25px; color: white; position: relative; bottom: 25px;">Module
                        Checklist</p>
                    <button class="addButton" type="button" style="float: right;"><img src="images/deletepic.png"
                                                                                       style=" width: 20px; "/></button>
                    <button class="addButton" style=" position: relative; left:200px;" type="button"><img
                            src="images/addpic.png" style="width: 20px; "/></button>

                </div>

                <div id="tabbody">


                </div>

            </div>

            <div id="tab2" style=" width: 500px; float: left; ">
                <div id="tabtitle2">
                    <img src="images/document.png" width="25px" style="float: left; margin-right: 3px;"/>

                    <p style=" float: left; font-size: 25px; position: relative; bottom: 25px; color: white;">Module
                        Documents</p>
                    <button class="addButton" type="button" style="float: right;"><img src="images/deletepic.png"
                                                                                       style=" width: 20px; "/></button>
                    <button class="addButton" style=" position: relative; left:180px;" type="button"><img
                            src="images/addpic.png" style="width: 20px; "/></button>

                </div>

                <div id="tabbody2">

                </div>
            </div>

            <div id="stickytab" style=" width: 500px; float: left;">
                <div id="tabtitle3">
                    <img src="images/stickynotes.png" width="25px" style="float: left; margin-right: 3px;"/>

                    <p style=" float: left; position: relative; bottom: 25px; font-size: 25px; color: white;">Sticky
                        Notes</p>
                    <button class="addButton" type="button" style="float: right;"><img src="images/deletepic.png"
                                                                                       style=" width: 20px; "/></button>
                    <button class="addButton" style=" position: relative; left:750px;" type="button"><img
                            src="images/addpic.png" style="width: 20px; "/></button>

                </div>

                <div id="tabbody3">

                </div>
            </div>


        </div>


    </div>

    <div id="bottom">

    </div>


</div>

</body>
</html>