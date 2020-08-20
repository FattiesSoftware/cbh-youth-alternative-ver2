<?php
// Start session
if(!session_id()){
    session_start();
}

// Include Github client library 
require_once 'Github_OAuth_Client.php';


/*
 * Configuration and setup GitHub API
 */
$clientID         = '512c3e376bd0a49792b5';
$clientSecret     = '7a6d1cd0a7721e395877e5a18ab1c28d03ce8ab4';
$redirectURL     = 'http://localhost/baocao/index2.php';

$gitClient = new Github_OAuth_Client(array(
    'client_id' => $clientID,
    'client_secret' => $clientSecret,
    'redirect_uri' => $redirectURL,
));


// Try to get the access token
if(isset($_SESSION['access_token'])){
    $accessToken = $_SESSION['access_token'];
}