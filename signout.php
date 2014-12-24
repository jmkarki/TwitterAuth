<?php 
	require_once 'app/initate.php';

	$auth = new TwitterAuth($client);
	$auth->signOut();

	header('Location: index.php');
?>