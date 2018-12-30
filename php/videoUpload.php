<?php
/**
 * Created by PhpStorm.
 * User: janoberhansli
 * Date: 2018-12-18
 * Time: 12:41
 */

$errors = 0;
session_start();
$sessionName = $_SESSION['username'];

//check os for right path
$dir = "../clips/";


if (isset($_FILES['files']['tmp_name'][0]) && isset($_SESSION['username'])) {

    $fName = $_FILES['files']['name'][0];
    $tags = $_POST["tags"];

    $path_inf = pathinfo($_FILES['files']['name'][0]);
    $extension = $path_inf["extension"];

    if (($extension !== "mp4") && ($extension !== "ogg") && ($extension !== "webm") && ($extension !== "mov") && ($extension !== "avi")) {
        echo "Dieses Video wird nicht unterstützt.";
        die();
    }

    //rename before moving, so no errors occur
    //Move files to destination
    if (!rename($_FILES['files']['tmp_name'][0], '../clips/newVideo'. $extension)) {
        echo "Es ist etwas schief gelaufen";
        die();
    }

    //rename back to normal
    rename("../clips/newVideo". $extension, "../clips/" . $fName);

    //Make a database entry
    $db = new SQLite3("../db/clipDatabase.db");
    $random = "";
    $ini = parse_ini_file("../db/preferences.ini");
    $dir = $ini["rootPath"] . "clips/";

    //Rename file
    $random = generateRandomString();
    $path_inf = pathinfo("../clips/" . $fName);
    $extension = $path_inf["extension"];
    $size = round(filesize("../clips/" . $fName) / 1000000, 2);
    $fullname = $random . "." . $extension;
    rename("../clips/" . $fName, "../clips/" . $fullname);

    //Do database entry
    $db->query('INSERT INTO TVideos (id, UsName, path, deletePath, title, size, tags) VALUES ' . "(null, '" . $sessionName . "', '" . $dir . $fullname . "', '../clips/" . $fullname . "', '" . $fName . "', " . $size . ", '" . $tags . "')");


} else {
    echo "Der Videoname ist ungültig.";
    die();
}
//After everything is complete, send a message back
echo "Video wurde erfolgreich hochgeladen";


//Used for random name
function generateRandomString($length = 22)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


?>
