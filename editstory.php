<?php
    session_start();
    require 'connectData3.php';
    if(!hash_equals($_SESSION['token'], $_POST['token'])){
        die("Request forgery detected");
    }
    //retrieving our username of the author, the post id, and what we want to change it to 
    $username = $_SESSION['user'];
    $id = $_POST['id'];
    $new_text = $_POST['new_text'];
  
    $stmt = $mysqli->prepare("UPDATE stories SET story=? WHERE author=? AND post_id=?");
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
    $stmt->bind_param('ssi', $new_text, $username, $id);
    $stmt->execute();
    $stmt->close();
    header('Location: userdash3.php');
?>