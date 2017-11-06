<?php


		session_start();
	while(1)
	{
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
				break;
			}
			$a=mysql_select_db('wlenditu_login');
			if(!$a)
			{
				mysql_close($conn);
				header("Location:http://www.wlendy.in/index.php");
				break;
			}
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
				$fname=ucwords($row['user_fname']);
				$lname=ucwords($row['user_lname']);
				$email=($row['user_email']);
				$naam="$fname"." "."$lname";
				$mob=($row['user_mobile']);
				mysql_close($conn);
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
			header("Location:http://www.wlendy.in/index.php");
			break;
		}
	}
	while(1)
	{
		if(isset($_POST['change']))
		{
			$pwd=$_POST['pwd'];
			$rpwd=$_POST['rpwd'];
			$mobile=$_POST['num'];
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
			if($pwd=="" || $rpwd=="")
			{
				$message="Please fill all the fields";
				break;
			}
			$passlen=strlen($pwd);
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
			if($pwd!=$rpwd)
			{
				$message="The passwords do not match";
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
			$q="select * from user_details where user_id='$user' and user_pass='$pass';";
			$ask=mysql_query($q,$conn);
			if(!$ask)
			{
				$message="Please try again";
				mysql_close($conn);
				break;
			}
			if($row=mysql_fetch_array($ask, MYSQL_ASSOC))
			{
				$q1="UPDATE user_details SET user_auth=1,user_status='active',user_attempt=0,user_pass='$pwd',user_mobile='$mobile' WHERE user_id='$user' and user_pass='$pass'";
				$ask1=mysql_query($q1,$conn);
				if(!$ask1)
				{
					$message="Please try again";
					mysql_close($conn);
					break;
				}
				$message="Your details have been updated.<br>Click <a href='http://www.wlendy.in/login.php'>here</a> to login";
				mysql_close($conn);
				break;
			}
			else
			{
				mysql_close($conn);
				$message="Invalid user authorization";
				break;
			}
		}
		break;
	}
?> 

<!DOCTYPE html>
<html lang="en">
    <head>
    <script>
    function dropf() {
    document.getElementById("logdropdown").classList.toggle("show");
}
document.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>
<script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property=58d706053059c000121c8abc&product=inline-share-buttons"></script> 
        <title>Edit Profile</title>
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

       
          <div class="templatemo-top-menu">
    <div class="container1">
                <!-- Static navbar -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">
                    <div style="align:right; padding-top:1%; padding-left:70%; height:10px; position:absolute">  <ul class="nav navbar-nav navbar-right">
                                <li>
                                <dl>
			        <dt onClick="dropf()"><img src="images/loggedinav.png" class="dropbtn" id="i"></dt>
  			       <dd id="logdropdown" class="dropdown-content">
   			       <a href="http://www.wlendy.in">Home</a>
    			        <a href="http://www.wlendy.in/signout.php">Sign Out</a></dd>
                            </dl>
                                </li>
                            </ul></div>
                      <div class="navbar-header" style="align:left; max-width:20%">
                          <a href="http://www.wlendy.in/index.php" class="navbar-brand"><img src="images/logotitle.png" id="tit" height="20%" /></a>                
                   </div>
                        
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
        		Name &nbsp;
        </td>
        <td style="border:none">
	        	 <input type="text" name="name" id="name" value="<?php print $naam; ?>" required autofocus autocomplete="on" class="sibutton" readonly value=""><br>
        </td>
                <td style="border:none" >
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
        </td>
        </tr>
        <tr>
        <td colspan="4" style="border:none">
       
        </td>
        </tr>
        <tr>
                <td style="border:none" >          
        </td>
        <td style="border:none">
        		New Password &nbsp;
        </td>
        <td style="border:none">
				<input type="password" name="pwd" id="pass" autocomplete="on" required class="sibutton">        
        </td>
                <td style="border:none" >
                
        </td>
        </tr>
        <tr>
                <td style="border:none" >          
        </td>
        <td style="border:none">
        		Re-Type Password &nbsp;
        </td>
        <td style="border:none">
				<input type="password" name="rpwd" id="pass" autocomplete="on" required class="sibutton">        
        </td>
                <td style="border:none" >
                
        </td>
        </tr>
        <tr>
                <td style="border:none" >          
        </td>
        <td style="border:none">
        		User Id &nbsp;
        </td>
        <td style="border:none">
			<input type="text" name="id" id="id" autocomplete="on" value="<?php print $user; ?>"required class="sibutton" readonly value="">        
        </td>
                <td style="border:none" >
                
        </td>
        </tr>
        <tr>
         <tr>
                <td style="border:none" >          
        </td>
        <td style="border:none">
        		Mobile Number &nbsp;
        </td>
        <td style="border:none">
				<input type="text" name="num" id="num" autocomplete="on" value="<?php print $mob; ?>" required class="sibutton" value="">        
        </td>
                <td style="border:none" >
                
        </td>
        </tr>
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
				   <center> <br><input type="submit" name="change" id="submit" value="Change" formaction=""  class="button"> </center>
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
    </form>
</center>
<br>
</body>
</html>