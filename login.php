<?php

	session_start();
		if(isset($_SESSION['user']) && isset($_SESSION['pass']))
		{
			$us=$_SESSION['user'];
			$pa=$_SESSION['pass'];
			$dbhost="localhost";
			$dbuser="wlenditu_root";
			$dbpass="rishabhabhishek";
			$conn=mysql_connect($dbhost,$dbuser,$dbpass);
			if( !$conn )
			{
				mysql_close($conn);
				header("Location:http://www.wlendy.in/index.php");
			}
			$a=mysql_select_db('wlenditu_login');
			if(!$a)
			{
				mysql_close($conn);
				header("Location:http://www.wlendy.in/index.php");
			}
			$q="select * from user_details where user_id='$us' and user_pass='$pa';";
			$ask=mysql_query($q,$conn);
			if(!$ask)
			{
				mysql_close($conn);
				header("Location:http://www.wlendy.in/index.php");
			}
			if($row=mysql_fetch_array($ask, MYSQL_ASSOC))
			{
				mysql_close($conn);
				header("Location:http://www.wlendy.in/index.php");
			}
			else
			{
				mysql_close($conn);
				session_unset();
				session_destroy();
			}
		}


	if(isset($_POST['join']) && $_POST['join']=="Join")
	{
		$way=2;
	}
	else
	{
		$way=1;
	}
	if(isset($_POST['add']))
	{
		$way=3;
	}

	while(1)
	{
		$x=1;
		if(isset($_POST['forgot']))
		{
			header("Location:http://www.wlendy.in/forgot.php");
		}
    		if(isset($_POST['log']))
   	 	{ 
    			$message="encode";
    			$user=$_POST['userid'];
			$pass=$_POST['pass'];
			$way=$_POST['level'];
			if(!is_numeric($way))
			{
				$message="Your id or password is incorrect";
				$x=2;
				break;
			}
			if($user=="" || $pass=="")
			{
				$message="Please fill all the details";
				$x=2;
				break;
			}
			$user=chop(strtolower($user));
			$a1=ord(substr($user,0));
			$a2=ord(substr($user,1));
			$num=substr($user,2,4);
			if(strlen($user)!=5)
			{
				$message="Your id or password is incorrect";
				$x=2;
				break;
			}
			if(!is_numeric($num))
			{
				$message="Your id or password is incorrect";
				$x=2;
				break;
			}
			if($a1>122 || $a1<97 || $a2>122 || $a2<97)
			{
				$message="Your id or password is incorrect";
				$x=2;
				break;
			}
			$passlen=strlen($pass);
			if($passlen<6)
			{
				$message="Your id or password is incorrect";
				$x=2;
				break;
			}
			if($passlen>15)
			{
				$message="Your id or password is incorrect";
				$x=2;
				break;
			}
			$dbhost="localhost";
			$dbuser="wlenditu_root";
			$dbpass="rishabhabhishek";
			$conn=mysql_connect($dbhost,$dbuser,$dbpass);
			if( !$conn )
			{
				$message="Please try again";
				$x=2;
				mysql_close($conn);
				break;
			}
			mysql_select_db('wlenditu_login');
			$q="select * from user_details where user_id='$user';";
			$ask=mysql_query($q,$conn);
			if(!$ask)
			{
				$message="Please try again";
				$x=2;
				mysql_close($conn);
				break;
			}
			if($row=mysql_fetch_array($ask, MYSQL_ASSOC))
			{
				$attempt=$row['user_attempt'];
				if($attempt>=5)
				{
					$passreal=$row['user_pass_temp'];
					if($passreal==$pass)
					{
					$qupdate="UPDATE user_details SET user_auth=2,user_status='active',user_attempt=0,user_pass='$passreal' WHERE user_id='$user'";
						$ask2=mysql_query($qupdate,$conn);
						if(!$ask2)
						{
							$message="Please try again)";
							mysql_close($conn);
							break;
						}
						session_start();
						$_SESSION['user']=$user;
						$_SESSION['pass']=$passreal;
						$_SESSION['way']=$way;
						mysql_close($conn);
						header("Location:http://www.wlendy.in/choose.php");
					}
					$qupdate="UPDATE user_details SET user_auth=1,user_status='inactive' WHERE user_id='$user'";
					$ask2=mysql_query($qupdate,$conn);
					if(!$ask2)
					{
						$message="Please try again";
						mysql_close($conn);
						break;
					}
					$message="Your account is deactivated. Kindly go to forgot password";
					mysql_close($conn);
					break;
				}
				$passreal=$row['user_pass'];
				if($passreal!=$pass)
				{
					$attempt++;
					if($attempt<5)
					{
						$message="Your password is incorrect";
					}
					else if($attempt==5)
					{
						$message="Your password is incorrect (Last Try)";
					}
					$qupdate="UPDATE user_details SET user_auth=1,user_attempt=$attempt WHERE user_id='$user'";
					$ask2=mysql_query($qupdate,$conn);
					if(!$ask2)
					{
						$message="Please try again";
						mysql_close($conn);
						break;
					}
					mysql_close($conn);
					break;
				}
				else
				{
					$qupdate="UPDATE user_details SET user_auth=2, user_attempt=0 WHERE user_id='$user'";
					$ask2=mysql_query($qupdate,$conn);
					if(!$ask2)
					{
						$message="Please try again";
						mysql_close($conn);
						break;
					}
					session_start();
					$_SESSION['user']=$user;
					$_SESSION['pass']=$passreal;
					$_SESSION['way']=$way;
					$x=3;
					mysql_close($conn);
					header("Location:http://www.wlendy.in/choose.php");
				}
			}
			else
			{
				$message="Your id or password is incorrect";
				mysql_close($conn);
				break;
			}
			
		}
		break;
	}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
