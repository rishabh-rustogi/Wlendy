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
	
	

	while(1)
	{
		if(isset($_POST['signup']))
		{
			$message="encode";
			$user=$_POST['userid'];
			$pass=$_POST['password'];
			$rpass=$_POST['rpass'];
			$fname=$_POST['fname'];
			$lname=$_POST['lname'];
			$mobile=$_POST['mobile'];
			$sex=$_POST['sex'];
			$user=chop(strtolower($user));
			$fname=strtolower($fname);
			$lname=strtolower($lname);
			$a1=ord(substr($user,0));
			$a2=ord(substr($user,1));
			$num=substr($user,2,4);
			if($user=="" || $rpass=="" || $pass=="" || $fname=="" || $lname=="" || $mobile=="" || $sex=="")
			{
				$message="Please fill all the fields";
				break;
			}
			if(strlen($user)!=5)
			{
				$message="User Id entered is incorrect";
				break;
			}
			if(!is_numeric($num))
			{
				$message="User Id entered is incorrect";
				break;
			}
			if($a1>122 || $a1<97 || $a2>122 || $a2<97)
			{
				$message="User Id entered is incorrect";
				break;
			}
			$passlen=strlen($pass);
			if($passlen<6)
			{
				$message="The password must have atleast 6 charachters";
				break;
			}
			if($passlen>15)
			{
				$message="The password must have at max 15 charachters";
				break;
			}
			if($pass!=$rpass)
			{
				$message="The passwords do not match";
				break;
			}
			$name=strlen($fname);
			if($name<=0 || $name>=20)
			{
				$message="Enter a valid first name";
				break;
			}
			$name=strlen($lname);
			if($name<=0 || $name>=20)
			{
				$message="Enter a valid last name";
				break;
			}
			$mb1=ord($mobile);
			if(is_numeric($mobile) && strlen($mobile)==10)
			{
				if($mb1==55 || $mb1==56 || $mb1==57)
				{}
				else
				{
					$message="Enter a valid mobile number";
					break;
				}
			}
			else
			{
				$message="Enter a valid mobile number";
				break;
			}
			if($sex!="female" && $sex!="male")
			{
				$message="Please choose a sex type";
				break;
			}
			$dbhost="localhost";
			$dbuser="wlenditu_root";
			$dbpass="rishabhabhishek";
			$conn=mysql_connect($dbhost,$dbuser,$dbpass);
			if( !$conn )
			{
				$message="Sorry! Please try again";
				mysql_close($conn);
				break;
			}
			mysql_select_db('wlenditu_login');
			$q="select * from user_details where user_id='$user';";
			$ask=mysql_query($q,$conn);
			if(!$ask)
			{
				$message="Sorry! Please try again";
				mysql_close($conn);
				break;
			}
			if($row=mysql_fetch_array($ask, MYSQL_ASSOC))
			{
				if($row['user_id']==$user)
				{
					$message="This id is already registered";
					mysql_close($conn);
					break;
				}
			}
			$email=$user."@snu.edu.in";
			$hash = md5( rand(0,1000000) );
			$q1="INSERT INTO user_temp (t_id,t_pass,t_email,t_mobile,t_fname,t_lname,t_sex,t_hash)VALUES ('$user','$pass','$email','$mobile','$fname', '$lname','$sex','$hash');";
			$ask1=mysql_query($q1,$conn);
			if(!$ask1)
			{
				$message="Sorry! Please try again";
				mysql_close($conn);
				break;
			}
			$mailto=$email;
       			$subject = "Thank You For Joining";
    			$header = "From: admin@wlendy.in\nMIME-Version: 1.0\nContent-Type: text/html; charset=utf-8\n";
  		        $message_body="
 <html><body>
Thank You for joining Wlendy, <br>
Please confirm your id by clicking the link below.<br>
<br>
http://www.wlendy.in/verify.php?email=$email&hash=$hash<br>
<br>
Your login details are <br>
------------------------<br>
Username: $user<br>
Password: $pass<br>
<br>
<br>
Thank You again and please contact us for any problems you might face.<br><br>
<font color='#878787' style='font-family: Helvetica'><p>--<br>Wlendy Support Team<br>+91-8130223516<br>admin@wlendy.in</font><br>
<img src='http://www.wlendy.in/images/signaturelogo.png' alt='Signature Logo' title='Signature Logo' /></p>
</body></html>
";
 		        mail($mailto,$subject,$message_body,$header);
 		        $message="An <a href='https://www.gmail.com'>Email</a> has been sent to your SNU Id, Please verify  ";
 		        mysql_close($conn);
			break;
		}
		break;
	}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>SIGNUP</title>
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
			      <li><a href="http://www.wlendy.in/login.php">LOGIN</a></li>
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
        <br>
                <br><center><h1>SIGN UP</h1></center><br>
                                <br>	
        <center>
        
        
        
