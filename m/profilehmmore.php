<?php 
 include ( "inc/connect.inc.php");
 
ob_start();
session_start();
if (!isset($_SESSION['user_login'])) {
	header('location: login.php');
}
else {
	$user = $_SESSION['user_login'];
}


 //showmore for profile home post
 $profilehmlastid = $_REQUEST['profilehmlastid'];
 if (isset($profilehmlastid)) {
 	$profilehmlastid = $_REQUEST['profilehmlastid'];
 }else {
 	header("location: index.php");
 }
 if ($profilehmlastid >= 1) {
 			//getting username
		 $result = mysqli_query($con,"SELECT  * FROM posts WHERE id ='$profilehmlastid'") or die(mysqli_error());
		 $name = mysqli_fetch_assoc($result);
		 $profilehm_uname = $name['user_posted_to'];
		//timeline query table
		$getposts = mysqli_query($con,"SELECT  * FROM posts WHERE user_posted_to ='$profilehm_uname' AND note='0' AND report='0' AND ShareTime_give='0' AND id < $profilehmlastid ORDER BY id DESC LIMIT 7") or die(mysqli_error());
		if (mysqli_num_rows($getposts)) {
			while ($row = mysqli_fetch_assoc($getposts)) {
			include ( "./inc/newsfeed.inc.php" );
			$profilehmlastvalue = $row['id'];
		}
			echo '<li class="profilehmmore" id="'.$profilehmlastvalue.'" >Show More</li>';
		}else {
			echo '<li class="nomorepost">Opps! Nothing more found.</li>';
	}
 }
?>