<title>Login</title>
        <meta name="keywords" content="" />
		<meta name="description" content="" />
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/> 
 <link rel="icon" href="favicon.ico" type="image/x-icon"/>
        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.css" rel='stylesheet' type='text/css'>

        <!-- Custom styles for this template -->
        <link href="js/colorbox/colorbox.css"  rel='stylesheet' type='text/css'>
        <link href="css/templatemo_style.css"  rel='stylesheet' type='text/css'>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    
    <body>

        <div class="templatemo-top-menu">
    <div class="container1">
                <!-- Static navbar -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">
                      <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                        </button>
                          <a href="http://www.wlendy.in/index.php" class="navbar-brand"><img src="images/logotitle.png" id="tit" height="20%" /></a></div>
          <span class="navbar-collapse collapse" id="templatemo-nav-bar" style="padding-top: 30px;">
                               <center>
                               <ul class="nav navbar-nav navbar-right">
                                <li ><a href="http://www.wlendy.in/index.php">HOME</a></li>
			      <li><a href="http://www.wlendy.in/signup.php">SIGN IN</a></li>
                           <li><a href="http://www.wlendy.in/contact-us.php">CONTACT US</a></li>
                            </ul>
                            </center>
					  </span>
					  
                        
                  </div><!--/.container-fluid -->
                </div><!--/.navbar -->
    </div> <!-- /container -->
        </div>
   <br>
                <br>
                        <br>
                                <br>
        <br>
                <br><center><h1>LOGIN</h1></center>
                        <br>
                                <br>	
        <center>
        
       
        
<form action="<?php $_PHP_SELF; ?>" method="POST">
	<table width="30%"  border="7" bordercolor="rgba(0,33,71,1.00)"  style="font-size:120%; background:rgba(241,244,248,1.00); color:rgba(0,0,0,1.00); border-color: rgba(0,33,71,1.00)" 
		        <tr> 
        <td  style="border:none" colspan="4" >
        <br>
        </td>
        </tr>
    
    	<tr>
        <td style="border:none; color:" >
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
        </td>
        <td style="border:none">
        		User ID
        </td>
        <td style="border:none">
	        	 <input type="text" name="userid" id="user" required autofocus autocomplete="on" class="sibutton"><br>

        </td>
                <td style="border:none" >
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
        </td>
        </tr>
        <tr>
        <td colspan="4" style="border:none">
        <br>
        </td>
        </tr>
        <tr>
                <td style="border:none" >
                
        </td>
        <td style="border:none">
        		Password &nbsp;
        </td>
        <td style="border:none">
				<input type="password" name="pass" id="pass" autocomplete="on" class="sibutton">        
        </td>
                <td style="border:none" >
                
        </td>
        </tr>
        <tr>
                <td style="border:none" >
                
        </td>
        <td  style="border:none" colspan="2" ><input type="hidden" name="level" value="<?php print $way ?>"> 
        <br>
        </td>
                <td style="border:none" >
                
        </td>
        </tr>
        <br> 
<tr>
                <td style="border:none" >
                
        </td>
        <td   style="border:none; " colspan="2">
				   <center><font color="red"><?php
			if(isset($message))
			{
				if($message!="encode")
				{
					print "<center> $message</center>";
				}
				else
				{
					
				}
			}
			else
			{
				
			}	
	?></font></center>
		</td>        
                <td style="border:none" >
                
        </td>
</tr>
     
        <tr> 
                <td style="border:none" >
                
        </td>
        <td   style="border:none" colspan="2">
				   <center> <br><input type="submit" name="log" id="submit" value="LOGIN" formaction=""  class="button"> </center>
		</td>        
                <td style="border:none" >
                
        </td>
        </tr>
        <tr>
                <td style="border:none" >
                
        </td>
        <td   style="border:none" colspan="2">
        <br>
        </td>
                <td style="border:none" >
                
        </td>
        </tr>
        
        <tr>
                <td style="border:none" >
                
        </td>
        <td  style="border:none" colspan="2">
<center><a href="http://www.wlendy.in/forgot.php">Forgot Password</a><br></center>
		</td>        
                <td style="border:none" >
                
        </td>
        </tr>
        
        <tr>
                <td  style="border:none" >
                
        </td>
        <td  style="border:none" colspan="2">
<center><a href="http://www.wlendy.in/signup.php">Sign Up</a></center>
		</td>        
                <td style="border:none" >
                
        </td>
        </tr>
		
                <tr>
        <td  style="border:none" colspan="4" >
        <br>
        </td>
        </tr>        
    </table>
    </form>
</center>
<br>
       <script src="js/jquery.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js"  type="text/javascript"></script>
        <script src="js/stickUp.min.js"  type="text/javascript"></script>
        <script src="js/colorbox/jquery.colorbox-min.js"  type="text/javascript"></script>
        <script src="js/templatemo_script.js"  type="text/javascript"></script>
		<!-- templatemo 395 urbanic -->
    </body>
</html>