<?php
/**
 * Created by PhpStorm.
 * User: janoberhansli
 * Date: 2018-12-25
 * Time: 10:13
 */

$db = new SQLite3("../db/clipDatabase.db");
session_start();

$counter = 0;

$res = $db->query("SELECT * FROM TVideos");
while ($dsatz = $res->fetchArray(SQLITE3_ASSOC)) {
    if(isset($_POST[$dsatz['id']])){
        $counter++;
        $filePath = $db->querySingle("SELECT path FROM TVideos WHERE id=". $dsatz['id']);
        //Remove database entry
        $db->query("DELETE FROM TVideos WHERE id=". $dsatz['id']);
        //Remove file
        unlink($filePath);
    }
}

$_SESSION["deleteCounter"] = $counter;

//redirect back to videolist
header("Location: ../videolist.php");
die();