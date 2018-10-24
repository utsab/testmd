<?php 
    include 'database2.php';
    
    $db = getDatabaseConnection('quotes_v2'); 
    
    
    
    function getQuotesFromAlbertEinstein() {
        global $db; 

        $sql = "SELECT * FROM `q_quotes` WHERE author = 'Albert Einstein'";  
        
    
        $statement = $db->prepare($sql); 
        
        $statement->execute(); 
        $records = $statement->fetchAll(); 
        
        
        return $records; 
    }
    
    function getQuotesAboutLife() {
        global $db; 

        $sql = "SELECT * FROM `q_quotes` WHERE quote LIKE '%life%'";  
        
    
        $statement = $db->prepare($sql); 
        
        $statement->execute(); 
        $records = $statement->fetchAll(); 
        
        
        return $records; 
    }
    
    
    function getQuotesAlphabetical() {
        global $db; 

        $sql = "SELECT * FROM `q_quotes` ORDER BY quote";  
        
    
        $statement = $db->prepare($sql); 
        
        $statement->execute(); 
        $records = $statement->fetchAll(); 
        
        
        return $records; 
    }
    
    
    function getMostLikedQuote() {
        global $db; 

        $sql = "SELECT * FROM `q_quotes` ORDER BY num_likes DESC LIMIT 1";  
        
    
        $statement = $db->prepare($sql); 
        
        $statement->execute(); 
        $records = $statement->fetchAll(); 
        
        
        return $records; 
    }
    
    
    
    function getRandomQuote() {
        global $db; 

        $sql = "SELECT * FROM `q_quotes` ORDER BY RAND() LIMIT 1";  
        
    
        $statement = $db->prepare($sql); 
        
        $statement->execute(); 
        $records = $statement->fetchAll(); 
        
        
        return $records; 
    }
    
    function printRecords($records) {
        echo "<ul>"; 
        foreach ($records as $record) {
            echo "<li>"; 
            echo $record['quote']; 
            echo "</li>"; 
        }
        echo "</ul>"; 
    }
?>

<!DOCTYPE html>
<html>
    <head>
        
    </head>
    <body>
        <h1>Quotes from Albert Einstein</h1>
        <?php
            $quotes = getQuotesFromAlbertEinstein(); 
            printRecords($quotes); 
        ?>
        
        <h1>Quotes about Life</h1>
        <?php
            $quotes = getQuotesAboutLife(); 
            printRecords($quotes); 
        ?>
        
        <h1>Quotes in Alphabetical Order</h1>
        <?php
            $quotes = getQuotesAlphabetical(); 
            printRecords($quotes); 
        ?>
        
        <h1>Most Liked Quote</h1>
        <?php
            $quotes = getMostLikedQuote(); 
            printRecords($quotes); 
        ?>
        
        <h1>Random Quote</h1>
        <?php
            $quotes = getRandomQuote(); 
            printRecords($quotes); 
        ?>
        
    </body>
</html>