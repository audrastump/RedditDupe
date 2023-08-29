<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Edit a post or comment</title>
        <link rel="stylesheet" type="text/css" href="homepage.css"> 
    </head>
    <body><div id = "main">
        <h1>Edit Post</h1>
        <form name="input" action="editstory.php" method="POST">
                <label>Post ID</label><input type="number" name="id" id="id" required/>
                <label>New Text</label><input type="text" name="new_text" id="new_text" required/>
                <input type="hidden" name="token" value="<?php session_start(); echo $_SESSION['token'];?>" />
                <input type="submit" value="Submit" />
        </form>
        <h1>Your stories</h1>
    <br>
    <?php
        session_start();
        $username = $_SESSION['user'];
        ini_set('display_errors',1);
        error_reporting(E_ALL);
        require 'connectData3.php';
        //echoing all of the users stories so they can pick which one they want to edit from
        $stmt = $mysqli->prepare("select title, author, post_id from stories");
            if(!$stmt){
                printf("Query Prep Failed: %s\n", $mysqli->error);
                exit;
            }
            $stmt->execute();
            $result = $stmt->get_result();
            
            while($row = $result->fetch_assoc()){
                $title = $row["title"];
                $author = $row["author"];
                $post_id = $row["post_id"];
                //if the username is that of the author - this is ok because users cannot have the same username
                if ($username == $author){
                    
                    echo '<a href="view3.php? post_id= '.$post_id.'"> '.$title. ' </a>';
                    echo("|                     post id = ");
                    echo($post_id);
                    echo  nl2br ("\n");
                    
                }
            }
        ?>
    </div>
    </body>
</html>