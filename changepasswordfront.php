<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Change password</title>
        <link rel="stylesheet" type="text/css" href="homepage.css"> 
    </head>
    <body><div id = "main">
        <h1>Change password</h1>
        <form action='changepassword.php' method='POST'>
                <label>Current Password: </label><input type='password' name='currPass' required/>
                <br>
                <label>New Password: </label><input type='password' name='newPass' required/>
                <br>
                <label>Repeat New Password: </label><input type='password' name='repeatNewPass' required/>
                <input type="hidden" name="token" value="<?php session_start(); echo $_SESSION['token'];?>" />
                <input type='submit' value='Submit' />
            </form>
    <br>
    </div>
    </body>
</html>