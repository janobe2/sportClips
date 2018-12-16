<?php
/**
 * Created by PhpStorm.
 * User: janoberhansli
 * Date: 2018-12-16
 * Time: 12:06
 */

$db = new SQLite3("clipDatabase.db");
$res = $db->query("SELECT * FROM TUser");
while ($dsatz = $res->fetchArray(SQLITE3_ASSOC)) {
    echo $dsatz['name'] . "\n";
    echo $dsatz['loginName'] . "\n";
    echo $dsatz['email'] . "\n";
    echo $dsatz['password'];
}


echo $db->querySingle("SELECT COUNT(*) FROM TUser WHERE loginName='admin'");