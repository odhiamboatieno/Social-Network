<?php 
 include ( "inc/connect.inc.php");
session_start();
if (!isset($_SESSION['user_login'])) {
	header('location: login.php');
}
else {
	$user = $_SESSION['user_login'];
}
 //showmore for profile home post
 $newsfeedlastid = $_REQUEST['newsfeedlastid'];
 if (isset($newsfeedlastid)) {
 	$newsfeedlastid = $_REQUEST['newsfeedlastid'];
 }else {
 	header("location: index.php");
 }
 if ($newsfeedlastid >= 1) {
		//timeline query table
		$getposts = mysqli_query($con,"SELECT  * FROM posts WHERE newsfeedshow ='1' AND report ='0' AND ShareTime_give ='0' AND note='0' AND id < $newsfeedlastid ORDER BY id DESC") or die(mysqli_error());
		if (mysqli_num_rows($getposts)) {
		
		//declear variable
		$getpostsNum= 0;
			while ($row = mysqli_fetch_assoc($getposts)) {
				$added_by = $row['added_by'];
				if ($added_by == $user) {
					include ( "./inc/newsfeed.inc.php");
					$getpostsNum++;
				}else {
					$checkDeactiveUser= mysqli_query($con,"SELECT  * FROM users WHERE username = '$added_by'") or die(mysqli_error());
					$checkDeactiveUser_row = mysqli_fetch_assoc($checkDeactiveUser);
					$activeOrNot = $checkDeactiveUser_row ['activated'];
					if ($activeOrNot != '0') {
						$check_if_follow = mysqli_query($con,"SELECT  * FROM follow WHERE (user_from='$user' AND user_to='$added_by ') ORDER BY id DESC LIMIT 2");
						$num_follow_found = mysqli_num_rows($check_if_follow);
						if ($num_follow_found != "") {
							include ( "./inc/newsfeed.inc.php");
							$getpostsNum++;
						}
					}
				}
				
				$newsfeedlastvalue = $row['id'];
				if ($getpostsNum == 10){
					break;
				}
		}
			echo '<li class="newsfeedmore" id="'.$newsfeedlastvalue.'" >Show More</li>';
		}else {
			echo '<li class="nomorepost">Opps! Nothing more found.</li>';
	}
 }
?>