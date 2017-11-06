<?php
	if(isset($_GET['req']) && isset($_GET['dt']))
	{
		$a=intval($_GET['req']);
		$b=intval($_GET['dt']);
		$c=$b;
		$year=substr($c,0,4);
		$day=substr($c,8,2);
		$mon=substr($c,5,2);
		//$c="$year"."$month"."$day";
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
		mysql_select_db('wlenditu_carpool');
		$q="select * from car_details where car_type='$a' and car_date='$b';";
		$ask=mysql_query($q,$conn);
		if(!$ask)
		{
			header("Location:http://www.wlendy.in/index.php");
			mysql_close($conn);
			break;
		}
		$x=1;
		$y=1;
		$first="<table id='myTable'>
  <tr class='header'>
    <th style='width:10%'><center>DATE</center></th>
    <th style='width:10%'><center>TIME</center></th>
    <th style='width:10%'><center>FROM</center></th>
    <th style='width:10%'><center>TO</center></th>
    <th style='width:10%'><center>ADMIN</center></th>
    <th style='width:20%'><center>MEETING PLACE</center></th>
    <th style='width:10%'><center>EMAIL</center></th>
    <th style='width:10%'><center>NUMBER</center></th>
</tr>
</table>
";
		$year=substr($b,0,4);
		//$b=$b/10000;
		$month=substr($b,4,2);
		//$b=$b/100;
		$day=substr($b,6,2);
		$dt="$day"."/"."$month"."/"."$year";
		while($row1=mysql_fetch_array($ask, MYSQL_ASSOC))
		{
			if($y==1)
			{
				print $first;
				$y=2;
			}
			$x=2;
			$admin=$row1['car_admin'];
			mysql_select_db('wlenditu_login');
			$q11="select * from user_details where user_id='$admin';";
			$ask11=mysql_query($q11,$conn);
			if(!$ask11)
			{
				header("Location:http://www.wlendy.in/index.php");
				mysql_close($conn);
				break;
			}
			if($row111=mysql_fetch_array($ask11, MYSQL_ASSOC))
			{
				$fname=ucwords($row111['user_fname']);
				$lname=ucwords($row111['user_lname']);
				$email=$row111['user_email'];
			}
			mysql_select_db('wlenditu_carpool');
			$name="$fname"." "."$lname";
			if($row1[car_id]>=1000)
			{
				if($row1['car_status']==1)
				{
					$img="<img src='images/G.png' alt='Available' title='Available' width='80%'  >";
				}
				else
				{
					$img="<img src='images/R.png' alt='Not Available' title='Not Available' width='80%' />";
				}
				$t=$row1['car_time'];
				$mn=$t%100;
				$meet=$row1['car_meeting'];
				$num=$row1['car_num'];
				if($mn==0)
				{
					$mn="00";
				}
				$hr=($t-$mn)/100;
				$t="$hr".":"."$mn";
				print " <tr >
					<td><center>".$dt."<center></td>
					<td><center>".$t."<center></td>
					<td><center>".ucwords($row1['car_from'])."<center></td>
					<td><center>".ucwords($row1['car_to'])."<center></td>
					<td><center>".$name."<center></td>
					<td><center>".$meet."<center></td>
					<td><center>".$email."<center></td>
					<td><center>".$num."<center></td>
				      </tr>
				      ";
			}
			//header("Location:https://in.yahoo.com/");
		}
		if($x==1)
		{
			print "
				<tr>
					<td>No carpools available</td>
				<tr>"; 
		}
	}
	else
	{
		header("Location:http://www.wlendy.in/carpool.php");
	}
?>