<?php
$timenow=time();
$datenow=date("Y-m-d");
ob_start();
session_start();
include('connection.php');
if(isset($_COOKIE['id']) && !empty($_COOKIE['id']))
{
	$msg=$_COOKIE['id'];
		$selectsql=mysqli_query($connection,"select * from online where userid='$msg'");
		$resultsql=mysqli_fetch_array($selectsql);
		$mysessionstart=$resultsql['sessionstart'];
		$countsql=mysqli_num_rows($selectsql);
		if($countsql==0)
		{
			$insertquery=mysqli_query($connection,"insert into online values('','$msg','$timenow','0')") or die(mysqli_error($connection));
		}
		else
		{
			$updatequery=mysqli_query($connection,"update online set sessionstart='$timenow' where userid='$msg'") or die(mysqli_error($connection));
		}
		$query="select * from register where id='$msg'";
		$result=mysqli_query($connection,$query);
		$row=mysqli_fetch_array($result);
		$email=$row['email'];
		$fn=$row['firstname'];
		$ln=$row['lastname'];
		$accounttype=$row['accounttype'];
		$following=$row['following'];
		$followingexplode=explode(",",$following);
		$countfollowing=count($followingexplode);
		$followers=$row['followers'];
		$followerexplode=explode(",",$followers);
		$profilepicdb=$row['profilepic'];
}
else {header('location: formobile.php');}
?>
<?php
if(isset($_GET['id']) && !empty($_GET['id']))
{
	$userid=mysqli_real_escape_string($connection,$_GET['id']);
}
if(isset($_GET['msgid']))
{
	$getid=mysqli_real_escape_string($connection,$_GET['msgid']);
	if($getid)
	{$queryid="select * from messages where id='$getid'";
	$resultid=mysqli_query($connection,$queryid);
	while($rowid=mysqli_fetch_array($resultid))
	{
		$body=$rowid['msgbody'];
	
?>
<?php
$onlinequery=mysqli_query($connection,"select * from noteonline where userfrom='$msg'") or die(mysqli_error($connection));
$onlineresult=mysqli_fetch_array($onlinequery);
$onlineuserto=$onlineresult['userto'];
?>
<html>
<head>
<title>Delete Message</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<style>
body{padding:0px; margin:0px;background:#dbdee6;font-family:arial}
#nav{background:#003f3c; color:white; width:100%; position:fixed;top:0;font-family:arial;font-size:16px;height:70;z-index:9999;margin:0px;padding:0px;}
#nav a{text-decoration:none;color:white;font-size:20px}
#register{background:#f6f7fa; color:#4d4d4c;font-family:arial;font-size:15px;height:750px;width:500px;border-radius:8px 8px 8px 8px;margin-top:170px}
#a5012687_ds{background:#f0f0f0;color:black;border-radius:8px 8px 8px 8px}
#search{height:30px;width:250px;border-radius:3px 3px 3px 3px}
#options {height:30px;width:270px;border-radius:3px 3px 3px 3px}
#button{background:#1f8e23;color:white;font-family:arial;border:1px solid #3974c6;font-size:17px;border-radius:2px 2px 2px 2px}
#button1{background:#e10000;color:white;font-family:arial;border:1px solid #3974c6;font-size:17px;border-radius:2px 2px 2px 2px}
#skip{font-family:arial;border:1px solid #3974c6;font-size:17px;border-radius:2px 2px 2px 2px}
#citysearch{color:red}
#current{height:30px;width:250px;border-radius:3px 3px 3px 3px}
#currentcity{color:red}
.element{border-radius:4px 4px 4px 4px;height:30px;font-size:17px;width:250px}
.element:focus{border-color:#8000ff;height:35px;width:300px}
#red{color:red}
	a{text-decoration:none}
#followersbox{height:50px;width:150px;background:white;text-align:center;color:#2ca0eb;border:1px solid #a4bed9}
#followingbox{width:52%;margin-left:auto;margin-right:auto;margin-top:50px;background:white;height:auto}
#imagebox{height:50px;width:150px;background:white;text-align:center;color:#2ca0eb;margin-left:300px;margin-top:-52px;border:1px solid #a4bed9}
#left{margin-left:5px}
#box{width:200px;height:200px;color:black;}
#new{height:430px;width:100%;background:white;margin-top:0;margin-left:0px;font-family:arial}
#profilebox{height:auto;width:500px;background:#f0f0f0;margin-top:20px;margin-left:5%;font-family:arial;position:absolute}
#storybox{width:704px;background:white;margin-top:50px;margin-left:auto;margin-right:auto;font-family:arial;height:auto;}
#skip{font-family:arial;border:1px solid #3974c6;font-size:17px;border-radius:2px 2px 2px 2px}
#space{color:#043abe}
#box1{background:white;width:452px;margin-left:25px;border: 1px solid #e5e5e5;padding:3px}
#right{background:#f6f7f8;height:30px;width:700px;border:1px solid #e5e5e5}
#seeposts{background:white;width:100%;margin-left:0px}
#space1{color:#043abe;margin-top:-50px;margin-left:50px}
#postbody{margin-left:0px;margin-top:5%}
#grey{color:grey;font-size:15px;margin-left:50px;margin-top:-20px}
#forname{font-size:10px;color:blue;}
#left10{margin-left:-10px}
#left11{margin-left:50px}
#left12{margin-left:50px;margin-top:170px}
#myinfo{margin-top:-400px;width:600px;margin-left:600px;background:white;height:400px}
#farleft{margin-left:0px;width:500px}
#myleft{margin-left:0px;margin-top:-10px}
#myleft1{margin-left:0px;margin-top:-10px}
#postmyinfo{margin-top:-240px;margin-left:400px}
#side{margin-left:0px;width:300px;margin-top:-15px;font-size:20px}
#newspacex{background:white;height:100px;width:300px}
#justup{margin-top:-215px;margin-left:150px;}
#suggestion{height:350px;margin-top:-230px;margin-left:450px;width:400px;background:white;border:1px solid #e5e5e5}
#inside{height:50px;width:400px;font-family:arial}
#word{margin-top:-20px;margin-left:40px}
#changeme{display:none}
#lineup{margin-left:270px;margin-top:-32px}
.submitbutton{margin-top:-20px}
#labelme{cursor:hand}
.overlay{height:100%;width:100%;top:0px;left:0px;display:none;background:#000;position:fixed}
.specialbox{height:700px;width:700px;position:absolute;margin-left:-150px;margin-top:-100px;display:none;}
#round{height:80px;width:80px;border-radius:80px}
#previewimage{width:324px;height:122px;margin-top:-127px;margin-left:370px;border:2px solid #f0f0f0}
#output{height:200px;width:100px;margin-top:0px;margin-left:0px}
#styleimage{height:100px;width:auto}
#thisbutton{margin-left:630px;background:#1f8e23;color:white;font-family:arial;border:1px solid #3974c6;font-size:17px;border-radius:2px 2px 2px 2px}
#positionbutton{margin-top:7px;margin-left:60%;}
.commentlink{margin-left:-60%}
.submitcomment{background:#1f8e23;color:white;font-family:arial;border:1px solid #3974c6;font-size:17px;border-radius:2px 2px 2px 2px}
.commentbox{width:60%;height:25px;border-radius:4px;margin-left:10px}
#newbutton{margin-top:-15px;margin-left:640px}
.newdislike{background:#f0f0f0;border:1px solid #a4bed9;width:90px;margin-left:180px;margin-top:0;height:32px;border:1px solid #a4bed9;position:absolute;text-align:center}
.newlike{background:#f0f0f0;border:1px solid #a4bed9;width:90px;height:32px;border:1px solid #a4bed9;position:absolute;text-align:center}
.likeresult{background:#f0f0f0;height:32px;width:90px;margin-top:0;margin-left:89px;text-align:center;font-size:13px;line-height:35px;border:1px solid #a4bed9;position:absolute}
.dislikeresult{background:#f0f0f0;height:32px;width:90px;margin-top:0;margin-left:269px;text-align:center;font-size:13px;line-height:35px;border:1px solid #a4bed9;position:absolute}
.seecomment{background:#f0f0f0;height:32px;width:200px;margin-top:0;margin-left:360px;text-align:center;line-height:35px;border:1px solid #a4bed9;position:absolute}
.star{height:32px;width:145px;margin-top:0;margin-left:559px;border:1px solid #a4bed9;position:absolute;background:#f0f0f0;text-align:center}
.thiscomment{background:#f6f7f8}
.mylist{margin-left:-65px;background:#f0f0f0;border:4px groove #a4bed9;width:100px;font-size:15px;color:#064469;position:absolute}
.countcomments{margin-top:-32px;margin-left:90px;}
#newred{width:30px;height:auto;text-align:center;margin-top:-45px;margin-left:15px;background:#e10000;border-radius:2px;position:absolute;z-index:9999}
#listnotes{position:absolute;width:400px;height:auto;color:black;border:1px solid #a4bed9;background:#ffffff;margin-top:21px;display:none;}
#newrequest{width:30px;height:auto;text-align:center;margin-top:-45px;margin-left:15px;background:#e10000;border-radius:2px;position:absolute;z-index:9999}
#listrequest{position:absolute;width:400px;height:auto;color:black;border:1px solid #a4bed9;background:#ffffff;margin-top:21px;display:none;}
#newmessage{width:30px;height:auto;text-align:center;margin-top:-45px;margin-left:15px;background:#e10000;border-radius:2px;position:absolute;z-index:9999}
#listmessage{position:absolute;width:400px;height:auto;color:black;border:1px solid #a4bed9;background:#ffffff;margin-top:21px;display:none;}
#newmeme{width:30px;height:auto;text-align:center;margin-top:-45px;margin-left:15px;background:#e10000;border-radius:2px;position:absolute;z-index:9999}
	#results{background:#f5f5fa;position:absolute;z-index:9999;width:400px;height:auto;margin-top:-34px;margin-left:930px}
	#searchbar{border-radius:4px 4px 0px 0px;margin-left:55%;height:25px;width:400px;margin-top:-35px;position:absolute}
	#searchicon{position:absolute;margin-left:55%;margin-top:-33px;}
	#imageurl{height:auto;width:50%;cursor:pointer;}
	#formobile{display:none}
	#menuitemlist{background:#ffffff;display:none;color:black;border:1px solid #f0f0f0;}
	#profile{width:30px;height:50px;position:absolute;}
	#home{width:20%;height:auto;margin-left:5%;position:absolute}
	#menuitems{width:20%;height:auto;margin-left:5%;position:absolute;display:none}
		#request{margin-left:10%;position:absolute}
	#message{margin-left:15%;position:absolute}
	#note{margin-left:20%;position:absolute}
		#meme{width:20%;height:auto;margin-left:25%;position:absolute}
	#request1{display:none}
	#message1{display:none}
	#note1{display:none}
		#heading{width:100%;background:#003f3c;color:white;text-align:center}
	#mysearch{display:none}
	#phonecomment{display:none}
	#phonecount{display:none}
	.createpost{display:none}
	#fornext{background:white;border:1px solid #a7a7a7;border-radius:4px;margin-right:auto;margin-left:auto;color:black;width:400px;height:30px;line-height:30px;text-align:center}
	#searchimage{;margin-left:1304px;margin-top:-50px;border:1px solid black;}
	#putthem{width:300px;margin-left:auto;margin-right:auto}
	#followercount{margin-left:0px;margin-top:100px;}
	#followingcount{text-align:center;margin-top:-40px}
	#photoscount{text-align:right;margin-top:-40px}
	#imagechange{position:absolute;background:white;left:0;right:0;top:0;bottom:0;color:black;height:100px;width:30%;margin:auto;border-radius:5px;}
	#myblocklist{margin-left:48%;background:#f0f0f0;border:4px groove #a4bed9;width:100px;font-size:15px;color:#064469;position:absolute;margin-top:10px}
	#blockimage{height:30px;width:auto;margin-left:45%;position:absolute}
	#overlaybody{height:100%;width:100%;top:0px;left:0px;display:none;background:#000;position:fixed;}
	#myimageblock{border:1px solid #a4bed9;height:31%;lin-height:100%}
@media screen and (max-width:720px){
	#profilebox{margin-top:0px;margin-left:0px;width:100%;height:auto;padding:0px;margin:0px}
	#box1{width:98%;margin-left:0px;margin-top:0px}
	#followersbox{width:33%;margin-left:0px}
	#followingbox{width:100%;margin-left:0}
	#imagebox{width:33%;margin-left:66%}
	#storybox{margin-left:0px;margin-top:50px;width:100%}
	#mytextarea{margin-left:0px;width:50%}
	#previewimage{margin-left:49%;width:51%;display:none}
	#right{width:100%;margin-left:0px}
	#output{height:100px;width:auto}
	#thisbutton{margin-left:75%}
	#seeposts{width:99.8%;margin-left:0px}
	#newbutton{margin-left:80%}
	.newlike{margin-left:0px;width:12.76%;}
	.likeresult{margin-left:12.76%;width:12.76%;font-size:12px}
	.newdislike{margin-left:25.52%;width:12.76%}
	.dislikeresult{margin-left:38.28%;width:12.76%;font-size:12px}
	.seecomment{margin-left:51.04%;width:28.38%;}
	.star{margin-left:79.42%;width:20.58%}
	.countcomments{margin-left:70%;}
	#imageurl{height:auto;width:100%;}
	#home{width:auto;height:20px;margin-left:0%;position:absolute}
	#message1{display:block;width:auto;height:20px;margin-left:16.67%;position:absolute}
	#note1{display:block;width:auto;height:20px;margin-left:33.34%;position:absolute}
	#mysearch{display:block;width:auto;height:20px;margin-left:50.1%;position:absolute}
		#profile{width:auto;height:20px;position:absolute;display:block;margin-left:66.67%;}
	#menuitems{width:auto;height:40px;margin-left:83.44%;position:absolute;display:block}
	#request{display:none}
	#pcmenu{display:none}
	#message{display:none}
	#note{display:none}
	#newred1{width:25px;height:auto;text-align:center;margin-top:-42px;background:#e10000;border-radius:2px;margin-left:15px;z-index:9999;position:absolute}
#listnotes{width:100%;height:auto;color:black;border:1px solid #a4bed9;background:#f6f7f8;margin-left:0%;margin-top:30px;display:none;overflow:scroll}
#newrequest1{width:25px;height:auto;text-align:center;margin-top:-42px;background:#e10000;border-radius:2px;margin-left:15px;z-index:9999;position:absolute}
#listrequest{width:100%;height:auto;color:black;border:1px solid #a4bed9;background:#f6f7f8;margin-left:0%;margin-top:30px;display:none;overflow:scroll}
#newmessage1{width:25px;height:auto;text-align:center;margin-top:-42px;background:#e10000;border-radius:2px;margin-left:15px;z-index:9999;position:absolute}
#listmessage{width:100%;height:auto;color:black;border:1px solid #a4bed9;background:#f6f7f8;margin-left:0%;margin-top:30px;display:none;overflow:scroll}
#newmeme{width:25px;height:auto;text-align:center;margin-top:-42px;background:#e10000;border-radius:2px;margin-left:15px;z-index:9999;position:absolute}
#mytextarea{width:80%;height:30px}
#formobile{display:block}
#forpc{display:none}
#searchicon{display:none}
#phonecomment{display:block;color:black}
#pccomment{display:none}
#fornext{background:white;border:1px solid #a7a7a7;border-radius:4px;margin-right:auto;margin-left:auto;color:black;width:100%;height:30px;line-height:30px;text-align:center}	
#pccount{display:none}
#phonecount{display:block}
#putthem{width:100%;margin-left:0px}
.pcpost{display:none}
#imagechange{width:100%}
#searchbar{display:none}
.createpost{display:block;margin-right:auto;margin-left:auto;width:100%;marginn-top:5px}
#myblocklist{margin-left:40%}
#blockimage{margin-left:35%}
#myitem{width:100%;font-size:15px}
}
</style>
<script src="jquery.js"></script>
<script>
function getminus()
{
	$.post("getminus.php",{msg:'<?php echo $msg; ?>',getid:'<?php echo $onlineuserto; ?>'},function(data)
		{
			if(data<90)
			{
				$.post("seeonline.php",{msg:'<?php echo $msg; ?>',getid:'<?php echo $onlineuserto; ?>',type:"online"})
			}
			else
			{
				$.post("deleteonline.php",{msg:'<?php echo $msg; ?>',getid:'<?php echo $onlineuserto; ?>',type:"online"})
			}
		})
}
function mytime()
{
	var d=new Date();
	var n=d.getTime();
	n=n/1000;
	var time=Math.ceil(n);
	$.post("addtime.php",{time: time,userid:<?php echo $msg; ?>});
}
window.addEventListener("mousemove",mytime);
window.addEventListener("mousemove",getminus);
</script>
</head>
<body>
<div style="background:#003f3c;text-align:center;width:100%;height:30px;color:white;margin-top:0px">
	<a id="back" onclick="goback();"><img src="clipart/back1.png" style="height:30px;width:auto;float:left"></a>
</div>
<center>
<div id="followingbox">
<div id="heading"><b>Delete Message</b></div><br><br>
<b>Are you sure you want to delete this message</b><br>
<form action="deletemessage.php?id=<?php echo $userid; ?>&&msgid=<?php echo $getid; ?>" method="post">
<input type="submit" value="Yes" name="yes" id="button">&nbsp;&nbsp;&nbsp;
<input type="submit" value="No" name="no" id="skip">
</form><br>
<?php

if(isset($_POST['yes']))
{
	$deletequery=mysqli_query($connection,"delete from messages where id='$getid'") or die(mysqli_error($connection));
	if($deletequery)
	{
		header('location:viewmessages.php?id='.$userid.'');
	}
}
if(isset($_POST['no']))
{
	header('location:viewmessages.php?id='.$userid.'');
}
}}
}
?>
</div>
</body>
</html>