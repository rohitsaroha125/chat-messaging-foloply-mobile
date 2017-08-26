<?php
include('connection.php');
$timenow=time();
$datenow=date("Y-m-d");
$number=$_POST['number'];
$getid=$_POST['getid'];
$msg=$_POST['msg'];
$seepostquery="select * from posts where addedbyid='$getid' ORDER BY id DESC limit $number,5";
$seequeryresult=mysqli_query($connection,$seepostquery);
while($seequeryrow=mysqli_fetch_array($seequeryresult))
{$mypostid=$seequeryrow['id'];
	$body=$seequeryrow['body'];
$dateadded=$seequeryrow['dateadded'];
$databasetime=$seequeryrow['time'];
$addedbyid=$seequeryrow['addedbyid'];
$imageurl=$seequeryrow['image'];
$bodylength=strlen($body);
if($bodylength>2500)
{
	$body=substr($body,0,2500);
	$body =$body.'...';
}
if($body!="" && $imageurl=="")
{$imagequery="select * from register where id='$addedbyid'";
$imageresult=mysqli_query($connection,$imagequery);
$imagerow=mysqli_fetch_array($imageresult);
$showfirstname=$imagerow['firstname'];
$showlastname=$imagerow['lastname'];
$showimage=$imagerow['profilepic'];
echo '<br><br><br><div id="seeposts">
<img src='.$showimage.' style="height:50px;width:50px;border-radius:40px;">
<b><div id="space1"><a href="profile.php?id='.$addedbyid.'&&page=1" style="color:#003c39">'.$showfirstname.' '.$showlastname.'</a></div></b>';
if($msg==$getid)
{echo '<div id="newbutton"><a href="delete.php?postid='.$mypostid.'"><img src="clipart/remove.png" style="height:20px;width:auto"></a>
</div>
';}
echo '
<br>
<div id="grey">';
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
if($newdiff>30 && $timediff>86400)
{
	$newdate=date('j F Y',strtotime($dateadded));
	echo $newdate;
}
echo '</div>
<div id="postbody"><br>&nbsp;'.$body;
if($bodylength>2500)
{echo '<br>
<a href="postnote.php?id='.$mypostid.'">See full post</a>
';}
echo "<br><br>";
}
if($imageurl!="" && $body=="")
{
$imagequery="select * from register where id='$addedbyid'";
$imageresult=mysqli_query($connection,$imagequery);
$imagerow=mysqli_fetch_array($imageresult);
$showfirstname=$imagerow['firstname'];
$showlastname=$imagerow['lastname'];
$showimage=$imagerow['profilepic'];
echo '<br><br><br><div id="seeposts">
<img src='.$showimage.' style="height:50px;width:50px;border-radius:40px;">
<b><div id="space1">
<a href="profile.php?id='.$addedbyid.'&&page=1" style="color:#003c39">
'.$showfirstname.' '.$showlastname.'</a></div></b>';
if($msg==$getid)
{echo '<div id="newbutton"><a href="delete.php?postid='.$mypostid.'"><img src="clipart/remove.png" style="height:20px;width:auto"></a>
</div>
';}
echo '<br><div id="grey">';
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
if($newdiff>30 && $timediff>86400)
{
	$newdate=date('j F Y',strtotime($dateadded));
	echo $newdate;
}
echo '</div><div id="postbody">
&nbsp;<center><img data-original='.$imageurl.' src="grey.jpg" class="lazyimage" id="imageurl">
<script>
$(function(){
	$("img.lazyimage").lazyload({
		threshold:300
	})
})
</script>
</center><br><br>';}
else if($body!=="" && $imageurl!=="")
{$imagequery="select * from register where id='$addedbyid'";
$imageresult=mysqli_query($connection,$imagequery);
$imagerow=mysqli_fetch_array($imageresult);
$showfirstname=$imagerow['firstname'];
$showlastname=$imagerow['lastname'];
$showimage=$imagerow['profilepic'];
echo '<br><br><br><div id="seeposts">
<img class="lazyibprofile" data-original='.$showimage.' src="grey.jpg" style="height:50px;width:50px;border-radius:40px;">
<script>
$(function(){
	$("img.lazyibprofile").lazyload({
		threshold:200
	})
})
</script>
<b><div id="space1">
<a href="profile.php?id='.$addedbyid.'&&page=1" style="color:#003f3c">'.$showfirstname.' '.$showlastname.'</a></div></b>';
if($msg==$getid)
{echo '<div id="newbutton"><a href="delete.php?postid='.$mypostid.'"><img src="clipart/remove.png" style="height:20px;width:auto"></a>
</div>
';}
echo '<br><div id="grey">';
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
if($newdiff>30 && $timediff>86400)
{
	$newdate=date('j F Y',strtotime($dateadded));
	echo $newdate;
}
echo '</div>
<div id="postbody"><br>&nbsp;'.$body;
if($bodylength>2500)
{echo '<br>
<a href="postnote.php?id='.$mypostid.'">See full post</a>
';}
echo "<br><br>";
echo '<center><img data-original='.$imageurl.' src="grey.jpg" class="lazyib" id="imageurl">
<script>
$(function(){
	$("img.lazyib").lazyload({
		threshold:300
	})
})
</script>
</center></div><br><br>';}
echo '<div id="iconbox"><a name="mylikes'.$mypostid.'" id="newlike'.$mypostid.'" class="newlike">';
$checklikequery=mysqli_query($connection,"select * from likes where postid='$mypostid'");
$checklikeresult=mysqli_fetch_array($checklikequery);
$checklikedby=$checklikeresult['addedby'];
$checklikedbyexplode=explode(",",$checklikedby);
if(in_array($msg,$checklikedbyexplode))
{
	echo '<img style="height:25px;width:auto;margin-top:3px" id="stylelike'.$mypostid.'" src="clipart/liked.png"/>';
}
else
{
	echo '<img style="height:25px;width:auto;margin-top:3px" id="stylelike'.$mypostid.'" src="clipart/newlike.png"/>';
}
echo '
</a><a href="likedby.php?postid='.$mypostid.'" style="color:black"><div id="result1'.$mypostid.'" class="likeresult">';
$countmylikesquery=mysqli_query($connection,"select * from likes where postid='$mypostid'") or die(mysqli_error($connection));
$findlike=mysqli_num_rows($countmylikesquery);
$countmylikesresult=mysqli_fetch_array($countmylikesquery);
$countlikes=$countmylikesresult['likes'];
if($findlike==0)
{
	echo "0";
}
else
{
	echo $countlikes;
}
echo '</div></a>
<a name="mydislikes'.$mypostid.'" id="newdislike'.$mypostid.'" class="newdislike">';
$countdislikequery=mysqli_query($connection,"select * from dislike where postid='$mypostid'") or die(mysqli_error($connection));
$countdislikeresult=mysqli_fetch_array($countdislikequery);
$countdislikedby=$countdislikeresult['addedby'];
$countdislikedbyexplode=explode(",",$countdislikedby);
if(in_array($msg,$countdislikedbyexplode))
{
	echo '<img style="height:25px;width:auto;margin-top:3px" id="styledislike'.$mypostid.'" src="clipart/disliked.png">';
}
else
{
	echo '<img style="height:25px;width:auto;margin-top:3px" id="styledislike'.$mypostid.'" src="clipart/newdislike.png">';
}
echo '</a>
<a href="dislikedby.php?postid='.$mypostid.'" style="color:black"><div class="dislikeresult" id="result2'.$mypostid.'">';
$countmydislikesquery=mysqli_query($connection,"select * from dislike where postid='$mypostid'") or die(mysqli_error($connection));
$finddislike=mysqli_num_rows($countmydislikesquery);
$countmydislikesresult=mysqli_fetch_array($countmydislikesquery);
$countdislikes=$countmydislikesresult['dislikes'];
if($finddislike==0)
{
	echo "0";
}
else
{
	echo $countdislikes;
}
echo '</div></a>
<script type="text/javascript" src="jquery.js"></script>
<script>
$("#newlike'.$mypostid.'").click(function()
{
	$.get("checklike.php",{id: '.$mypostid.',newid: '.$msg.'},function(data)
		{
			$("#stylelike'.$mypostid.'").attr("src",data);
		})
});
$("#newlike'.$mypostid.'").click(function()
{
	$.post("like.php",{id: '.$mypostid.',like: "mylikes'.$mypostid.'",newid: '.$msg.',postby: "'.$addedbyid.'",type:"like"},function(data)
		{
			$("#result1'.$mypostid.'").html(data);
		})
});
$("#newdislike'.$mypostid.'").click(function()
{
	$.post("dislike.php",{id: '.$mypostid.',dislike: "mydislikes'.$mypostid.'",newid: '.$msg.',postby: "'.$addedbyid.'",type:"dislike"},function(data)
		{
			$("#result2'.$mypostid.'").html(data);
		})
});
$("#newdislike'.$mypostid.'").click(function()
{
	$.get("checkdislike.php",{id: '.$mypostid.',newid: '.$msg.'},function(data)
		{
			$("#styledislike'.$mypostid.'").attr("src",data);
		})
});
</script>';
echo '
<a class="seecomment" id="phonecomment" href="postcomments.php?id='.$mypostid.'"><img src="clipart/newcomment.png" style="height:25px;width:auto;margin-top:3px">
<div class="countcomments" id="countcomments1'.$mypostid.'">';
$commentcountquery=mysqli_query($connection,"select * from comments where postid='$mypostid'") or die(mysqli_error($connection));
$commentcountresult=mysqli_num_rows($commentcountquery);
if($commentcountresult==0)
{
	echo "0";
}
else
{
	echo $commentcountresult;
}
echo '</div></a>
<a class="star" id="star'.$mypostid.'" href="tagpeoplepost.php?post='.$mypostid.'">
<img src="clipart/newstar.png" id="stylestar'.$mypostid.'" style="height:25px;width:auto;margin-top:3px"></a></div><br>
';
}
?>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="lazyload/jquery.lazyload.min.js"></script>