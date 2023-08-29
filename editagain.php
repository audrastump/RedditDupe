<?php 
    session_start();
    require 'connectData3.php'; 
    if(!hash_equals($_SESSION['token'], $_POST['token'])){
        die("Request forgery detected");
    }
    $comment = $_POST['comment'];
    $comment_id = $_SESSION['comment_id']; 
    //checking our comment id to set the comment_text equal to what the user inputted
    $stmt = $mysqli->prepare("update comments set comment_text = '$comment' where comment_id = ?");
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
    $stmt->bind_param('i', $comment_id);
    $stmt->execute();
    $stmt->close();
    //unsetting comment id so we don't get any issues
    unset($_SESSION['comment_id']);
    header("Location: userdash3.php");
?>