<?php

	
	session_start();
		if(isset($_SESSION['user']) && isset($_SESSION['pass']))
		{
			$user=$_SESSION['user'];
			$pass=$_SESSION['pass'];
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
			$q="select * from user_details where user_id='$user' and user_pass='$pass';";
			$ask=mysql_query($q,$conn);
			if(!$ask)
			{
				mysql_close($conn);
				header("Location:http://www.wlendy.in/index.php");
			}
			if($row=mysql_fetch_array($ask, MYSQL_ASSOC))
			{
				mysql_close($conn);
				header("Location:http://www.wlendy.in/edit.php");
			}
			else
			{
				mysql_close($conn);
				session_unset();
				session_destroy();
			}
		}

	while(1)
	{
		if(isset($_POST['forgot']))
   	 	{ 
    			$message="encode";
    			$user=$_POST['userid'];
			if($user=="")
			{
				$message="Please fill the user id";
				break;
			}
			$user=chop(strtolower($user));
			$a1=ord(substr($user,0));
			$a2=ord(substr($user,1));
			$num=substr($user,2,4);
			if(strlen($user)!=5)
			{
				$message="Your id is incorect";
				break;
			}
			if(!is_numeric($num))
			{
				$message="Your id is incorect";
				break;
			}
			if($a1>122 || $a1<97 || $a2>122 || $a2<97)
			{
				$message="Your id is incorect";
				break;
			}
			$dbhost="localhost";
			$dbuser="wlenditu_root";
			$dbpass="rishabhabhishek";
			$conn=mysql_connect($dbhost,$dbuser,$dbpass);
			if( !$conn )
			{
				$message="Please try again";
				mysql_close($conn);
				break;
			}
			mysql_select_db('wlenditu_login');
			$q="select * from user_details where user_id='$user';";
			$ask=mysql_query($q,$conn);
			if(!$ask)
			{
				$message="Please try again";
				mysql_close($conn);
				break;
			}
			if($row=mysql_fetch_array($ask, MYSQL_ASSOC))
			{
				$emailid=$row['user_email'];
				$passtemp=$row['user_pass_temp'];
				$mailto=$emailid;
       				$subject = "Reset Password";
    				$header = "From: admin@wlendy.in\nMIME-Version: 1.0\nContent-Type: text/html; charset=utf-8\n";   
  			        $message_body="
 <html><body>
We have just recieved a password reset request for $user.<br>
Your new login details are <br>
<br>
------------------------<br>
Username: $user<br>
Password: $passtemp<br>
<br>
Click <a href='http:\\www.wlendy.in/login.php'>here</a> to login.
<br>
<br>
Thank You again and please contact us for any problems you might face.<br><br>
<font color='#878787' style='font-family: Helvetica'><p>--<br>Wlendy Support Team<br>+91-8130223516<br>admin@wlendy.in</font><br>
<img src='http://www.wlendy.in/images/signaturelogo.png' alt='Signature Logo' title='Signature Logo' /></p>
</body></html>
";
 			        mail($mailto,$subject,$message_body,$header);
 			        $m="$user"."@snu.edu.in";
 			        $message="We just send a password reset email to <a href='https://www.gmail.com'>$m</a>";
 			        $qupdate="UPDATE user_details SET user_auth=1,user_status='active',user_attempt=0, user_pass='$passtemp' WHERE user_id='$user'";
				$ask2=mysql_query($qupdate,$conn);
				mysql_close($conn);
				break;
			}
			else
			{
				$message="User id entered is not registered. Kindly sign up first";
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
<title>Forgot Password</title>
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
        <link href="css/templatemo-carpool.css"  rel='stylesheet' type='text/css'>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    
    <body>

        <div class="templatemo-top-menu" style="z-index:1000">
    <div class="container1">
                <!-- Static navbar -->
                <div class="navbar navbar-default" role="navigation" style="z-index:1000">
                    <div class="container">
                      <div class="navbar-header" style="z-index:1000">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                        </button>
                          <a href="http://www.wlendy.in/index.php" class="navbar-brand"><img src="images/logotitle.png" id="tit" height="20%" /></a></div>
          <span class="navbar-collapse collapse" id="templatemo-nav-bar" style="padding-top: 30px; z-index:1000">
                               <center>
                               <ul class="nav navbar-nav navbar-right">
                                <li ><a href="http://www.wlendy.in/index.php">HOME</a></li>
                                <li><a href="http://www.wlendy.in/login.php">LOG IN</a></li>
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
	<center><h1>Forgot Password?</h1></center>
<br>
<br>
<br>
<br>
<br>
<br>
<center>
<form action="<?php $_PHP_SELF; ?>" method="POST" autocomplete="on">
<table  border="7" bordercolor="rgba(0,33,71,1.00)"  style="font-size:120%; background:rgba(241,244,248,1.00); color:rgba(0,0,0,1.00); border-color: rgba(0,33,71,1.00)" >
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
        		USER ID &nbsp;
        </td>
        <td style="border:none">
	        	 <input type="text" name="userid" id="user" autofocus>
        </td>
                <td style="border:none" >
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
        </td>
        </tr>
        <tr>
                <td style="border:none" >
                
        </td>
        <td style="border:none">
        		
        </td>
        <td style="border:none">
        </td>
                <td style="border:none" >
                
        </td>
        </tr>
        <tr>
                <td style="border:none" >
                
        </td>
        <td  style="border:none" colspan="2" >
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
				   <center> <br><input type="submit" class="button" name="forgot" id="submit" value="Done" formaction=""> </center>
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

		</td>        
                <td style="border:none" >
                
        </td>
        </tr>
        
        <tr>
                <td  style="border:none" >
                
        </td>
        <td  style="border:none" colspan="2">

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

       <script src="js/jquery.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js"  type="text/javascript"></script>
        <script src="js/stickUp.min.js"  type="text/javascript"></script>
        <script src="js/colorbox/jquery.colorbox-min.js"  type="text/javascript"></script>
        <script src="js/templatemo_script.js"  type="text/javascript"></script>
</form>
</center>
</body>
</html>