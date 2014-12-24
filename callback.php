<?php 	
require_once 'app/initate.php'; 
$auth = new TwitterAuth($client);
 if($auth->signIn())
 {
 	header('Location: index.php');
 }
 else
 {
 	die('Sign In Failed');
 }
?>