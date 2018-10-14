<?php

include 'database.php';


function getRandomQuote() {
    $dbConn = getDatabaseConnection(); 
    
    $sql = "SELECT * from quotes";  
    

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
        <h1><?= $randomQuote['text'] ?></h1>
        <h2>-<?= $randomQuote['author'] ?></h2>
        
        <br/>
        <br/>
        <br/>
        
        <a href="search.php">Search</a>
        <a href="create.php">Create</a>
        
    </body>
</html>