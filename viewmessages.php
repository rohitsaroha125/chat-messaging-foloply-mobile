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
if(isset($_GET['id']))
{
	$getid=mysqli_real_escape_string($connection,$_GET['id']);
	if($getid)
	{$queryid="select * from register where id='$getid'";
	$resultid=mysqli_query($connection,$queryid);
	while($rowid=mysqli_fetch_array($resultid))
	{
		$firstname=$rowid['firstname'];
		$lastname=$rowid['lastname'];
		$email1=$rowid['email'];
	}}
}
?>
<html>
<head>
<title>Chat</title>
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
#new{height:400px;width:100%;background:white;margin-top:0;margin-left:0px;font-family:arial}
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
#output{height:200px;width:100px;margin-top:-130px;margin-left:0px}
#styleimage{height:100px;width:auto}
#thisbutton{margin-left:630px;background:#1f8e23;color:white;font-family:arial;border:1px solid #3974c6;font-size:17px;border-radius:2px 2px 2px 2px}
#positionbutton{margin-top:-25px;margin-left:35px}
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
#listnotes{position:absolute;width:400px;height:auto;color:black;border:1px solid #a4bed9;background:#f6f7f8;margin-top:30px;display:none;}
#newrequest{width:30px;height:auto;text-align:center;margin-top:-45px;margin-left:15px;background:#e10000;border-radius:2px;position:absolute;z-index:9999}
#listrequest{position:absolute;width:400px;height:auto;color:black;border:1px solid #a4bed9;background:#f6f7f8;margin-top:30px;display:none;}
#newmessage{width:30px;height:auto;text-align:center;margin-top:-45px;margin-left:15px;background:#e10000;border-radius:2px;position:absolute;z-index:9999}
#listmessage{position:absolute;width:400px;height:auto;color:black;border:1px solid #a4bed9;background:#f6f7f8;margin-top:30px;display:none;}
	#results{background:#f5f5fa;position:absolute;z-index:9999;width:400px;height:auto;margin-top:-34px;margin-left:930px}
	#searchbar{border-radius:4px 4px 0px 0px;margin-left:930px;height:25px;width:400px;margin-top:-40px}
	#imageurl{height:auto;width:50%;cursor:pointer;}
	#formobile{display:none}
	#menuitemlist{background:#ffffff;display:none;color:black;border:1px solid #f0f0f0}
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
	#request1{display:none}
	#message1{display:none}
	#note1{display:none}
	#mysearch{display:none}
	#followercount{text-align:left;margin-top:100px}
	#followingcount{text-align:center;margin-top:-40px}
	#photoscount{text-align:right;margin-top:-40px}
	#putthem{margin-left:auto;margin-right:auto;width:300px}
	.messagetext{width:60%;height:50px;float:left;resize:none}
	#white{background:white;width:600px;margin-right:auto;margin-left:auto;margin-top:20px}
	#old{background:white;width:600px;margin-right:auto;margin-left:auto;margin-top:20px}
