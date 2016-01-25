<?php
if (!mysql_connect("localhost", "studentware", "wernethboy")) {
    die('oops connection problem ! --> ' . mysql_error());
}
if (!mysql_select_db("studentware")) {
    die('oops database selection problem ! --> ' . mysql_error());
}

?>