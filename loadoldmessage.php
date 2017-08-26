<html>
<head>
<style>
#sent{margin-top:5px;background:#003f3c;display:inline-block;max-width:300px;height:auto;
			       font-size:17px;color:white;float:right;margin-left:49%;}
#got{margin-top:5px;background:#e5e5e5;display:inline-block;max-width:300px;height:auto;
			      font-size:17px;color:black;margin-left:1%}
@media screen and (max-width:720px)
{
#sent{margin-top:5px;background:#003f3c;display:inline-block;max-width:100%;height:auto;
			        border-radius:4px;font-size:17px;color:white;float:right}
	#got{margin-top:5px;background:#e5e5e5;display:inline-block;max-width:100%;height:auto;
			        border-radius:4px;font-size:17px;color:black;margin-left:1%}
}
</style>
</head>
<body>
<?php
$timenow=time();
$datenow=date("Y-m-d");
include('connection.php');
	$msg=$_POST['userfrom'];
	$getid=$_POST['userto'];
	$myquery=mysqli_query($connection,"select * from register where id='$getid'");
	$myresult=mysqli_fetch_array($myquery);
	$myimage=$myresult['profilepic'];
	$fname=$myresult['firstname'];
	$lname=$myresult['lastname'];
	if(isset($_POST['button']))
	{
		$mynumber=$_POST['mymultiple'];
		$number=200*$mynumber;
$resultquery=mysqli_query($connection,"select * from (select * from messages where userto='$getid' && userfrom='$msg' || userto='$msg' && userfrom='$getid' order by id desc limit 10,$number) tmp order by id asc");
        while($rowquery=mysqli_fetch_array($resultquery))
            {
	           $messageid=$rowquery['id'];
	            $body=$rowquery['msgbody'];
	            $userfrom=$rowquery['userfrom'];
	            $userto=$rowquery['userto'];
				$opened=$rowquery['opened'];
				$dateadded=$rowquery['date'];
				$databasetime=$rowquery['time'];
				$findquery="select * from register where id='$userfrom'";
				$findresult=mysqli_query($connection,$findquery);
				while($findrow=mysqli_fetch_array($findresult))
				{
					$userfromname=$findrow['firstname'];
					if($userfrom==$msg)
					{
					echo '<div id="sent">
					&nbsp;&nbsp;'.$body.'&nbsp;&nbsp;<br>';
					if($opened=="yes")
					{
					echo '<img src="clipart/tick1.png" style="height:15px;width:auto;float:right">&nbsp;&nbsp;';
					}
					else
					{
					echo '<a href="deletemessage.php?id='.$getid.'&&msgid='.$messageid.'" style="color:#4c8dc0">Delete</a>';}
					echo '<font color="#dfdfdf" style="font-size:13px;float:right">';
				$diff=strtotime($datenow)-strtotime($dateadded);
$newdiff=($diff/86400);
$timediff=$timenow-$databasetime;
$newminute=ceil($timediff/(60));
$newhour=ceil($timediff/(60*60));
if($timediff>0 && $timediff<60)
{
	echo "2s ago";
}
if($timediff>60 && $timediff<3600)
{
echo $newminute."m ago";
}
if($timediff>3600 && $timediff<86400)
{
echo $newhour."h ago";
}
if($timediff>86400 && $newdiff>=1 && $newdiff<=30)
{
	echo $newdiff."d ago";
}
if($timediff>86400 && $newdiff>30)
{
	$newdate=date('j F Y',strtotime($dateadded));
	echo $newdate;
}
				echo "</font>";
				 echo '
					</div>
					<br>';}
					else
					{
					echo '<div id="got">
					&nbsp;
					<b>'.$userfromname.'</b>
					<div style="height:1px;text-align:center;width:80%"></div>
					&nbsp;'.$body.'&nbsp;&nbsp;';
					echo '<font color="#9f9f9f" style="font-size:13px;float:right">';
					
									$diff=strtotime($datenow)-strtotime($dateadded);
$newdiff=($diff/86400);
$timediff=$timenow-$databasetime;
$newminute=ceil($timediff/(60));
$newhour=ceil($timediff/(60*60));
if($timediff>0 && $timediff<60)
{
	echo "2s ago";
}
if($timediff>60 && $timediff<3600)
{
echo $newminute."m ago";
}
if($timediff>3600 && $timediff<86400)
{
echo $newhour."h ago";
}
if($timediff>86400 && $newdiff>=1 && $newdiff<=30)
{
	echo $newdiff."d ago";
}
if($newdiff>30)
{
	$newdate=date('j F Y',strtotime($dateadded));
	echo $newdate;
}
					echo '</font></div>
					<br>';
			}
		}
	}
}
?>
</body>
</html>