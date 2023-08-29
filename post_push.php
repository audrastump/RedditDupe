<?php
    session_start();
    ini_set('display_errors',1);
    error_reporting(E_ALL);
    require 'connectData3.php';
    if(!hash_equals($_SESSION['token'], $_POST['token'])){
        die("Request forgery detected");
    }
    //getting all the info we need for the post from our front end
    $title = $_POST['title'];
    $author = $_SESSION['user'];
    $story = $_POST['content'];
    $user_id = $_SESSION['user_id'];
    $link = $_POST['url'];
    //inserting into the stories table
    $stmt = $mysqli->prepare("insert into stories(title, author, user_id, story, link) values (?,?,?,?,?)");
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
    else{
        $stmt->bind_param("ssiss", $title, $author, $user_id, $story, $link);
        $stmt->execute();
        $stmt->close();
        header("Location: userdash3.php");
    }
    ?>