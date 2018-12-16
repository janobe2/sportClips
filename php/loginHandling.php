<?php
/**
 * Created by PhpStorm.
 * User: janoberhansli
 * Date: 2018-12-15
 * Time: 10:02
 */

$db = new SQLite3("../db/clipDatabase.db");
$select = "SELECT COUNT(*) FROM TUser WHERE ";


if (isset($_POST["pass"]) && isset($_POST["username"])) {
    //if everything is set, try to log in
    $result = $db->querySingle($select . "loginName='" . $_POST["username"] . "' and password='" . $_POST["pass"] . "'");

    session_start();

    if ((int)$result == 1) {
        //login was successful
        $_SESSION["username"] = $_POST["username"];
        $_SESSION["rights"] = $db->querySingle("SELECT rights FROM TUser WHERE " . "loginName='" . $_POST["username"] . "' and password='" . $_POST["pass"] . "'");
        header("Location: ../index.php");
        die();
    } else {
        //login was not successful
        $_SESSION["errorMessage"] = "Benutzername oder Passwort ist falsch";
        header("Location: ../login/login.php");
    }


} else {

    //If nothing is set, go back to login page
    $_SESSION["errorMessage"] = "Irgendetwas ist schief gelaufen. Versuchen Sie es erneut";
    header("Location: ../login/login.php");
    die();
}