<?php
include ( "./inc/connect.inc.php" );
ob_start();
session_start();
if (!isset($_SESSION['user_login'])) {
	header('location: index.php');
}
else {
	$user = $_SESSION['user_login'];
}
?>


<style type="text/css">
hr {
    background-color: #B5B2B2;
    height: 1px;
    margin: 4px 52px;
    border: 0px;
}
.ShareTime_by {
	color: #ef8d02; 
	text-decoration: none;
}
.ShareTime_by:hover {
	text-decoration: underline;
}
/* commentBody styel from here*/

.commentPostText {
	margin-left: 52px; 
	font-family: helvetica, arial, sans-serif; 
	font-size: 13px; 
	font-weight: normal; 
	color: #141823; 
	line-height: 1.5;
}
.commentSubmit {
    background-color: #ef8d02;
    color: #ECF6EC;
    float: right;
    height: 25px;
    width: 66px;
    font-size: 12px;
    border-radius: 2px;
    border: 1px solid #5C5E5C;
}
.commentSubmit:hover {
  background-color: rgba(11, 129, 11, 0.82);
}
</style>

<script language="javascript">
	function toggle() {
		var ele = document.getElementById("toggleComment");
		var text = document.getElementById("displayComment");
		if (ele.style.display == "block") {
			ele.style.display = "none"
		}else {
			ele.style.display = "block";
		}
	}
</script> 

<?php 

$getid = $_GET['id'];

$ShareTime_body = htmlspecialchars(@$_POST['ShareTime_body'], ENT_QUOTES);
$ShareTime_body = trim($ShareTime_body);
if ($ShareTime_body != "") {
if (isset($_POST['ShareTimeComment' . $getid . ''])) {
	$ShareTime_body = $_POST['ShareTime_body'];
	$date_added = date("Y-m-d");
	$query = mysqli_query($con,"SELECT  id,added_by  FROM ShareTime WHERE id='$getid'");
	$query_row = mysqli_fetch_assoc($query);
	$ShareTime_to = $query_row['added_by'];
	$insertPost = mysqli_query($con,"INSERT INTO ShareTime_comments VALUES ('','$ShareTime_body','$date_added',NOW(),'$user','$ShareTime_to','no','$getid')");
}
}
//post query
	$query = mysqli_query($con,"SELECT  id,added_by  FROM ShareTime WHERE id='$getid'");
	$query_row = mysqli_fetch_assoc($query);
	$ShareTime_to = $query_row['added_by'];
	//getting post by gender
	$shareby_query = mysqli_query($con,"SELECT  * FROM users WHERE username='$ShareTime_to'");
	$shareby_gender_row = mysqli_fetch_assoc($shareby_query);
	$shareby_gender_value = $shareby_gender_row['gender'];
	//getting user gender
	$usergender_query = mysqli_query($con,"SELECT  * FROM users WHERE username='$user'");
	$user_gender_row = mysqli_fetch_assoc($usergender_query);
	$user_gender_value = $user_gender_row['gender'];
?>

<?php 
	if ($shareby_gender_value == 2) {
		if (($ShareTime_to == $user) || ($user_gender_value == 2)) {
			echo "
			<div style='margin: 0 52px;'>
			<form action='tommycomments.php?id=".$getid."' method='POST' name='ShareTimeComment".$getid."'>
				<input style='padding: 10px 3px; width: 83%; margin: 0 0 5px 0; resize: none; border: 1px solid #ef8d02;' name='ShareTime_body' placeholder= 'Leave your comment here!'>
				<input type='submit' name='ShareTimeComment".$getid."' class='commentSubmit' value='Comment'>
			</form>
			</div>
		";
	}else {
		$get_msg_num = mysqli_query($con,"SELECT  * FROM pvt_messages WHERE user_from='$ShareTime_to' AND user_to='$user' LIMIT 3");
			$female_msg = mysqli_num_rows($get_msg_num);
			if ($female_msg >=1 ) {
				echo "
					<div style='margin: 0 52px;'>
					<form action='tommycomments.php?id=".$getid."' method='POST' name='ShareTimeComment".$getid."'>
						<input style='padding: 10px 3px; width: 83%; margin: 0 0 5px 0; resize: none; border: 1px solid #ef8d02;' name='ShareTime_body' placeholder= 'Leave your comment here!'>
						<input type='submit' name='ShareTimeComment".$getid."' class='commentSubmit' value='Comment'>
					</form>
					</div>
				";
			}else {
				echo "<p style=' text-align: center; font-size: 18px; color: #7B7B7B; font-weight: bold;'>Sorry! You can not leave comment here.</p>";
			}
		}
	}else {
		echo "
			<div style='margin: 0 52px;'>
			<form action='tommycomments.php?id=".$getid."' method='POST' name='ShareTimeComment".$getid."'>
				<input style='padding: 10px 3px; width: 83%; margin: 0 0 5px 0; resize: none; border: 1px solid #ef8d02;' name='ShareTime_body' placeholder= 'Leave your comment here!'>
				<input type='submit' name='ShareTimeComment".$getid."' class='commentSubmit' value='Comment'>
			</form>
			</div>
		";
	}
	?>


<?php
//Get relevant ShareTime
$get_comments = mysqli_query($con,"SELECT  * FROM ShareTime_comments WHERE ShareTime_id='$getid' ORDER BY id DESC");
$count = mysqli_num_rows($get_comments);
if ($count != 0) {
while ($comment = mysqli_fetch_assoc($get_comments)) {
	$ShareTime_body = $comment['ShareTime_body'];
	$date_added = $comment['date_added'];
	$ShareTime_to = $comment['ShareTime_to'];
	$dawat_by = $comment['ShareTime_by'];
	$get_user_info = mysqli_query($con,"SELECT  * FROM users WHERE username='$dawat_by'");
	$get_info = mysqli_fetch_assoc($get_user_info);
	$profile_pic_db= $get_info['profile_pic'];
	$ShareTime_by = $get_info['first_name'];
	$share_user_info = mysqli_query($con,"SELECT  * FROM users WHERE username='$ShareTime_by'");
	$fname_info = mysqli_fetch_assoc($share_user_info);
	
	//check for propic delete
						$pro_changed = mysqli_query($con,"SELECT  * FROM posts WHERE added_by='$dawat_by' AND (discription='changed his profile picture.' OR discription='changed her profile picture.') ORDER BY id DESC LIMIT 1");
						$get_pro_changed = mysqli_fetch_assoc($pro_changed);
		$pro_num = mysqli_num_rows($pro_changed);
		if ($pro_num == 0) {
			$profile_pic = "img/default_propic.png";
		}else {
			$pro_changed_db = $get_pro_changed['photos'];
		if ($pro_changed_db != $profile_pic_db) {
			$profile_pic = "img/default_propic.png";
		}else {
			$profile_pic = "userdata/profile_pics/".$profile_pic_db;
		}
		}
	
		echo "
	<div class='commentPostText'>
	<div style='float: left; margin: 0 10px 0 0;'><img src='$profile_pic' style= 'border-radius: 22px'; title=\"$ShareTime_by\" height='38' width='38'  /></div>
	<div style='margin-left: 48px;'>
	<b><a href='profile.php?u=$dawat_by' title=\"Go to $ShareTime_by's Profile\" target='_top' class='ShareTime_by'>$ShareTime_by</a></b><p style='font-size: 10px; margin: 0;'>".$date_added."</p>
	".nl2br($ShareTime_body)."
	
	</div>
	</div><br>";
	
}
}else {
	echo "<center><br><br><br>Opps! There is no comment to view.</center>";
}

?>
