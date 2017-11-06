<?php


		session_start();
			session_unset();
				session_destroy();
				header("Location:http://www.wlendy.in/loggedout.php");
?>

