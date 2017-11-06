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
				header("Location:http://www.wlendy.in/carpool_re_lo.php");
				break;
			}
			$a=mysql_select_db('wlenditu_login');
			if(!$a)
			{
				mysql_close($conn);
				header("Location:http://www.wlendy.in/carpool_re_lo.php");
				break;
			}
			$q="select * from user_details where user_id='$user' and user_pass='$pass';";
			$ask=mysql_query($q,$conn);
			if(!$ask)
			{
				mysql_close($conn);
				header("Location:http://www.wlendy.in/carpool_re_lo.php");
				break;
			}
			if($row=mysql_fetch_array($ask, MYSQL_ASSOC))
			{
				mysql_close($conn);
			}
			else
			{
				session_unset();
				session_destroy();
				header("Location:http://www.wlendy.in/carpool_re_lo.php");
			}
		}
		else
		{
			header("Location:http://www.wlendy.in/carpool_re_lo.php");
		}
	while(1)
	{
		date_default_timezone_set("Asia/Kolkata");
		$datereal=date("Y").date("m").date("d");
		$h=date("H");
		$m=date("i");
		$timereal="$h"."$m";
		$dbhost="localhost";
		$dbuser="wlenditu_root";
		$dbpass="rishabhabhishek";
		$conn=mysql_connect($dbhost,$dbuser,$dbpass);
		if( !$conn )
		{
			mysql_close($conn);
			header("Location:http://www.wlendy.in/carpool_re_lo.php");
			break;
		}
		$a=mysql_select_db('wlenditu_carpool');
		if(!$a)
		{
			mysql_close($conn);
			header("Location:http://www.wlendy.in/carpool_re_lo.php");
			break;
		}
		$q="DELETE FROM car_details WHERE car_date < '$datereal';";
		$ask=mysql_query($q,$conn);
		if(!$ask)
		{
			mysql_close($conn);
			break;
		}
		mysql_close($conn);
		break;
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
				header("Location:http://www.wlendy.in/carpool_re_lo.php");
				break;
			}
			$a=mysql_select_db('wlenditu_login');
			if(!$a)
			{
				mysql_close($conn);
				session_start();
				session_unset();
				session_destroy();
				header("Location:http://www.wlendy.in/carpool_re_lo.php");
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
				header("Location:http://www.wlendy.in/carpool_re_lo.php");
				break;
			}
			if($row=mysql_fetch_array($ask, MYSQL_ASSOC))
			{
				$q1="UPDATE user_details SET user_auth=1,user_status='active',user_attempt=0 WHERE user_id='$user' AND user_pass='$pass'";
				$ask1=mysql_query($q1,$conn);
				if(!$ask1)
				{
					mysql_close($conn);
					header("Location:http://www.wlendy.in/carpool_re_lo.php");
					break;
				}
				
				mysql_close($conn);
				session_start();
				session_unset();
				session_destroy();
				header("Location:http://www.wlendy.in/carpool_re_lo.php");
				break;
			}
			else
			{
				
				mysql_close($conn);
				session_start();
				session_unset();
				session_destroy();
				header("Location:http://www.wlendy.in/carpool_re_lo.php");
				break;
			}
		}
		break;
	}
	while(1)
	{
	 if(isset($_POST['join']) || isset($_GET['value']))
	 {
	 	header("Location:https://www.google.com");
	 	$id=$_POST['value'];
	 	if(!is_numeric($id))
	 	{
	 		header("Location:http://www.wlendy.in/carpool_re_li.php");
	 		break;
	 	}
		$dbhost="localhost";
		$dbuser="wlenditu_root";
		$dbpass="rishabhabhishek";
		$conn=mysql_connect($dbhost,$dbuser,$dbpass);
		if( !$conn )
		{
			mysql_close($conn);
			header("Location:http://www.wlendy.in/carpool_re_lo.php");
			break;
		}
		$a=mysql_select_db('wlenditu_carpool');
		if(!$a)
		{
			mysql_close($conn);
			header("Location:http://www.wlendy.in/carpool_re_lo.php");
			break;
		}
		$q="select * from car_details where car_id='$id'";
		$ask=mysql_query($q,$conn);
		if(!$ask)
		{
			mysql_close($conn);
			header("Location:http://www.wlendy.in/carpool_re_lo.php");
			break;
		}
		if($row=mysql_fetch_array($ask, MYSQL_ASSOC))
		{	
			if($row['car_max']<=$row['car_filled'])
			{
				mysql_close($conn);
				header("Location:http://www.wlendy.in/carpool_re_li.php");
				break;
			}
			$admin=$row['car_admin'];
			if($admin=$user)
			{
				mysql_close($conn);
				header("Location:http://www.wlendy.in/carpool_re_li.php");
				break;
			}
			$type=$row['car_type'];
			$fill=$row['car_request'];
			$fill++;
			$q1="select * from temp_car where temp_id='$id' and temp_admin='$admin' and temp_request_id='$user'";
			$ask1=mysql_query($q1,$conn);
			if(!$ask1)
			{
				mysql_close($conn);
				header("Location:http://www.wlendy.in/carpool_re_li.php");
				break;
			}
			if($row2=mysql_fetch_array($ask1, MYSQL_ASSOC))
			{	
				mysql_close($conn);
				header("Location:http://www.wlendy.in/carpool_re_li.php");
				break;
			}
			$q2="UPDATE car_details SET car_request='$fill' WHERE car_id='$id'";
			$ask2=mysql_query($q2,$conn);
			if(!$ask2)
			{
				mysql_close($conn);
				header("Location:http://www.wlendy.in/carpool_re_li.php");
				break;
			}
			$q3="INSERT INTO temp_car (temp_id,temp_admin,temp_request_id,temp_type)VALUES ('$id','$admin','$user','$type');";
			$ask3=mysql_query($q3,$conn);
			if(!$ask3)
			{
				mysql_close($conn);
				header("Location:http://www.wlendy.in/carpool_re_li.php");
				break;
			}
			$mailto=$admin;
       			$subject = "Request for your pool";
    			$header = "From: admin@wlendy.in\nMIME-Version: 1.0\nContent-Type: text/html; charset=utf-8\n";
  		        $message_body="
 <html><body>
A request for your carpool id $id is there. Kindly check for the same through your id<br>
<br>
<br>
Please contact us for any problems you might face.<br><br>
<font color='#878787' style='font-family: Helvetica'><p>--<br>Wlendy Support Team<br>+91-8130223516<br>admin@wlendy.in</font><br>
<img src='http://www.wlendy.in/images/signaturelogo.png' alt='Signature Logo' title='Signature Logo' /></p>
</body></html>
";
 		        mail($mailto,$subject,$message_body,$header);
 		        mysql_close($conn);
 		        header("Location:http://www.wlendy.in/carpool_re_li.php");
			break;
		}
		else
		{
			//header("Location:https://www.google.com");
			mysql_close($conn);
			header("Location:http://www.wlendy.in/carpool_re_lo.php");
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
<title>Carpool</title>
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
   			        
   			        <a href="http://www.wlendy.in/edit.php">Edit Profile</a>
    			        <a href="http://www.wlendy.in/signout.php">Sign Out</a></dd>
                            </dl>
                                </li>
                            </ul></div>
                      <div class="navbar-header" style="align:left; max-width:20%">
                          <a href="http://www.wlendy.in/signout.php" class="navbar-brand"><img src="images/logotitle.png" id="tit" height="20%" /></a>                
                   </div>
                        
                  </div><!--/.container-fluid -->
                </div><!--/.navbar -->
    </div> <!-- /container -->
        </div>
        
        
        <br>
        <center>
        <br>
        <br><div style="padding-right: 30px" align="right"><form action="http://www.wlendy.in/addform.php" ><input type="submit" class="fb"  value="New Carpool"/></form></div>
        <h1 id="headingc">Search for Carpools</h1>
        <div id="headdivc"><br></div>
        </center>
         <center>
        <form>
        	<input class="searchbox" type="date" value="<?php date_default_timezone_set("Asia/Kolkata"); echo date('Y-m-d'); ?>" id="datesearch" required/>
        	<select class="searchbox"  id="fromto" name="fromto" >
               <option value="fr">FROM SNU</option>
               <option value="ca">TO SNU</option>
           </select></form><br>
                      <input type="submit" class="fb" onClick="csearch()" value="Search"/>
	
        </center>
      <br>
      <br>
     
<center>
<input style="display: none" type="text" class="sname-c" id="sname-c" onkeyup="myFunction()" placeholder="Search for Places"/>
<br>
<br>
<center><table id="myTable">
</table>
	</center>
</body>
<script src="js/carpoolav.js"></script>
<script src="js/jquery.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js"  type="text/javascript"></script>
        <script src="js/stickUp.min.js"  type="text/javascript"></script>
        <script src="js/colorbox/jquery.colorbox-min.js"  type="text/javascript"></script>
        <script src="js/templatemo_script.js"  type="text/javascript"></script>
</html>