<?php


		session_start();
		if(isset($_SESSION['user']) && isset($_SESSION['pass']))
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
				header("Location:http://www.wlendy.in/loggedout.php");
				break;
			}
			$a=mysql_select_db('wlenditu_login');
			if(!$a)
			{
				mysql_close($conn);
				header("Location:http://www.wlendy.in/loggedout.php");
				break;
			}
			$q="select * from user_details where user_id='$user' and user_pass='$pass';";
			$ask=mysql_query($q,$conn);
			if(!$ask)
			{
				mysql_close($conn);
				header("Location:http://www.wlendy.in/loggedout.php");
				break;
			}
			if($row=mysql_fetch_array($ask, MYSQL_ASSOC))
			{
				$fname=ucwords($row['user_fname']);
				$lname=ucwords($row['user_lname']);
				$email=($row['user_email']);
				$number=($row['user_mobile']);
				$naam="$fname"." "."$lname";
				mysql_close($conn);
			}
			else
			{
				session_unset();
				session_destroy();
				header("Location:http://www.wlendy.in/loggedout.php");
			}
		}
		else
		{
			header("Location:http://www.wlendy.in/loggedout.php");
		}
	while(1)
	{
		if(isset($_POST['signout']))
		{
			$dbhost="localhost";
			$dbuser="wlenditu_root";
			$dbpass="rishabhabhishek";
			$conn=mysql_connect($dbhost,$dbuser,$dbpass);
			if( !$conn )
			{
				mysql_close($conn);
				session_start();
				session_unset();
				session_destroy();
				header("Location:http://www.wlendy.in/loggedout.php");
				break;
			}
			$a=mysql_select_db('wlenditu_login');
			if(!$a)
			{
				mysql_close($conn);
				session_start();
				session_unset();
				session_destroy();
				header("Location:http://www.wlendy.in/loggedout.php");
				break;
			}
			$q="select * from user_details where user_id='$user' and user_pass='$pass';";
			$ask=mysql_query($q,$conn);
			if(!$ask)
			{
				mysql_close($conn);
				session_start();
				session_unset();
				session_destroy();
				header("Location:http://www.wlendy.in/loggedout.php");
				break;
			}
			if($row=mysql_fetch_array($ask, MYSQL_ASSOC))
			{
				$q1="UPDATE user_details SET user_auth=1,user_status='active',user_attempt=0 WHERE user_id='$user' AND user_pass='$pass'";
				$ask1=mysql_query($q1,$conn);
				if(!$ask1)
				{
					mysql_close($conn);
					header("Location:http://www.wlendy.in/loggedout.php");
					break;
				}
				
				mysql_close($conn);
				session_start();
				session_unset();
				session_destroy();
				header("Location:http://www.wlendy.in/loggedout.php");
				break;
			}
			else
			{
				
				mysql_close($conn);
				session_start();
				session_unset();
				session_destroy();
				header("Location:http://www.wlendy.in/loggedout.php");
				break;
			}
		}
		break;
	}
	while(1)
	{
		if(isset($_POST['add']))
		{
			$name=$_POST['userid'];
			$em=$_POST['email'];
			$mobile=$_POST['mobile'];
			$place=$_POST['place'];
			$mp=$_POST['mp'];
			$type=$_POST['n'];
			$dt=$_POST['date'];
			$tm=$_POST['time'];
			$show=$_POST['show'];
			if($name=="" || $em=="" || $mobile=="" || $place=="" || $mp=="" || $type=="" || $dt=="" || $tm=="")
			{
				$message="Please fill all the fields";
				break;
			}   
			if($naam!=$name || $em!=$email)
			{
				$message="Please try again";
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
			date_default_timezone_set("Asia/Kolkata");
			$place=strtolower($place);
			$mp=strtolower($mp);
			if($type!="FROM" && $type!="TO")
			{
				$message="Please try again";
				break;
			}
			if($type=="FROM")
			{
				$type=1;
				$from="snu";
				$to=$place;
			}
			else if($type=="TO")
			{
				$type=2;
				$to="snu";
				$from=$place;
			}
			
			$year=substr($dt,0,4);
			$day=substr($dt,8,2);
			$mon=substr($dt,5,2);
			if(!is_numeric($year) || !is_numeric($mon) || !is_numeric($day))
			{
				$message="Please try again";
				break;
			}
			if(!checkdate($mon,$day,$year))
			{
				$message="Please try again";
				break;
			}
			$dt="$year"."$mon"."$day";
			$hour=substr($tm,0,2);
			$mn=substr($tm,3,2);
			if(isset($_POST['show']))
			{
				$f=substr($mobile,0,2);
				$l=substr($mobile,8,2);
				$mobile="$f"."XXXXXX"."$l";
			}
			$h=date("H");
			$m=date("i");
			$tm="$hour"."$mn";
			$timereal="$h"."$m";
			$datereal=date("Y").date("m").date("d");
			if($datereal>$dt)
			{
				$message="Please try again";
				break;
			}
			if($datereal==$dt)
			{
				if($tm<=$timereal)
				{
					$message="Please try again";
					break;
				}
			}
			
			$dbhost="localhost";
			$dbuser="wlenditu_root";
			$dbpass="rishabhabhishek";
			$conn=mysql_connect($dbhost,$dbuser,$dbpass);
			if( !$conn )
			{
				header("Location:http://www.wlendy.in/loggedout.php");
				mysql_close($conn);
				break;
			}
			mysql_select_db('wlenditu_carpool');
			$q1="select * from car_details where car_admin='$user' and car_type='$type';";
			$ask1=mysql_query($q1,$conn);
			if(!$ask1)
			{
				header("Location:http://www.wlendy.in/loggedout.php");
				mysql_close($conn);
				break;
			}
			if($row=mysql_fetch_array($ask1, MYSQL_ASSOC))
			{
				mysql_close($conn);
				$message="Sorry! you can only start one carpool of a type";
				break;
			}
			$q="INSERT INTO car_details (car_admin,car_type,car_from,car_to,car_date,car_meeting,car_time,car_num)VALUES ('$user','$type','$from','$to','$dt', '$mp','$tm','$mobile');";
			$ask=mysql_query($q,$conn);
			if(!$ask)
			{
				header("Location:http://www.wlendy.in/loggedout.php");
				mysql_close($conn);
				break;
			}
			if($ask)
			{
				$message="New Carpool has been started";
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
<title>New Carpool</title>
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
   			        <a href="http://www.wlendy.in/carpool_re_li.php">Search</a>
   			        <a href="http://www.wlendy.in/edit.php">Edit Profile</a>
    			        <a href="http://www.wlendy.in/signout.php">Sign Out</a></dd>
                            </dl>
                                </li>
                            </ul></div>
                      <div class="navbar-header" style="align:left; max-width:20%">
                          <a href="/index.php" class="navbar-brand"><img src="images/logotitle.png" id="tit" height="20%" /></a>                
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
                <br><center><h1>New Carpool</h1></center>
                        <br>
                                <br>	
        <center>
        
        <div>



        </div>
        
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
        		NAME
	        </td>
    	
            <td style="border:none">
	   	   		<input type="text" name="userid" id="user" value="<?php print $naam; ?>" required readonly >
        	</td>
            
            <td style="border:none" >

</div>

            &nbsp; &nbsp;

        	</td>
            
        </tr>
          <tr>
        	<td style="border:none" >    
	        </td>
            
	        <td style="border:none">
        		EMAIL
    	    </td>
            
	        <td style="border:none">
				<input type="text" name="email" id="ema" class="sibutton" value="<?php print $email; ?>"required readonly>        
    	    </td>
               
			<td style="border:none" >    
	        </td>
        </tr>
        <tr>
        	<td style="border:none" >    
	        </td>
            
	        <td style="border:none">
        		DATE
    	    </td>
            
	        <td style="border:none">
				<input type="date" name="date" id="ate" class="sibutton" value="" required >        
    	    </td>
               
			<td style="border:none" >    
	        </td>
        </tr>
        
		
                    <tr>
	        <td style="border:none" >    
    	    </td>
            
	        <td style="border:none">
        		TIME
    	    </td>
            
	        <td style="border:none">
				<input type="time" name="time" id="time" class="sibutton" required>        
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
				<input type="text" name="mobile" class="sibutton" value="<?php print $number; ?>" required>      
    	    </td>
               
	        <td style="border:none" >            
	        </td>
            
        </tr>
        <tr>
	        <td style="border:none" >            
	        </td>
            
	        <td style="border:none">
        		
	        </td>
            
	        <td style="border:none">
				<input type="checkbox" name="show" id="show" value="show" >DON'T SHOW MY NUMBER     
    	    </td>
               
	        <td style="border:none" >            
	        </td>
            
        </tr>        
            <br>     
        <tr>
			<td style="border:none" >    
	        </td>
            
        <td style="border:none">
        	    TYPE
        </td>
        
        <td style="border:none">
<input type="radio" name="n" id="fsnu" autocomplete="on" value="FROM" required> FROM SNU
                            <br>
<input type="radio" name="n" id="tsnu" value="TO" required >      TO SNU
                
                
     
        </td>
             
              
               
                <td style="border:none" >
                
        </td>
        </tr>   
        <tr>
			<td style="border:none" >
                
	        </td>
            
	        <td style="border:none">
	    		PLACE
	        </td>
            
	        <td style="border:none">
				<input type="text" name="place" id="place" class="sibutton" required>        
    	    </td>
               
            <td style="border:none" >            
	        </td>
        </tr>
              
        <tr>
	        <td style="border:none" >    
    	    </td>
            
	        <td style="border:none">
        		MEETING PLACE &nbsp;
    	    </td>
            
	        <td style="border:none">
				<input type="text" name="mp" id="mp" class="sibutton" required>        
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
				   <center> <br><input class="button" type="submit" name="add" id="submit" value="DONE" formaction=""> </center>
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
                
        </td>	<td  style="border:none" colspan="2" >
        	   
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
<br>
<br>
<br>
</center>
<script src="js/jquery.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js"  type="text/javascript"></script>
        <script src="js/stickUp.min.js"  type="text/javascript"></script>
        <script src="js/colorbox/jquery.colorbox-min.js"  type="text/javascript"></script>
        <script src="js/templatemo_script.js"  type="text/javascript"></script>
</body>
</html>