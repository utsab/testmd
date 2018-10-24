<?php

// connect to our mysql database server

function getDatabaseConnection($dbname) {
    $host = "localhost";
    $username = "root";
    $password = "cst336"; // best practice: define this in a separte file
    
    
    
    //mysql://bb108e997bcdab:7b071f8b@us-cdbr-iron-east-05.cleardb.net/heroku_3d24ca78bc82e88?reconnect=true
    
    
    // $host = "us-cdbr-iron-east-05.cleardb.net";
    // $username = "bb108e997bcdab";
    // $password = "7b071f8b";
    // $dbname = "heroku_3d24ca78bc82e88"; 
    
    
    // Create connection
    $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $dbConn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $dbConn; 
}

// temporary test code
//$dbConn = getDatabaseConnection(); 


?>