<form action="<?php $_PHP_SELF; ?>" method="POST" autocomplete="on" >
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
        		USER ID
	        </td>
    	
            <td style="border:none">
	   	   		<input type="text" name="userid" id="user" required autofocus placeholder="Example: gb110">
        	</td>
            
            <td style="border:none">
  

        	</td>
            
        </tr>
        
        <tr>
        	<td style="border:none" >    
	        </td>
            
	        <td style="border:none">
        		PASSWORD
    	    </td>
            
	        <td style="border:none">
				<input type="password" name="password" id="pass" class="sibutton" required >        
    	    </td>
               
			<td style="border:none" >    
	        </td>
        </tr>
        
		<tr>
			<td style="border:none" >
                
	        </td>
            
	        <td style="border:none">
	    		RE-ENTER PASSWORD &nbsp;
	        </td>
            
	        <td style="border:none">
				<input type="password" name="rpass" id="pass" class="sibutton" required>        
    	    </td>
               
            <td style="border:none" >            
	        </td>
        </tr>
              
        <tr>
	        <td style="border:none" >    
    	    </td>
            
	        <td style="border:none">
        		FIRST NAME
    	    </td>
            
	        <td style="border:none">
				<input type="text" name="fname" id="fname" class="sibutton" required>        
    	    </td>
               
            <td style="border:none" >                
	        </td>
            
        </tr>
                    <tr>
	        <td style="border:none" >    
    	    </td>
            
	        <td style="border:none">
        		LAST NAME
    	    </td>
            
	        <td style="border:none">
				<input type="text" name="lname" id="lname" class="sibutton" required>        
    	    </td>
               
            <td style="border:none" >                
	        </td>
            
        </tr>
             
                  
		<tr>
	        <td style="border:none" >            
	        </td>
            
	        <td style="border:none">
        		MOBILE NUMBER
	        </td>
            
	        <td style="border:none">
				<input type="text" name="mobile" class="sibutton" required>      
    	    </td>
               
	        <td style="border:none" >            
	        </td>
            
        </tr>
                 
        <tr>
			<td style="border:none" >    
	        </td>
            
        <td style="border:none">
        	    SEX
        </td>
        
        <td style="border:none">
<input type="radio" name="sex" id="female" autocomplete="on" value="female" required> FEMALE
                            <br>
<input type="radio" name="sex" id="male" value="male" required>      MALE
                
                
      
                
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
					print "<center>$message</center>";
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
				   <center> <br><input class="button" type="submit" name="signup" id="submit" value="SIGN UP" formaction=""> </center>
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
        <tr>
                <td style="border:none" >
                
        </td>		   
		</td>        
                <td style="border:none" colspan="2" >
                
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
<center><a href="http://www.wlendy.in/login.php">LOGIN</a></center>
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

<br>
<br>
    
       <script src="js/jquery.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js"  type="text/javascript"></script>
        <script src="js/stickUp.min.js"  type="text/javascript"></script>
        <script src="js/colorbox/jquery.colorbox-min.js"  type="text/javascript"></script>
        <script src="js/templatemo_script.js"  type="text/javascript"></script>

</form>
</center>
</body>
</html>