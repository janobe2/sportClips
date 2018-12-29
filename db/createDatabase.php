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

//redirecting to index.php
header("Location: ../index.php");