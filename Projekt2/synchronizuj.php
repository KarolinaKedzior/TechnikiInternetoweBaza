<?php

include_once 'menu.php';
include_once 'ObslugaBazy.php';
session_start();
$user = new Register_new;
$baza = new ObslugaBazy;	
echo $baza->_save();

?>