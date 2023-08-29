<?php

session_start();

    require 'connectData3.php';
    $stmt = $mysqli->prepare("SELECT COUNT(*), id, password from users where username=?");
    
    $_SESSION['user'] = (string) $_POST['username'];
    //the user cannot have a weird username- not allowed!
    $user = $_SESSION['user'];
    if( !preg_match('/^[\w_\-]+$/', $user) ){
        echo("that username is too crazy for this website, please pick another");
        exit;
    }

    $stmt->bind_param('s',$user);
    $stmt->execute();
    $stmt->bind_result($cnt, $user_id, $pwd_hash);
    $stmt->fetch();
    
    if($mysqli->connect_errno) {
        printf("Connection Failed: %s\n", $mysqli->connect_error);
        exit;
    }
    
    $pwd_guess = (string) $_POST['password'];
    //if there is one user and we can verify the guess with the hashed password
    if($cnt==1 && password_verify($pwd_guess, $pwd_hash)){
        //user can login!
        $_SESSION['user_id'] = $user_id;
       
        header('LOCATION:userdash3.php');
    } else {
        //tell user that their login failed
        echo("login failed");
    }
    
    $stmt->close();
    //generate token
    $_SESSION['token'] = bin2hex(random_bytes(32));


?>