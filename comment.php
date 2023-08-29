<?php
    session_start();
    require 'connectData3.php';
   //getting our user id, comment, and post id plus the uathor
    $user_id = htmlentities($_SESSION['user_id']);
    $comment = htmlentities($_POST['comment']);
    $post_id = htmlentities($_SESSION['post_id']);
    $comment_author = htmlentities($_SESSION['user']);
    //if the comment length is over 256 chars, we want to tell them
    if (strlen ($comment) > 256) {
        printf("Your comment is too long, please limit to 256 characters!");
        exit;
    }
    //insert that into the comments
    $stmt = $mysqli->prepare("INSERT into comments (user_id, post_id, comment_text, comment_author) values (?, ?, ?,?)");
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
    $stmt->bind_param('iiss', $user_id, $post_id, $comment, $comment_author);
    $stmt->execute();
    $stmt->close();
    
    header("Location: userdash3.php");
    exit;
?>