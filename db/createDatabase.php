<?php
/**
 * Created by PhpStorm.
 * User: janoberhansli
 * Date: 18.11.18
 * Time: 12:05
 */
if(!file_exists("clipDatabase.db")) {
    $db = new SQLite3("clipDatabase.db");

    /* Tabelle mit Primärschlüssel erzeugen */
    $db->exec("CREATE TABLE IF NOT EXISTS TUser (id INTEGER PRIMARY KEY AUTOINCREMENT, name, loginName,email, password, rights)");
    $db->exec("CREATE TABLE IF NOT EXISTS TVideos (id INTEGER PRIMARY KEY AUTOINCREMENT, UsName, path, deletePath ,title, size, tags)");


    /* Datensätze eintragen */
    $sqlstr = "INSERT INTO TUser (id, name, loginName ,email, password, rights) VALUES ";
    $db->query($sqlstr . "(null,'admin' , 'admin' , 'admin@kftg.ch' , 'admin' , 'ADMIN')");


    /* Verbindung zur Datenbankdatei wieder lösen */
    $db->close();
}

$ini = parse_ini_file("preferences.ini");
$maxSize = 1000; //Max file size uplaod

ini_set("file_uploads", "On");
ini_set("post_max_size", $ini["post_size"]."M");
ini_set("upload_max_filesize", $ini["upload_size"]."M");
ini_set("max_file_uploads", $ini["max_files_at_once"]);

header("Location: ../index.php");