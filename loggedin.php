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
<script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property=58d706053059c000121c8abc&product=inline-share-buttons"></script>        <title>Wlendy</title>
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
  			        <a href="http://www.wlendy.in/carpool.php">Carpool</a>
   			        <a href="http://www.wlendy.in/edit.php">Edit Profile</a>
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
        
      
    <!-- Carousel -->
    <div id="templatemo-carousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#templatemo-carousel" data-slide-to="0" class="active"></li>
                    <li data-target="#templatemo-carousel" data-slide-to="1"></li>
                    <li data-target="#templatemo-carousel" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="item active">
                        <div class="container">
                            <div class="carousel-caption" >
                                <h1>WELCOME TO WLENDY</h1>
								<p>Simplifying life at SNU.<br>
                                Keeping inboxes spam free.</p>
                                
                            </div>
                        </div>
                  </div>
                    
                    <div class="item">
                        <div class="container">
                                <div class="carousel-caption">
                                    	<h1>Carpool</h1>
                                        <p>Going somewhere?<br>
                                           Just pool a car
                                        </p>
                                    </div>
                                    
                                </div>
                        </div>
                   
                        <div class="item">
                        <div class="container">
                                <div class="carousel-caption">
                                    	<h1>MORE SERVICES COMING <br>VERY SOON</h1>
                                </div>
                        </div>
                    </div>
                        
                        
              </div>
                
    </div><!-- /#templatemo-carousel -->
            <a class="left carousel-control" href="#templatemo-carousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
                <a class="right carousel-control" href="#templatemo-carousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
        </div>

        <div class="templatemo-welcome" id="templatemo-welcome" style=background-color: #FFFFFF	> 
            <div class="container">
                <div class="templatemo-slogan text-center">
                 
                    <div style="font-size: 100%; color:#002147; font-family: Berlin Sans FB"><a href="http://www.wlendy.in/carpool.php">
                    <img id="cpoolimage" src="images/taxi-logo.png" title="Carpool"></a><br><br>
                     <a href="http://www.wlendy.in/carpool.php">CARPOOL MADE EASY</a>
	            </div> 
                </div>	
                <div>
                    <div>
                        <div>
                        <br>
                        <br>
                        <br>    
           <p style="clear: left">               
        <div class="sharethis-inline-share-buttons"></div></p>                 
       <script src="js/jquery.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js"  type="text/javascript"></script>
        <script src="js/stickUp.min.js"  type="text/javascript"></script>
        <script src="js/colorbox/jquery.colorbox-min.js"  type="text/javascript"></script>
        <script src="js/templatemo_script.js"  type="text/javascript"></script>
		<!-- templatemo 395 urbanic -->
    </body>
</html>