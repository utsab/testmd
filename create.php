<?php

include 'database2.php';


$dbConn = getDatabaseConnection('quotes_v2'); 


function createQuote($text, $author) {
    global $dbConn; 
    
    $sql = "INSERT INTO `q_quotes` (`quoteid`, `quote`, `author`, `num_likes`) VALUES (NULL, '$text', '$author', 0);";
    
    //echo "sql: $sql <br/>"; 
    
    $statement = $dbConn->prepare($sql); 
    
    $statement->execute(); 
    header('Location: index.php'); 
} 



function validate_form() {
    $errors = array(); 
    
    if (isset($_POST['create-quote'])) {
        if (empty($_POST['text']) ) {
            array_push($errors, "Text must not be empty"); 
        }
        
        if (empty($_POST['author']) ) {
            array_push($errors, "Author must not be empty"); 
        }
        
        if ($errors) {
            display_errors($errors); 
        } else {
            createQuote($_POST['text'], $_POST['author']); 
        }
    }
}


function display_errors($errors) {
    echo "<ul class='errors'>"; 
    foreach($errors as $error) {
        echo "<li>$error</li>"; 
    }
    echo "</ul>"; 
}

?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="./css/style.css">
    </head>
    <body>
        
        <h1>Create a new quote: </h1>
        
        <?php 
            validate_form(); 
        ?>
        
        <form method="post">
            Text: <input type="text" name="text"> <br/><br/>
            Author: <input type="text" name="author"> <br/><br/>
            <input name="create-quote" type="submit">
        </form>
        
        <br/>
        <br/>
        <br/>
        
    </body>
</html>