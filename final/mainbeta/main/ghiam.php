<?php
	session_start();
	require('connect.php');
	if ($_SESSION['username']) {

?>

<html>
  <head>

    <title>Ghi âm</title>
  </head>
  <body>
<?php include("header.php"); ?>
    
    <div id="controls">
  	 <button id="recordButton">Record</button>
  	 <button id="pauseButton" disabled>Pause</button>
  	 <button id="stopButton" disabled>Stop</button>
    </div>
    <div id="formats">Format: start recording to see sample rate</div>
  	<p><strong>Recordings:</strong></p>
  	<ol id="recordingsList"></ol>
    <!-- inserting these scripts at the end to be able to use all the elements in the DOM 
  	<script src="https://cdn.rawgit.com/mattdiamond/Recorderjs/08e7abd9/dist/recorder.js"></script>
  	<script src="js/app.js"></script>-->
  </body>
</html>
<?php
	}
?>