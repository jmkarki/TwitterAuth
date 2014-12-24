<?php 
session_start();
require_once 'vendor/autoload.php';
require_once 'classes/DB.php';
require_once 'classes/TwitterAuth.php';

\Codebird\Codebird::setConsumerKey('LIW1Fp6nowCNMmasFddtalDtm', 'K4EnmEyUHktlWxM0ZVsvZbYFdTXcxZqxBK8gmMLDhepEgp0JRA');
$client = \Codebird\Codebird::getInstance();

 ?>