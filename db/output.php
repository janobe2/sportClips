<?php
/**
 * Created by PhpStorm.
 * User: janoberhansli
 * Date: 2018-12-16
 * Time: 12:06
 */

$db = new SQLite3("clipDatabase.db");

$res = $db->query("SELECT * FROM TVideos");
while ($dsatz = $res->fetchArray(SQLITE3_ASSOC)) {
    /*echo $dsatz['name'] . "\n";
    echo $dsatz['loginName'] . "\n";
    echo $dsatz['email'] . "\n";
    echo $dsatz['password'] . "\n";
    echo $dsatz['rights'] . "\n" . "\n";*/

    echo $dsatz['id'] . "\n";
    echo $dsatz['path'] . "\n";
    echo $dsatz['deletePath'] . "\n";
    echo $dsatz['UsName'] . "\n";
    echo $dsatz['title'] . "\n";
    echo $dsatz['size'] . "\n";
}

//$db->query("DELETE FROM TVideos");