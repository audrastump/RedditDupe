<!DOCTYPE html>
<html lang="en">
<head>
        <link rel="stylesheet" type="text/css" href="homepage.css"> 
        <title>Post a Story</title>
</head>
<body>
    <h3> Post a story</h3>
    <form action = "post_push.php" method = "POST">
        <label>Title: </label><input type = "text" id = "title" name = "title">
        <label>Story content: </label><input type = "textarea" id = "content" name = "content">
        <label>URL Link: </label><input type = "url" name = "url" id = "url">
        <input type="hidden" name="token" value="<?php session_start(); echo $_SESSION['token'];?>" />
        <input type = "submit" value = "submit">
    </form>
    <form action = "userdash3.php">
        <input type = "submit" value = "Return Home">
    </form>
</body>
</html>