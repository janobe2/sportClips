<?php
/**
 * Created by PhpStorm.
 * User: janoberhansli
 * Date: 2018-12-16
 * Time: 14:56
 */

session_start();

//Save name and rights
$_SESSION["rights"] = "GUEST";
$_SESSION["username"] = "Gast";

//Redirect to index.php
header("Location: ../index.php");
die();