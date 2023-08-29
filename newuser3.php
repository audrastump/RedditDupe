<?php
session_start();
require 'connectData3.php';
    $newuser = (string) $_POST['newuser'];
    //user cannot have a crazy username
    if( !preg_match('/^[\w_\-]+$/', $newuser) ){
        echo("One or more invalid characters was used in your username, please pick a different one.");
        exit;
    }
    $newpassword = password_hash((string) $_POST['newpassword'], PASSWORD_DEFAULT);
    //checking if the username already exists via the cnt
    $stmt = $mysqli->prepare("SELECT COUNT(*) from users where username=?");
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }

    $_SESSION['user'] = (string) $_POST['newuser'];
    $user = $_SESSION['user'];
    $stmt->bind_param('s', $user);
    $stmt->execute();

    $stmt->bind_result($cnt);
    $stmt->fetch();

    //if the username already exists
    if ($cnt>0) {
        echo("This username already exists, please try again");
        
        exit;
    }
    $stmt->close();
    echo($newuser);
    echo($newpassword);
    //if all is well with the login info, we reach this point, in which we can insert into the users the new user
    $stmt = $mysqli->prepare("insert into users (username, password) values (?,?)");
    if (!$stmt) {
        printf("Query Prep Failed: %s \n", $mysqli->error);
        exit;
    }

    $stmt->bind_param('ss', $newuser, $newpassword);
    //if issue with the execution
    if(!$stmt->execute()){
        $stmt->close();
        echo('There was an issue executing your request, please try again.');
        
    }
    else{
        $stmt->close();
        header('location:loginsuccess3.html');
    }
    
    
?>