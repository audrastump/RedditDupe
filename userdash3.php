<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="homepage.css"> 
        <title>User Dashboard</title>
    </head>
    <body> <div id = "main">
        <h1>My dashboard</h1>
        <h2><a href = "post3.php"> Post a story <br> </a></h2>
        <h2><a href = "editstoryfront.php" class = "edit"> Edit post <br></a></h2>
        <h2><a href = "deletestoryfront.php"> Delete post <br></a></h2>
        <h2><a href = "changepasswordfront.php"> Change password <br></a></h2>
        <form action='search.php' method='POST'>
            <label>Search here:</label>
            <input type='text' name='key_word'>
            <input type='submit' name='submit'>
        </form>
        <?php
        session_start();
        ini_set('display_errors',1);
        error_reporting(E_ALL);
        require 'connectData3.php';
        
        $stmt = $mysqli->prepare("select title, author, story, link, post_id, story_likes from stories");
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
                $story_likes = $row["story_likes"];
                echo '<a href="view3.php? post_id= '.$post_id.'"> '.$title.' by '.$author.' </a> <br>';
            }
        ?>
        <form action = "logout3.php">
            <input type = "submit" value = "logout">
        </form>
    </div>
    </body>
</html>
    