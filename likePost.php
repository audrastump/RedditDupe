<!DOCTYPE html> 
<html>
<head>
    <link rel="stylesheet" type="text/css" href="homepage.css"> 
    <title>Like Post</title>    
</head>
<body>
    <div id = "main">
<?php
session_start();
require 'connectData3.php';

if(!hash_equals($_SESSION['token'], $_POST['token'])){
    die("Request forgery detected");
}
$username = $_SESSION['user'];
$post_id = $_SESSION['post_id'];
//finding the number of likes on the post
$stmt = $mysqli->prepare("SELECT story_likes from stories where post_id = ?");
    if(!$stmt){
    	printf("Query Prep Failed: %s\n", $mysqli->error);
    	exit;
    }

$stmt->bind_param('i', $post_id);
$stmt->execute();
$stmt->bind_result($likes);
$stmt->fetch();
$stmt->close();

//adding one to the number of likes and updating into our database
$stmt = $mysqli->prepare("UPDATE stories set story_likes=? where post_id=? ");
if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}
$likes = $likes + 1;

$stmt->bind_param('ii',$likes, $post_id);
$stmt->execute();
$stmt->close();  

?>
<form action = 'userdash3.php' method = 'GET'>
        <input type = 'hidden' name = 'post_id' value = $post_id>
        <input type = 'submit' value = 'Go back'>
</form>
</div
</body>
</html>