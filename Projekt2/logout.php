<?php

	include_once 'menu.php';
	session_start();
	$reg = new Register_new ;
	Menu::$isUserAuthorized = false;
    $reg->_logout();
	header('Location:index.php');

?>