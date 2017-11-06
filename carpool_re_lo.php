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
				break;
			}
			$a=mysql_select_db('wlenditu_login');
			if(!$a)
			{
				mysql_close($conn);
				break;
			}
			$q="select * from user_details where user_id='$user' and user_pass='$pass';";
			$ask=mysql_query($q,$conn);
			if(!$ask)
			{
				mysql_close($conn);
				break;
			}
			if($row=mysql_fetch_array($ask, MYSQL_ASSOC))
			{
				mysql_close($conn);
				header("Location:http://www.wlendy.in/carpool_re_li.php");
				break;
			}
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
?> 
 <!DOCTYPE html>
<html lang="en">
    <head>
<script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property=58d706053059c000121c8abc&product=inline-share-buttons"></script>       <title>Carpool</title>
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
                      <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                        </button>
                          <a href="/index.php" class="navbar-brand"><img src="images/logotitle.png" id="tit" height="20%" /></a></div>
          <span class="navbar-collapse collapse" id="templatemo-nav-bar" style="padding-top: 30px;">
                               <center>
                               <ul class="nav navbar-nav navbar-right">
                                <li ><a href="http://www.wlendy.in/index.php">HOME</a></li>
			      <li><a href="http://www.wlendy.in/login.php">LOGIN</a></li>
                           <li><a href="http://www.wlendy.in/signup">SIGN UP</a></li>
                            </ul>
                            </center>
					  </span>
					  
                        
                  </div><!--/.container-fluid -->
                </div><!--/.navbar -->
    </div> <!-- /container -->
        </div>
        
        <br>
       
        <center>
        <br>
        <br><div style="padding-right: 30px" align="right"><form action="http://www.wlendy.in/login.php" method="POST"><input type="submit" class="fb" name="add" value="New Carpool"/></form></div>
        <h1 id="headingc"><font color="#002147">Search for Carpools</font></h1>
        <div id="headdivc"><br></div>
        </center>
<br>
        <center>
        <br>
        <form>
        	<input class="searchbox" type="date" value="<?php date_default_timezone_set("Asia/Kolkata"); echo date('Y-m-d'); ?>" id="datesearch" required>
        	<select class="searchbox"  id="fromto" name="fromto" >
               <option value="fr">FROM SNU</option>
               <option value="ca">TO SNU</option>
           </select></form><br><br>
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
<script src="js/tablesearch.js"></script>
<script src="js/jquery.min.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js"  type="text/javascript"></script>
<script src="js/stickUp.min.js"  type="text/javascript"></script>    
<script src="js/colorbox/jquery.colorbox-min.js"  type="text/javascript"></script>
<script src="js/templatemo_script.js"  type="text/javascript"></script>
</html>