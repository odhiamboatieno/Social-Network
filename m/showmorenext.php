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
 //showmore for ShareTime home post
 $lastid = $_REQUEST['lastid'];
 if (isset($lastid)) {
 	$lastid = $_REQUEST['lastid'];
 }else {
 	header("location: index.php");
 }
  
 if ($lastid >= 1) {
		//timeline query table
		$getposts = mysqli_query($con,"SELECT  * FROM posts WHERE id < $lastid AND ShareTime_give !='0' ORDER BY id DESC LIMIT 7") or die(mysqli_error());
		if (mysqli_num_rows($getposts)) {
			while ($row = mysqli_fetch_assoc($getposts)) {
			include ( "./inc/gettommypost.inc.php" );
			$lastvalue = $row['id'];
		}
			echo '<li class="getmore" id="'.$lastvalue.'" >Show More</li>';
		}else {
			echo '<li class="nomorepost">Opps! Nothing more found.</li>';
	}
 }

?>