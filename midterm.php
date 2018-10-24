<?php

include 'database2.php';


$dbConn = getDatabaseConnection('quotes_v2'); 


function getRandomQuote() {
    global $dbConn; 
    
    $sql = "SELECT * from q_quotes";  
    

    $statement = $dbConn->prepare($sql); 
    
    $statement->execute(); 
    $records = $statement->fetchAll(); 
    
    $randQuote = $records[array_rand($records)]; 
    
    return $randQuote; 
} 

$randomQuote = getRandomQuote(); 

?>
<!DOCTYPE html>
<html>
    <head>
        <style>
            a {
                margin-right: 20px;
                text-decoration: none;
            }
            
            h2 {
                font-style: italic;
            }
            
        </style>
        
        <link rel="stylesheet" type="text/css" href="./css/style.css">
        
    </head>
    <body>
        <h1><?= $randomQuote['quote'] ?></h1>
        <h2>-<?= $randomQuote['author'] ?></h2>
        
        <br/>
        <br/>
        <br/>
        
        <a href="create.php">Create</a>
        
    </body>
</html>