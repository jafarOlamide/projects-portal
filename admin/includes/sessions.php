<?php 
/**
 * 
 */
class Session
{
	
	function __construct()
	{
		session_start(); 
	}
}

ob_start(); 
$session = new Session();
?>