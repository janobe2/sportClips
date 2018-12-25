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
//Additional string
$addit = "00Vid";

if (isset($_FILES['files']['tmp_name'][0]) && isset($_SESSION['username'])) {

    //Count all files
    $total = count($_FILES['files']['name']);

    for ($i = 0; $i < $total; $i++) {
        //Check if file already exists
        //Move files to destination
        if (!move_uploaded_file($_FILES['files']['tmp_name'][$i], '../clips/' . $_FILES['files']['name'][$i]))
            $errors++;

    }
} else {
    echo "Der Videoname ist ungültig.";
    die();
}

//Make a database entry
$dir = "../clips/";
$db = new SQLite3("../db/clipDatabase.db");
$clips = array_slice(scandir('../clips/'), 2);
$random = "";

//Get through every file, that has been successfully uploaded
//Rename File and do a database entry
for ($i = 0; $i < count($clips); $i++) {
    //if file does not start with string, it is a new file
    if (substr($clips[$i], 0, 5) != $addit) {
        //Rename file
        $random = generateRandomString();
        $path_inf = pathinfo("../clips/" . $clips[$i]);
        $extension = $path_inf["extension"];
        $size = round(filesize("../clips/" . $clips[$i]) / 1000000, 2);
        $fullname = $addit . $random . "." . $extension;
        rename("../clips/" . $clips[$i], "../clips/" . $fullname);

        //Do database entry
        $db->query('INSERT INTO TVideos (id, UsName, path, title, size) VALUES ' . "(null, '" . $sessionName . "', '" . $dir . $fullname . "', '" . $clips[$i] . "', " . $size . ")");
    }
}


//After uploading, send a response
if ($errors == 0) {
    if ($total > 1)
        echo "Die Videos wurden erfolgreich hochgeladen.";
    else
        echo "Das Video wurde erfolgreich hochgeladen.";
} else {
    echo "Es gab ein Problem mit einem Video.";
}


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
