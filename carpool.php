<?php
	session_start();
	$user=$_SESSION['user'];
	$pass=$_SESSION['pass'];
	if(isset($_SESSION['user']) && isset($_SESSION['pass']))
	{
		$dbhost="localhost";
		$dbuser="wlenditu_root";
		$dbpass="rishabhabhishek";
		$conn=mysql_connect($dbhost,$dbuser,$dbpass);
		if( !$conn )
		{
			mysql_close($conn);
			header("Location:carpool_re_lo.php");
		}
		mysql_select_db('wlenditu_login');
		$q="select * from user_details where user_id='$user' and user_pass='$pass';";
		$ask=mysql_query($q,$conn);
		if(!$ask)
		{
			mysql_close($conn);
			header("Location:carpool_re_lo.php");
			
		}
		if($row=mysql_fetch_array($ask, MYSQL_ASSOC))
		{	
			if($row['user_id']==$user && $row['user_status']=="active" && $row['user_auth']==2)
			{
				header("Location:carpool_re_li.php");
			}
			else
			{
				header("Location:carpool_re_lo.php");
			}
		}
		else
		{
			header("Location:carpool_se_lo.php");
		}
	}
	else
	{
		header("Location:carpool_re_lo.php");
	}
?>
			
			
			