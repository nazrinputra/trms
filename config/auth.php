<?php

if(!isset($_SESSION["id"]))
{
	header("Location: http://localhost/TRMS/index.php");
	exit(); 
}

?>