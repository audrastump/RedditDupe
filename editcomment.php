<?php
session_start();
require 'connectData3.php'; 

$comment_id = $_GET['comment_id'];
$_SESSION['comment_id'] = $comment_id;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Delete</title>
        <link rel="stylesheet" type="text/css" href="homepage.css"> 
    </head>
 <body>
    <h3>Edit commment</h3>
     <form action = "editagain.php" method = "POST"> 
         <label>Replace Previous Comment: </label><input type = "text" id = "comment" name = "comment"> <br>
         <input type="hidden" name="token" value="<?php session_start(); echo $_SESSION['token'];?>" />
         <input type = "submit" value = "Revise">
     </form>
 </body>
</html>