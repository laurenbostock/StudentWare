<?php
/**
 * Created by PhpStorm.
 * User: fmerzadyan
 * Date: 29/11/15
 * Time: 15:33
 */

session_start();
session_destroy();
header( 'Location: https://www.selene.hud.ac.uk/studentware/' );