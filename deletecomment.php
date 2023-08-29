<?php
 session_start();
 require 'connectData3.php'; 
 //getting comment id and converting to html entities
 
 $comment_id = htmlentities($_GET['comment_id']);
 $stmt = $mysqli->prepare("DELETE from comments where comment_id = ?");
if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}
    $stmt->bind_param('i', $comment_id);
    $stmt->execute();
    $stmt->close();
    //we want to unset the comment id after so that we don't do something with a comment that was deleted
    unset($_SESSION['comment_id']);
    header("Location: userdash3.php");
?>