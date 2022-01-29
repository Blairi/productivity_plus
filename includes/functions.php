<?php
function user_authenticated() : bool{
	session_start();
	$auth = $_SESSION['login'] ?? false;

	if($auth){
		return true;
	}
	return false;
	
}

function admin_authenticated() : bool{
	
	$auth = $_SESSION['admin'];

	if($auth){
		return true;
	}
	return false;
	
}