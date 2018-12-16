<?php
/**
 * Created by PhpStorm.
 * User: janoberhansli
 * Date: 2018-12-15
 * Time: 10:02
 */

//start session
session_start();

$db = new SQLite3("../db/clipDatabase.db");
$select = "SELECT COUNT(*) FROM TUser WHERE ";


//check if data was send with post
if (isset($_POST["name"])) {

    //store all received informations
    $name = $_POST["name"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];


    //check if password match
    if ($password != $_POST["passwordRepeat"])
        returnError("Passwörter stimmen nicht überein.", $name, $username, $email);

    //check if username exists
    $result = $db->querySingle($select . "loginName='" . $username . "';");
    if ((int)$result > 0)
        returnError("Benutzername existiert bereits.", $name, null, $email);

    //check if email exists
    $result = $db->querySingle($select . "email='" . $email . "';");

    if ((int)$result > 0)
        returnError("Es existiert bereits ein Account mit dieser Email. Melden Sie sich mit dieser an.", $name, $username, null);

    //register new person
    $db->exec("INSERT INTO TUser (id, name, loginName, email, password, rights) 
VALUES (null,'" . $name . "','" . $username . "','" . $email . "','" . $password . "','STUDENT')");


    //Save all variables in Session
    $_SESSION["name"] = $name;
    $_SESSION["username"] = $username;
    $_SESSION["email"] = $email;
    $_SESSION["rights"] = "STUDENT";

    //head to index.php
    header("Location: ../index.php");
    die();

} else {
    returnError("Irgendetwas ist schief gegangen, versuchen Sie es erneut.", null, null, null);
}


function returnError($message, $name, $username, $email)
{
    $_SESSION["errorMessage"] = $message;
    $_SESSION["name"] = $name;
    $_SESSION["username"] = $username;
    $_SESSION["email"] = $email;

    $url = "../login/register.php";
    header("Location: " . $url);
    die();
}

