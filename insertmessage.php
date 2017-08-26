<html>
<head>
<style>
#sent{margin-top:5px;background:#003f3c;display:inline-block;max-width:100%;height:auto;
			       font-size:17px;color:white;float:right;margin-left:49%;}
#got{margin-top:5px;background:#e5e5e5;display:inline-block;max-width:100%;height:auto;
			         font-size:17px;color:black;margin-left:1%}
@media screen and (max-width:720px)
{
#sent{margin-top:5px;background:#003f3c;display:inline-block;width:80%;height:auto;
			         font-size:17px;color:white;margin-right:1%}
	#got{margin-top:5px;background:#e5e5e5;display:inline-block;width:80%;height:auto
	;font-size:17px;color:black;margin-left:1%}
}
</style>
</head>
<body>
<?php
include('connection.php');
	if(isset($_POST['body']) && !empty($_POST['body']))
	{
		$body1=strip_tags($_POST['body']);
		$msgbody=mysqli_real_escape_string($connection,$body1);
		$date=date("Y-m-d");
		$time=time();
			$msg=$_POST['userfrom'];
	$getid=$_POST['userto'];
		$opened="no";
		$deleted="no";
		$selectquery=mysqli_query($connection,"select * from messages where userfrom='$getid' && userto='$msg' || userfrom='$msg' && userto='$getid'");
		$countnumber=mysqli_num_rows($selectquery);
		if($countnumber==0)
		    {
			$insertquery=mysqli_query($connection,"insert into messages values('','$msg','$getid','$msgbody','$date','$opened','$deleted','','$time','no')") or die(mysqli_error($connecion));
			if($insertquery)
			{
				$newselectquery=mysqli_query($connection,"select * from messages where userfrom='$getid' && userto='$msg' || userfrom='$msg' && userto='$getid'")  or die(mysqli_error($connecion));
				$newresult=mysqli_fetch_array($newselectquery);
				$id=$newresult['id'];
				$newupdate=mysqli_query($connection,"update messages set replyid='$id' where id='$id'")  or die(mysqli_error($connecion));
			}
			}
			else
			{
$newselectquery=mysqli_query($connection,"select * from messages where userfrom='$getid' && userto='$msg' || userfrom='$msg' && userto='$getid' order by id asc limit 1") or die(mysqli_error($connection));
while($newresult=mysqli_fetch_array($newselectquery))
{$newid=$newresult['id'];
$insertquery=mysqli_query($connection,"insert into messages values ('','$msg','$getid','$msgbody','$date','$opened','$deleted','$newid','$time','no')") or die(mysqli_error($connection));}		    
			}
		}
?>
</body>
</html>