<?php
/**
 * Created by PhpStorm.
 * User: janoberhansli
 * Date: 2018-12-18
 * Time: 12:41
 *
 * Code template: https://www.w3schools.com/php/php_file_upload.asp
 */

session_start();

// Count # of uploaded files in array
$total = count($_FILES['upload']['name']);

// Loop through each file
for( $i=0 ; $i < $total ; $i++ ) {

    //Get the temp file path
    $tmpFilePath = $_FILES['upload']['tmp_name'][$i];

    //Make sure we have a file path
    if ($tmpFilePath != ""){
        //Setup our new file path
        $newFilePath = "./uploadFiles/" . $_FILES['upload']['name'][$i];

        //Upload the file into the temp dir
        if(move_uploaded_file($tmpFilePath, $newFilePath)) {

            //Handle other code here

        }
    }
}