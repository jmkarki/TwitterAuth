<?php 
	require_once 'app/initate.php';

	$auth = new TwitterAuth($client);

	if($auth->signedIn() === true):
		echo '<p>You are signed in. <a href="signout.php">Sign Out</a></p>';
		echo '<br> Your Details:<br>';
		print_r($auth->data);
	else:
		echo '<p><a href="'.$auth->getAuthUrl().'">Sign In with Twitter!</a></p>';
	
	endif;
?>