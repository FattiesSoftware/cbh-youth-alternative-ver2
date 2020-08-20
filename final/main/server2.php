<?php 
// connect to database
$db = mysqli_connect('localhost', 'root', '', 'php_forum');

// lets assume a user is logged in with id $user_id
//$user_id = 2;

if (!$db) {
  die("Error connecting to database: " . mysqli_connect_error($db));
  exit();
}
	$query = "SELECT * FROM users WHERE username='".$_SESSION['username']."'";
	$results = mysqli_query($db, $query);
	$rows= mysqli_num_rows($results);
	while($row = mysqli_fetch_assoc($results)){
		$user_id=$row['id'];
	}


// if user clicks like or dislike button
if (isset($_POST['action'])) {
  $topic_id = $_POST['topic_id'];
  $action = $_POST['action'];
  switch ($action) {
  	case 'like':
         $sql="INSERT INTO rating_info (user_id, topic_id, rating_action) 
         	   VALUES ($user_id, $topic_id, 'like') 
         	   ON DUPLICATE KEY UPDATE rating_action='like'";
         break;
  	case 'dislike':
          $sql="INSERT INTO rating_info (user_id, topic_id, rating_action) 
               VALUES ($user_id, $topic_id, 'dislike') 
         	   ON DUPLICATE KEY UPDATE rating_action='dislike'";
         break;
  	case 'unlike':
	      $sql="DELETE FROM rating_info WHERE user_id=$user_id AND topic_id=$topic_id";
	      break;
  	case 'undislike':
      	  $sql="DELETE FROM rating_info WHERE user_id=$user_id AND topic_id=$topic_id";
      break;
  	default:
  		break;
  }

  // execute query to effect changes in the database ...
  mysqli_query($db, $sql);
  echo getRating($topic_id);
  exit(0);
}

// Get total number of likes for a particular post
function getLikes($id)
{
  global $db;
  $sql = "SELECT COUNT(*) FROM rating_info 
  		  WHERE topic_id = $id AND rating_action='like'";
  $rs = mysqli_query($db, $sql);
  $result = mysqli_fetch_array($rs);
  return $result[0];
}

// Get total number of dislikes for a particular post
function getDislikes($id)
{
  global $db;
  $sql = "SELECT COUNT(*) FROM rating_info 
  		  WHERE topic_id = $id AND rating_action='dislike'";
  $rs = mysqli_query($db, $sql);
  $result = mysqli_fetch_array($rs);
  return $result[0];
}

// Get total number of likes and dislikes for a particular post
function getRating($id)
{
  global $db;
  $rating = array();
  $likes_query = "SELECT COUNT(*) FROM rating_info WHERE topic_id = $id AND rating_action='like'";
  $dislikes_query = "SELECT COUNT(*) FROM rating_info 
		  			WHERE topic_id = $id AND rating_action='dislike'";
  $likes_rs = mysqli_query($db, $likes_query);
  $dislikes_rs = mysqli_query($db, $dislikes_query);
  $likes = mysqli_fetch_array($likes_rs);
  $dislikes = mysqli_fetch_array($dislikes_rs);
  $rating = [
  	'likes' => $likes[0],
  	'dislikes' => $dislikes[0]
  ];
  return json_encode($rating);
}

// Check if user already likes post or not
function userLiked($topic_id)
{
  global $db;
  global $user_id;
  $sql = "SELECT * FROM rating_info WHERE user_id=$user_id 
  		  AND topic_id=$topic_id AND rating_action='like'";
  $result = mysqli_query($db, $sql);
  if (mysqli_num_rows($result) > 0) {
  	return true;
  }else{
  	return false;
  }
}

// Check if user already dislikes post or not
function userDisliked($topic_id)
{
  global $db;
  global $user_id;
  $sql = "SELECT * FROM rating_info WHERE user_id=$user_id 
  		  AND topic_id=$topic_id AND rating_action='dislike'";
  $result = mysqli_query($db, $sql);
  if (mysqli_num_rows($result) > 0) {
  	return true;
  }else{
  	return false;
  }
}

$sql = "SELECT * FROM topics";
$result = mysqli_query($db, $sql);
// fetch all topics from database
// return them as an associative array called $topics
$topics = mysqli_fetch_all($result, MYSQLI_ASSOC);
	