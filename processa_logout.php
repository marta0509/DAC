<?php
	session_start();
	$_SESSION['login']='incorreto';
	header("refresh:1; url=index.php");