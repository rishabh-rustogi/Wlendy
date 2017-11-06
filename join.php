<?php
	if(isset($_POST['join']) && $_POST['join']=="Join")
	{
		session_start();
		$_SESSION['way']=2;
		header("Location:http://www.wlendy.in/login.php");
	}
	else
	{
		session_start();
		$_SESSION['way']=1;
		header("Location:http://www.wlendy.in/login.php");
	}
?>