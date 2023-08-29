<?php

    session_start();
    require 'connectData3.php';
    if(!hash_equals($_SESSION['token'], $_POST['token'])){
        die("Request forgery detected");
    }
    $username = $_SESSION['user'];
    //if the user is not who we think they are
    if ($username == null) {
        exit;
        header('Location: login3.php');
    }
    $currPass = $_POST['currPass'];
    $newPass = $_POST['newPass'];
    $repeatNewPass = $_POST['repeatNewPass'];
    //if the new password does not match the repeated password
    if($newPass != $repeatNewPass){
        echo("New password does not match");
        echo '<a href = "userdash3.php"> Please try again </a> <br>';
    }
    else{
        //getting our current password
        $stmt = $mysqli->prepare("SELECT password from users where username=?");
        if(!$stmt){
            printf("Query failed: %s\n", $mysqli->error);
            exit;
        }
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->bind_result($pass);
        
        if($stmt->fetch()){
                
                $stmt->close();
                //verifying that our current password matches what the user entered
                if(password_verify($currPass, trim($pass)))   {
                 
                    $stmt = $mysqli->prepare("UPDATE users set password=? where username=?");
                    if(!$stmt)
                    {
                        printf("stmt Prep Failed: %s\n", $mysqli->error);
                        exit;
                    }
                    //hashing our password for security
                    $stmt->bind_param('ss',password_hash($_POST['newPass'], PASSWORD_DEFAULT),$username);
                    $stmt->execute();
                    $stmt->close();
                    header("Location: userdash3.php");
                }
                else    {
                    echo("Current password doesn't match");
                    echo '<a href = "userdash3.php"> Please try again </a> <br>';
                }
                
            }
        else    {
            //user is not who we think they are - send back to login
            echo("User does not exist");
            header("Location: login3.html");
        }
            
    }
    
?>