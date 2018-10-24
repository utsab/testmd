<?php

include 'database2.php';


$dbConn = getDatabaseConnection('quotes_v2'); 

function searchQuotes() {
    global $dbConn; 
    
    if (isset($_POST['order-by-likes']) && isset($_POST['order-alphabetically'])) {
        $error = true; 
    }
    
    $sql = "SELECT * from q_quotes WHERE 1";
    
    if (isset($_POST['text']) && !empty($_POST['text'])) {
        $sql .= " AND quote LIKE '%" . $_POST['text']. "%'"; 
    }
    
    if (isset($_POST['author']) && !empty($_POST['author'])) {
        $sql .= " AND author LIKE '%" . $_POST['author']."%'"; 
    }
    
    if (isset($_POST['order-by-likes'])) {
        $sql .= " ORDER BY num_likes DESC"; 
    } else if (isset($_POST['order-alphabetically'])) {
        $sql .= " ORDER BY quote"; 
    }


    
    
    $statement = $dbConn->prepare($sql); 
    
    $statement->execute(); 
    $records = $statement->fetchAll(); 
    
    
    
    return $records; 
} 



function displayResults() {
    
    $results = searchQuotes(); 
    
    echo "<br><br><br>"; 
    echo "<h3>" . count($results) . " Results: </h3>"; 
    
    echo "<ul>"; 
    foreach ($results as $record) {
        echo "<li>"; 
        echo $record['quote'] . " -" . $record['author']; 
        echo " (" . $record['num_likes'] ." likes)"; 
        echo "</li>"; 
    }
    echo "</ul>"; 
}


function validateForm() {
    $error = false; 
    
    if (isset($_POST['order-by-likes']) && isset($_POST['order-alphabetically'])) {
        $error = "Cannot order both alphabetically and by number of likes"; 
    }
    
    return $error; 
}


function displayError($error) {
    echo "<div class='error'>$error</div>"; 
}

$error = validateForm(); 




?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="./css/style.css">
    </head>
    <body>
        <h1> Search our Collection of Inspiring Quotes!</h1>
        <form method="post">
            Text: <input type="text" name="text" value="<?=$_POST['text'] ?>"> <br/><br/>
            Author: <input type="text" name="author" value="<?=$_POST['author'] ?>"> <br/><br/>
            <input type="checkbox" name="order-by-likes"> Order by number of likes <br/><br/>
            <input type="checkbox" name="order-alphabetically"> Order alphabetically <br/><br/>
            <input type="submit">
        </form>
        
        <?php 
            if ($error) {
                displayError($error); 
            } else {
                displayResults(); 
            }
        ?>
       
        
        
    </body>
</html>