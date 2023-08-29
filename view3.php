<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="homepage.css"> 
    <title>View stories</title>
</head>
<body><div id = "main">
<?php
session_start(); 
require 'connectData3.php'; 
ini_set('display_errors',1);
error_reporting(E_ALL);
//retrieving the post_id that we want to view plus all the information from it that is relevent
$post_id = htmlentities($_GET['post_id']);
$_SESSION['post_id'] = $post_id;

$stmt = $mysqli->prepare("select title, author, user_id, story, link, story_likes from stories where post_id =  ?");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
$stmt->bind_param('i', $post_id);
$stmt->execute();
$stmt->bind_result($title, $author, $author_id, $content, $link, $story_likes);
$stmt->fetch();
//if the user is set and the user_id is the same as the author's id, then we want to allow the user to delete/edit the post
if(isset($_SESSION['user'])) {
    if($_SESSION['user_id'] == $author_id){
        echo '<a href = "deletestoryfront.php"> Delete Post </a> <br>';
        echo '<a href = "editstoryfront.php"> Edit Post </a> <br>';
    } 
}
//displaying all of our story info
echo "<html><h1>".$title."</h1></html>";
echo  nl2br ("\n");
echo "<html><h2>".$author."</h2></html>";
echo ' <p> Link: '.$link.'</p>';
echo  nl2br ("\n");
echo($content);
echo  nl2br ("\n");
echo  nl2br ("\n");
echo  nl2br ("\n");
echo("Story likes: ");
echo($story_likes);
?>
   
<h1><br>Comments:</h1>

<?php
require 'connectData3.php'; 
ini_set('display_errors',1);
error_reporting(E_ALL);
$_SESSION['post_id'] = $post_id;
//retrieving all of the comments for this post
$stmt = $mysqli->prepare("select user_id, comment_text, comment_id, post_id, comment_author from comments where post_id =  ?");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
$stmt->bind_param('i', $post_id);
$stmt->execute();
$result = $stmt->get_result();
//printing all of the comments
while($row = $result->fetch_assoc()){
    $comment_author = $row["comment_author"];
    $comment_author_id = $row["user_id"];
    $comment_id = $row["comment_id"];
    echo ' <p> '.$row["comment_author"].': '.$row["comment_text"].'</p>';
    //giving the user the option to delete or edit comments if they are the comment's author
    if($_SESSION['user_id']==$comment_author_id){
        echo '<a href = "deletecomment.php?comment_id='.$comment_id.'"> Delete Comment </a> <br>';
        echo '<a href = "editcomment.php?comment_id='.$comment_id.'"> Edit Comment </a> <br>';
    }
}
$stmt->close();

?>
    <form action = "comment.php" method = "POST">
        Add a comment: <input type = "text" name = "comment" id = "comment"> <br>
        <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
        <input type="submit" value="Comment" /> <br>
</form>
<form action = "likePost.php" method = "POST">
<input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
        <label>Add kudos:      </label><input type="submit" value="Like" /> <br>
        
</form>
</div>
</body>
</html>