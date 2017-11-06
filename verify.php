<?php
	if(isset($_GET['email']) && isset($_GET['hash']))
	{
		$email=$_GET['email'];
		$hash=$_GET['hash'];
		$dbhost="localhost";
		$dbuser="wlenditu_root";
		$dbpass="rishabhabhishek";
		$conn=mysql_connect($dbhost,$dbuser,$dbpass);
		if( !$conn )
		{
			header("Location:http://www.wlendy.in/index.php");
			mysql_close($conn);
			break;
		}
		mysql_select_db('wlenditu_login');
		$q="select * from user_temp where t_email='$email' and t_hash='$hash';";
		$ask=mysql_query($q,$conn);
		if(!$ask)
		{
			mysql_close($conn);
			header("Location:http://www.wlendy.in/index.php");
			break;
		}
		if($row=mysql_fetch_array($ask, MYSQL_ASSOC))
		{
			if($row['t_hash']==$hash && $row['t_email']==$email)
			{
				$tpass = chr(rand(65,90)).chr(rand(97,122)).chr(rand(65,90)).chr(rand(97,122)).chr(rand(48,57)).chr(rand(48,57)).chr(rand(97,122)). chr(rand(65,90));
				$user=$row['t_id'];
				$pass=$row['t_pass'];
				$mobile=$row['t_mobile'];
				$fname=$row['t_fname'];
				$lname=$row['t_lname'];
				$sex=$row['t_sex'];
				$q1="INSERT INTO user_details (user_id,user_pass,user_email,user_mobile,user_fname,user_lname,user_sex,user_pass_temp)VALUES ('$user','$pass','$email','$mobile','$fname', '$lname','$sex','$tpass');";
				$ask1=mysql_query($q1,$conn);
				if(!$ask1)
				{
					mysql_close($conn);
					header("Location:http://www.wlendy.in/index.php");
					break;
				}
				$q1="delete from user_temp where t_email='$email';";
				$ask1=mysql_query($q1,$conn);
				if(!$ask1)
				{
					mysql_close($conn);
					header("Location:http://www.wlendy.in/index.php");
					break;
				}
				mysql_close($conn);
				header("Location:http://www.wlendy.in/login.php");
				break;
			}
			else
			{
				mysql_close($conn);
				header("Location:http://www.wlendy.in/index.php");
				break;
			}
			
		}
		else
		{
			mysql_close($conn);
			header("Location:http://www.wlendy.in/index.php");
			break;
		}
	}
	else
	{
		header("Location:http://www.wlendy.in/index.php");
	}	
?>