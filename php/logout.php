<?php
/**
 * Created by PhpStorm.
 * User: janoberhansli
 * Date: 2018-12-16
 * Time: 15:35
 */

//delete login informations
session_start();
session_destroy();

//redirect
header("Location: ../login/login.php");
die();