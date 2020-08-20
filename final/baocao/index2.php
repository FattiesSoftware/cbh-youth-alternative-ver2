<?php
// Include GitHub API config file
require_once 'gitConfig.php';

// Include and initialize user class
require_once 'User.class.php';
$user = new User();

if(isset($accessToken)){
    // Get the user profile info from Github
    $gitUser = $gitClient->apiRequest($accessToken);
    
    if(!empty($gitUser)){
        // User profile data
        $gitUserData = array();
        $gitUserData['oauth_provider'] = 'github';
        $gitUserData['oauth_uid'] = !empty($gitUser->id)?$gitUser->id:'';
        $gitUserData['name'] = !empty($gitUser->name)?$gitUser->name:'';
        $gitUserData['username'] = !empty($gitUser->login)?$gitUser->login:'';
        $gitUserData['email'] = !empty($gitUser->email)?$gitUser->email:'';
        $gitUserData['location'] = !empty($gitUser->location)?$gitUser->location:'';
        $gitUserData['picture'] = !empty($gitUser->avatar_url)?$gitUser->avatar_url:'';
        $gitUserData['link'] = !empty($gitUser->html_url)?$gitUser->html_url:'';
        
        // Insert or update user data to the database
        $userData = $user->checkUser($gitUserData);
        
        // Put user data into the session
        $_SESSION['userData'] = $userData;

        // Render Github profile data
        $output  = '<h2>Github Profile Details</h2>';
        $output .= '<img src="'.$userData['profile_pic'].'" />';
        $output .= '<p>ID: '.$userData['oauth_uid'].'</p>';
        $output .= '<p>Name: '.$userData['name'].'</p>';
        $output .= '<p>Login Username: '.$userData['username'].'</p>';
        $output .= '<p>Email: '.$userData['email'].'</p>';
        $output .= '<p>Location: '.$userData['location'].'</p>';
        $output .= '<p>Profile Link :  <a href="'.$userData['link'].'" target="_blank">Click to visit GitHub page</a></p>';
        $output .= '<p>Logout from <a href="logout.php">GitHub</a></p>'; 
    }else{
        $output = '<h3 style="color:red">Some problem occurred, please try again.</h3>';
    }
    
}elseif(isset($_GET['code'])){
    // Verify the state matches the stored state
    if(!$_GET['state'] || $_SESSION['state'] != $_GET['state']) {
        header("Location: ".$_SERVER['PHP_SELF']);
    }
    
    // Exchange the auth code for a token
    $accessToken = $gitClient->getAccessToken($_GET['state'], $_GET['code']);
  
    $_SESSION['access_token'] = $accessToken;
  
    header('Location: ./');
}else{

    // Generate a random hash and store in the session for security
    $_SESSION['state'] = hash('sha256', microtime(TRUE) . rand() . $_SERVER['REMOTE_ADDR']);
    
    // Remove access token from the session
    unset($_SESSION['access_token']);
  
    // Get the URL to authorize
    $loginURL = $gitClient->getAuthorizeURL($_SESSION['state']);
    
    // Render Github login button
    $output2 = '<a type="button" href="'.htmlspecialchars($loginURL).'" class="col-1" style="color: rgb(51, 51, 51);"><img src="data:image/png;base64,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"/></a>';
}
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
<title>Login with GitHub using PHP by CodexWorld</title>
<meta charset="utf-8">
</head>
<body>
<div class="container">
    <!-- Display login button / GitHub profile information -->
    <div class="wrapper" style='display:<?=$OUT1?>'><?php echo $output; ?></div>
	<div class="wrapper" style='display:<?=$OUT2?>'><?php echo $output2; ?></div>
</div>

</body>
</html>