<?php
	session_start();
	if(isset($_SESSION['user']) && isset($_SESSION['pass']) && isset($_SESSION['way']))
	{
		$user=$_SESSION['user'];
		$pass=$_SESSION['pass'];
		$way=$_SESSION['way'];
		$dbhost="localhost";
		$dbuser="wlenditu_root";
		$dbpass="rishabhabhishek";
		$conn=mysql_connect($dbhost,$dbuser,$dbpass);
		if( !$conn )
		{
			mysql_close($conn);
			header("Location:http://www.wlendy.in/index.php");
			break;
		}
		mysql_select_db('wlenditu_login');
		$q="select * from user_details where user_id='$user' and user_pass='$pass';";
		$ask=mysql_query($q,$conn);
		if(!$ask)
		{
			mysql_close($conn);
			header("Location:http://www.wlendy.in/index.php");
			break;
		}
		if($row=mysql_fetch_array($ask, MYSQL_ASSOC))
		{
			if($user==$row['user_id'] && $pass==$row['user_pass'])
			{
				if($way==1)
				{
					header("Location:http://www.wlendy.in/index.php");
				}
				else if($way==2)
				{
					header("Location:http://www.wlendy.in/carpool_re_li.php?level=2");
				}
				else if($way==3)
				{
					header("Location:http://www.wlendy.in/addform.php");
				}
				else
				{
					header("Location:http://www.wlendy.in/index.php");
				}
			}
			else
			{
				header("Location:http://www.wlendy.in/index.php");
			}
		}
		else
		{
			header("Location:http://www.wlendy.in/index.php");
		}
	}
	else
	{
		 header("Location:http://www.wlendy.in/index.php");
	}
?>