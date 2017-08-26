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
$onlinequery=mysqli_query($connection,"select * from noteonline where userfrom='$msg'") or die(mysqli_error($connection));
$onlineresult=mysqli_fetch_array($onlinequery);
$onlineuserto=$onlineresult['userto'];
?>
<html>
<head>
<title>Inbox</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-86885838-1', 'auto');
  ga('send', 'pageview');

</script>
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
.button{background:#1f8e23;color:white;font-family:arial;border:1px solid #3974c6;font-size:17px;border-radius:2px 2px 2px 2px}
#skip{font-family:arial;border:1px solid #3974c6;font-size:17px;border-radius:2px 2px 2px 2px}
.skip{font-family:arial;border:1px solid #3974c6;font-size:17px;border-radius:2px 2px 2px 2px}
#citysearch{color:red}
#current{height:30px;width:250px;border-radius:3px 3px 3px 3px}
#currentcity{color:red}
.element{border-radius:4px 4px 4px 4px;height:30px;font-size:17px;width:250px}
.element:focus{border-color:#8000ff;height:35px;width:300px}
#red{color:red}
	a{text-decoration:none}
#followersbox{height:50px;width:150px;background:white;text-align:center;color:#2ca0eb;border:1px solid #a4bed9}
#followingbox{width:52%;margin-left:auto;margin-right:auto;margin-top:50px;background:white;height:auto}
	#heading{width:100%;background:#003f3c;color:white;text-align:center}
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
.countcomments{margin-top:-32px;margin-left:90px;font-size:13px}
#newred{width:30px;height:auto;text-align:center;margin-top:-45px;margin-left:15px;background:#e10000;border-radius:2px;position:absolute;z-index:9999}
#listnotes{position:absolute;width:400px;height:auto;color:black;border:1px solid #a4bed9;background:#ffffff;margin-top:21px;display:none;}
#newrequest{width:30px;height:auto;text-align:center;margin-top:-45px;margin-left:15px;background:#e10000;border-radius:2px;position:absolute;z-index:9999}
#listrequest{position:absolute;width:400px;height:auto;color:black;border:1px solid #a4bed9;background:#ffffff;margin-top:21px;display:none;}
#newmessage{width:30px;height:auto;text-align:center;margin-top:-45px;margin-left:15px;background:#e10000;border-radius:2px;position:absolute;z-index:9999}
#listmessage{position:absolute;width:400px;height:auto;color:black;border:1px solid #a4bed9;background:#ffffff;margin-top:21px;display:none;}
#newmeme{width:30px;height:auto;text-align:center;margin-top:-45px;margin-left:15px;background:#e10000;border-radius:2px;position:absolute;z-index:9999}
	#results{background:#f5f5fa;position:absolute;z-index:9999;width:400px;height:auto;margin-top:-34px;margin-left:930px}
		#results{background:#f5f5fa;position:absolute;z-index:9999;width:400px;height:auto;margin-top:-30px;margin-left:55%}
	#searchbar{border-radius:4px 4px 0px 0px;margin-left:55%;height:25px;width:400px;margin-top:-35px;position:absolute}
	#searchicon{position:absolute;margin-left:55%;margin-top:-33px;}
	#imageurl{height:auto;width:50%;cursor:pointer;}
	#formobile{display:none}
	#menuitemlist{background:#ffffff;display:none;color:black;border:1px solid #f0f0f0;}
	#pcmenuitemlist{background:#f0f3f7;display:none;color:black;border:1px solid #f0f0f0;width:150px;position:absolute;margin-left:90%;margin-top:50px}
	#profile{width:30px;height:50px;position:absolute;}
	#home{width:20%;height:auto;margin-left:5%;position:absolute}
	#menuitems{width:20%;height:auto;margin-left:5%;position:absolute;display:none}
		#request{margin-left:10%;position:absolute}
	#message{margin-left:15%;position:absolute}
	#note{margin-left:20%;position:absolute}
		#meme{width:20%;height:auto;margin-left:25%;position:absolute}
		#pcmenu{width:20%;height:auto;margin-left:95%;position:absolute;margin-top:}
	#request1{display:none}
	#message1{display:none}
	#note1{display:none}
	#mysearch{display:none}
	#phonecomment{display:none}
	#followingbox{width:52%;margin-left:auto;margin-right:auto;margin-top:50px;background:white;height:auto}
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
	#myitem{width:100%;font-size:13px}
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
	#followingbox{width:100%;margin-left:0}
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
<div id="nav"><br>
<a href="home.php?page=1" title="home" id="home"><img src="clipart/readingbook1.png" style="height:30px;width:auto"></a>
<a id="message1" href="messages.php"><img src="clipart/envelope1.png" style="height:30px;width:auto" ><div id="newmessage1"></div></a>
<a id="note1" href="mynote.php"><img src="clipart/globe1.png" style="height:30px;width:auto" ><div id="newred1"></div></a>
<a id="mysearch" href="mysearch.php"><img src="clipart/search2.png" style="height:30px;width:auto"></a>
<a href="profile.php?id=<?php echo $msg; ?>&&page=1" title="profile" id="profile"><img src="clipart/profile.png" style="height:30px;width:auto"></a>
<a id="menuitems" onclick="togglelist();"><img src="clipart/menu1.png" style="height:30px;width:auto"></a>
<br><br><div id="menuitemlist">
<?php 
echo '<div style="text-align:center;background:#003f3c;color:white"><br><img src="'.$profilepicdb.'" style="width:50px;height:50px;border-radius:40px;text-align:center">
<br><b>'.$fn.' '.$ln.'</b><br></div><div style="background:#a4bed9;height:1px;width:100%"></div><br>
<div style="float:left;border:1px solid #f0f0f0;width:90px;border-radius:5px;text-align:center;font-size:10px">
<a href="profile.php?id='.$msg.'&&page=1" style="color:black;">Profile</a><br></div>
<center><div style="border:1px solid #f0f0f0;width:90px;border-radius:5px;text-align:center;font-size:10px">
<a href="features.php" style="color:black;">Features</a>
</div></center>
<div style="float:right;border:1px solid #f0f0f0;width:90px;border-radius:5px;text-align:center;font-size:10px;margin-top:-25px">
<a href="logout.php" style="color:black;">Logout</a>
</div>
<br><br>
<div id="line1" style="background:#a4bed9;height:1px;width:100%"></div><br>
<a href="settings.php"><div id="myitem">
<font color="black">Settings</font>
</div></a>
<br>
<div id="line1" style="background:#a4bed9;height:1px;width:100%"></div><br>
<a href="aboutus.php"><div id="myitem">
<font color="black">About Us</font>
</div></a>
<br>
<div id="line1" style="background:#a4bed9;height:1px;width:100%"></div><br>
<a href="feedback.php"><div id="myitem">
<font color="black">Feedback</font>
</div></a><br>
<div id="line1" style="background:#a4bed9;height:1px;width:100%"></div>' 
?>
</div>
<script src="jquery.js"></script>
<script>
function togglelist()
{
	var menulist=document.getElementById("menuitemlist");
	var tellmenotes=menulist.style.display;
	if(tellmenotes=="block")
	{
		menulist.style.display="none";
	}
	else
	{
		menulist.style.display="block";
	}
}
</script>
<?php
	echo '<script src="jquery.js"></script>
	<script>
$("document").ready(function()
{
	$.post("countnotification1.php",{newid: "'.$msg.'"},function(data)
		{
			$("#newred1").html(data);
		})
});
$("document").ready(function()
{
	$.post("countmeme.php",{userid: "'.$msg.'"},function(data)
		{
			$("#newmeme").html(data);
		})
});
$("document").ready(function()
{
	$.post("countmessage.php",{userid:"'.$msg.'"},function(data)
		{
			$("#newmessage1").html(data);
		})
})
</script>';
?>
</div>
<br><br>
<div id="followingbox">
<div id="heading"><b>Inbox</b></div>
<?php
echo "<div style='background:#f3f4f7;font-size:13px;height:40px;left:0px;right:0px;top:0px;bottom:0px;line-height:40px'>
<a href='createmessage.php' style='color:black;font-size:13px'><center>
<b>Create new message</b></center>
	</a></div><div id='line' style='background:#a4bed9;height:1px;width:100%'></div>";
$updatequery=mysqli_query($connection,"update messages set seen='yes' where userto='$msg'");
$forcountquery=mysqli_query($connection,"select * from messages where userto='$msg' || userfrom='$msg'");
$countquery=mysqli_num_rows($forcountquery);
if($countquery==0)
{
	echo "<div style='background:white'><center><b>No message found in your inbox</b></center>
	<div id='line' style='background:#a4bed9;height:1px;width:100%'></div></div>";
}
else
{
		$querycount=mysqli_query($connection,"select * from messages where userfrom='$msg' || userto='$msg' group by replyid order by id desc");
		$messagecount=mysqli_num_rows($querycount);
		$checknumber=ceil($messagecount/10);
		$lastnumber=ceil($messagecount/10);
	$selectquery="select max(id) as id from messages where userfrom='$msg' || userto='$msg' group by replyid order by id desc limit 10";
	$resultquery=mysqli_query($connection,$selectquery);
		while($newrow=mysqli_fetch_array($resultquery))
		{
			$myid=$newrow['id'];
			$selectquery1=mysqli_query($connection,"select * from messages where id='$myid'");
			$rowstand=mysqli_fetch_array($selectquery1);
			$userfrom1=$rowstand['userfrom'];
			$userto1=$rowstand['userto'];
			$body=$rowstand['msgbody'];
			$databasetime=$rowstand['time'];
			$opened=$rowstand['opened'];
			$newbody=substr($body,0,20);
				$dateadded=$rowstand['date'];
				if($userto1==$msg)
				{
					if($opened=="yes")
					{$searchquery="select * from register where id='$userfrom1'";
					$searchresult=mysqli_query($connection,$searchquery);
			$bigrow=mysqli_fetch_array($searchresult);
				$newid=$bigrow['id'];
				$profileimage=$bigrow['profilepic'];
			$myfirstname=$bigrow['firstname'];
			$mylastname=$bigrow['lastname'];
echo '<br><a href="viewmessages.php?id='.$newid.'" style="color:black">
<div style="float:left;width:100%;margin-top:0px"><img src="'.$profileimage.'" style="height:50px;width:50px;border-radius:40px">
		<b><div style="margin-top:-50px;margin-left:60px"><font color="#003f3c">'.$myfirstname.' '.$mylastname.'</font></b>
		<div style=";float:right;color:#808080">';
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
		echo '</div><br>'.$newbody.'....</div></div></a><br><br><br>
		<div style="width:100%;height:1px;background:#003f3c"></div>';}
				if($opened=="no")
				{
					$searchquery="select * from register where id='$userfrom1'";
					$searchresult=mysqli_query($connection,$searchquery);
			$bigrow=mysqli_fetch_array($searchresult);
				$newid=$bigrow['id'];
				$profileimage=$bigrow['profilepic'];
			$myfirstname=$bigrow['firstname'];
			$mylastname=$bigrow['lastname'];
echo '<div style="background:#f0f0f0"><br><a href="viewmessages.php?id='.$newid.'" style="color:black">
<div style="float:left;width:100%;margin-top:0px"><img src="'.$profileimage.'" style="height:50px;width:50px;border-radius:40px">
		<b><div style="margin-top:-50px;margin-left:60px"><font color="#003f3c">'.$myfirstname.' '.$mylastname.'</font></b>
		<div style=";float:right;color:#808080">';
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
		echo '</div><br>'.$newbody.'....</div></div></a><br><br><br></div>
				<div style="width:100%;height:1px;background:#003f3c"></div>';}}
		else
		{
			$searchquery="select * from register where id='$userto1'";
			$searchresult=mysqli_query($connection,$searchquery);
			$bigrow=mysqli_fetch_array($searchresult);
				$newid=$bigrow['id'];
				$profileimage=$bigrow['profilepic'];
			$myfirstname=$bigrow['firstname'];
			$mylastname=$bigrow['lastname'];
		echo '<br><a href="viewmessages.php?id='.$newid.'" style="color:black">
		<div style="float:left;width:100%"><img src="'.$profileimage.'" style="height:50px;width:50px;border-radius:40px">
		<b><div style="margin-top:-50px;margin-left:60px"><font color="#003f3c">'.$myfirstname.' '.$mylastname.'</font></b>
		<div style=";float:right;color:#808080">';
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
		echo '</div><br>'.$newbody.'....</div></div></a><br><br><br>
		<div style="width:100%;height:1px;background:#003f3c"></div>';}
}
echo '</div>';
if($messagecount<=10)
{
	echo "";
}
else
{
	echo '
<div id="mybuttontab" style="background:white">
<center>
<img src="clipart/loadajax.gif" style="display:none" id="ajaxload">
<br>
<button id="button">Load More</button>
<br><br>
</center>
</div>
<script src="jquery.js"></script>
<script>
var number=0;
$("#button").click(function()
{
	$("#ajaxload").css("display","block");
	if(number+10>='.$checknumber.')
	{
		$("#button").css("display","none");
	}
	number=number+10;
	$.post("addmessage.php",{userid:'.$msg.',number:number},function(data)
		{
			$("#followingbox").append(data);
			$("#ajaxload").css("display","none");
		})
})
</script>';
}
}
?>
</body>
</html>