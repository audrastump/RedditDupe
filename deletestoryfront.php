
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Delete</title>
        <link rel="stylesheet" type="text/css" href="homepage.css"> 
    </head>
    <body><div id = "main">
        <h1>Delete Story</h1>
        <form name="input" action="deletestory.php" method="POST">
                <label>Post id</label><input type="number" name="id" id="id" required/>
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
        //we want to print out all the stories from this author
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
                //if the author has the same username - we know this is ok to do because usernames cannot be the same between users
                if ($username == $author){
                    //opens link for user to view their post
                    echo '<a href="view3.php? post_id= '.$post_id.'"> '.$title. ' </a>';
                    //display post id for easy deleting
                    echo("|              post id = ");
                    echo($post_id);
                    echo  nl2br ("\n");
                    
                }
            }
        ?>
    </div>
    </body>
</html>