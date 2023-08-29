<?php
    require 'connectData3.php';
    session_start();
    //retrieving our username and the id of the post
    $username = $_SESSION['user'];
    $id = $_POST['id'];
    //deleting comments on this post
    if(!hash_equals($_SESSION['token'], $_POST['token'])){
        die("Request forgery detected");
    }
    $stmt = $mysqli->prepare("DELETE from comments where post_id=?");
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
    $stmt->bind_param('i', $id);
    $stmt->execute();
    //now deleting the story
    $stmt = $mysqli->prepare("DELETE from stories where post_id=? and author=?");
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
    $stmt->bind_param('is', $id, $username);
    $stmt->execute();
    $stmt->close();
    header('Location: userdash3.php');
?>