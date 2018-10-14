<?php

include 'database.php';


function searchQuotes() {
    $dbConn = getDatabaseConnection(); 
    
    $sql = "SELECT * from quotes WHERE 1";
    
    if (isset($_POST['text']) && !empty($_POST['text'])) {
        $sql .= " AND text LIKE '%" . $_POST['text']. "%'"; 
    }
    
    if (isset($_POST['author']) && !empty($_POST['author'])) {
        $sql .= " AND author = '" . $_POST['author']."'"; 
    }
    
    if (isset($_POST['order-by-date'])) {
        $sql .= " ORDER BY create_date DESC"; 
    }

    
    
    $statement = $dbConn->prepare($sql); 
    
    $statement->execute(); 
    $records = $statement->fetchAll(); 
    
    
    
    return $records; 
} 

function getTotalQuotes() {
    $dbConn = getDatabaseConnection(); 
    
    $sql = "SELECT COUNT(*) from quotes WHERE 1";
   
    $statement = $dbConn->prepare($sql);
    $statement->execute(); 
    $records = $statement->fetchAll(); 
    
    
    return $records[0][0]; 
}


function display_results($results) {
    echo "<ul>"; 
    foreach ($results as $record) {
        echo "<li>"; 
        echo $record['text'] . " -" . $record['author']; 
        echo "</li>"; 
    }
    echo "</ul>"; 
}

getTotalQuotes(); 
$results = searchQuotes(); 


?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="./css/style.css">
    </head>
    <body>
        <h1> Search our database of <?= getTotalQuotes() ?> Quotes!</h1>
        <form method="post">
            Text: <input type="text" name="text"> <br/><br/>
            Author: <input type="text" name="author"> <br/><br/>
            <input type="checkbox" name="order-by-date"> Order by date <br/><br/>
            <input type="submit">
        </form>
        
        <br/>
        <br/>
        <br/>
        
        <h3> Results: </h3>
        <ul>
            <?php display_results($results); ?>
        </ul>
    </body>
</html>