<?php
/**
 * Created by PhpStorm.
 * User: fmerzadyan
 * Date: 29/11/15
 * Time: 15:27
 */


include($_SERVER['DOCUMENT_ROOT'].'/login/EpiCurl.php');
include($_SERVER['DOCUMENT_ROOT'].'/login/EpiOAuth.php');
include($_SERVER['DOCUMENT_ROOT'].'/login/EpiTwitter.php');
include($_SERVER['DOCUMENT_ROOT'].'/login/twittersecret.php');

$twitterObj = new EpiTwitter($consumer_key, $consumer_secret);

$authenticateUrl = $twitterObj->getAuthenticateUrl();

/* Redirect to the Twitter login page */
header('Location: '.$authenticateUrl.'');
