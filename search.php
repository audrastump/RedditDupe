<!DOCTYPE html>
<html>
<head>
	<title>Search Results</title>
    <link rel="stylesheet" href="homepage.css">
</head>
<body><div id = "main">
    <h3> Search Results</h3>
    <?php
        session_start();
        require "connectData3.php";
        $username=$_SESSION['user'];
        //if our key word is set
        if (isset($_POST['key_word'])){
            $key_word=$_POST['key_word'];
            $key_word = htmlentities($key_word);
            //finding all titles similar to the key word
            $stmt = $mysqli->prepare("SELECT post_id, title, author from stories where title= ? ");
            if(!$stmt){
                printf("Query Prep Failed: %s\n", $mysqli->error);
               
                exit;
            }  
            
            $stmt->bind_param('s', $key_word);
            $stmt->execute();
            $stmt->bind_result($post_id, $title, $author);
            $stmt->fetch();
            
            echo($title);
            echo  nl2br ("\n");
            echo("Written by : ");
            echo($author);
            echo  nl2br ("\n");
            echo("Post ID: ");
            echo($post_id);
            echo  nl2br ("\n");
            echo '<a href="view3.php? post_id= '.$post_id.'"> '.$title.' by '.$author.' </a> <br>';
        } 
        
      
    ?>
</div>
</body>
</html>