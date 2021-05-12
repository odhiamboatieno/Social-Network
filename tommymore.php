<?php 
 include ( "inc/connect.inc.php");
ob_start();
session_start();
if (!isset($_SESSION['user_login'])) {
	header('location: signin.php');
}
else {
	$user = $_SESSION['user_login'];
}
 //showmore for profile home post
 $ShareTimehmlastid = $_REQUEST['ShareTimehmlastid'];
 if (isset($ShareTimehmlastid)) {
 	$ShareTimehmlastid = $_REQUEST['ShareTimehmlastid'];
 }else {
 	header("location: index.php");
 }
 if ($ShareTimehmlastid >= 1) {
 			//getting username
		 $result = mysqli_query($con,"SELECT  * FROM posts WHERE id ='$ShareTimehmlastid'") or die(mysqli_error());
		 $name = mysqli_fetch_assoc($result);
		 $username = $name['added_by'];
		//timeline query table
		$getposts = mysqli_query($con,"SELECT  * FROM ShareTime WHERE added_by ='$username' AND ShareTime_give !='0' AND id < $ShareTimehmlastid ORDER BY id DESC LIMIT 7") or die(mysqli_error());
		if (mysqli_num_rows($getposts)) {
			while ($row = mysqli_fetch_assoc($getposts)) {
			include ( "./inc/newsfeed.inc.php" );
			$ShareTimehmlastvalue = $row['id'];
		}
			echo '<br><li class="getmore" id="'.$ShareTimehmlastvalue.'" >Show More</li>';
		}else {
			echo '<li class="nomorepost">Opps! Nothing more found.</li>';
	}
 }
?>