#thistype{background:white;width:100%;max-width:600px;height:auto}
#loadmore{background:#f2f4ff;color:black;width:auto;height:25px;margin-left:auto;margin-right:auto;border-radius:4px;margin-top:0px;box-shadow:none}
@media screen and (max-width:720px)
{
	body{background:white}
	#loadmore{margin-top:-40px}
	#followingbox{width:100%;margin-left:0px}
	.messagetext{width:75%}
	#white{width:100%;margin-top:-20px;overflow:scroll;overflow-y:hidden;overflow-x:hidden;margin-left:0px}
	#old{width:100%;margin-top:-20px;overflow:scroll;overflow-y:hidden;overflow-x:hidden;margin-left:0px}
	#thistype{width:100%;max-width:100%;height:auto}
	#nav{display:none}
}
</style>
</head>
<body>
<div style="background:#003f3c;text-align:center;width:100%;height:30px;color:white;margin-top:0px;line-height:30px">
<a id="back" href="messages.php?page=1"><img src="clipart/back1.png" style="height:30px;width:auto;float:left"></a>
<b>
<?php
echo $firstname.' '.$lastname;
?>
</b></div>
<div id="followingbox">
<br>
<center>
<?php
$countmessagesql=mysqli_query($connection,"select * from messages where userfrom='$msg' && userto='$getid' || userfrom='$getid' && userto='$msg'") or die(mysqli_error($connection));
$countmessage=mysqli_num_rows($countmessagesql);
$newnumber=($countmessage-10)/200;
$ceilnumber=ceil($newnumber);
if($countmessage>10)
{
	echo '<button name="loadmore" id="loadmore">Load more</button><br>
<img src="clipart/loadajax.gif" id="ajaxload" style="height:30px;width:auto;display:none">';
}
else
{
	echo "";
}
?>
</center>
<br>
<div id="old"></div><br>
<div id="white">
</div>
<div id="write"></div>
<br><br>
</div>
<center>
<?php
$newupdatequery=mysqli_query($connection,"update messages set opened='yes' where userfrom='$getid' && userto='$msg'");
if(in_array($getid,$followingexplode) || in_array($getid,$followerexplode))
{
	echo '<div id="thistype">
<textarea name="message" id="message'.$msg.'" class="messagetext" style="display:block;" placeholder="Write your message"></textarea>
&nbsp;&nbsp;
<input type="submit" name="sendmsg'.$getid.'" value="Send" id="button">
</div>';
}
else
{
	echo "<br><br><div style='margin-top:-50px'><b>
	Sorry but you can't send this user any message</b></div>";
}
?>
</center>
<script src="jquery.js"></script>
<script>
var mymultiple=0;
$("#loadmore").mousedown(function()
{
	mymultiple=mymultiple+1;
	if(mymultiple>=<?php echo $ceilnumber; ?>)
	{
		$("#loadmore").css('display','none');
	}
	$("#ajaxload").show();
	$.post("loadoldmessage.php",{userto:"<?php echo $getid; ?>",userfrom:"<?php echo $msg; ?>",button: "loadmore",mymultiple:mymultiple},function(data)
		{
			$("#old").html(data);
			$("#ajaxload").hide();
	})
});
$("document").ready(function()
{
$.post("loadmessage.php",{userto:"<?php echo $getid; ?>",userfrom:"<?php echo $msg; ?>",number:10},function(data)
		{
			$("#white").html(data);
	});
});
$("document").ready(function()
{
	setInterval(function()
	{$.post("loadmessage.php",{userto:"<?php echo $getid; ?>",userfrom:"<?php echo $msg; ?>",number:10},function(data)
		{
			$("#white").html(data);
	})},1000);
});
$("document").ready(function(){
	setInterval(function()
	{
		$.post("tellme1.php",{userto:"<?php echo $getid; ?>",userfrom:"<?php echo $msg; ?>"},function(data)
			{
				$("#write").html(data);
	})},1000);
})
$("document").ready(function()
{
	setInterval(function()
	{$.post("lastone.php",{userto:"<?php echo $getid; ?>",userfrom:"<?php echo $msg; ?>"},function(data)
		{
           var usertoid=data;
$("#message"+usertoid).focusin(function()
{
   $.post("tellme.php",{userto:"<?php echo $getid; ?>",userfrom:"<?php echo $msg; ?>",clickedby:usertoid},function(data)
		{
			$("#write").html(data);
	});
			});
	})},1000);
});
$("#button").click(function()
{
	var checkopera=navigator.userAgent.indexOf("Opera Mini");
$.post("insertmessage.php",{body:$('#message<?php echo $msg; ?>').val(),userto:"<?php echo $getid; ?>",userfrom:"<?php echo $msg; ?>",number:5},function(data)
	{
			if(checkopera==-1)
		{
			$("#message<?php echo $msg; ?>").val("");
			$("#white").append(data);
		}
			else
		{
		location.reload();
		}
	});
})
</script>
<br>
</body>
</html>