<?php
session_start();

if(!isset($_SESSION['user']))
{
	header("Location: index.php");
}
else 
{
	unset($_SESSION['user']);
	header("Location: index.php");
}
?>