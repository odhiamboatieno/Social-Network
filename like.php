<?php include ( "./inc/connect.inc.php"); ?>
<?php  
ob_start();
session_start();
if (!isset($_SESSION['user_login'])) {
	header('location: signin.php');
}
else {
	$user = $_SESSION['user_login'];
}

//inserting ShareTime  like
if (isset($_REQUEST['did'])) {
	$share_id = $_REQUEST['did'];

	$insertDwtlike = mysqli_query($con,"INSERT INTO share_likes VALUES ('','$user','$share_id')");
	header("location: index.php");
}else {
	header('location: index.php');
}

//deleting ShareTime like
if (isset($_REQUEST['udid'])) {
	$share_uid = $_REQUEST['udid'];

	$del_sharelike = mysqli_query("DELETE FROM share_likes WHERE share_id='$share_uid'");
	header("location: index.php");
}else {
	header('location: index.php');
}
//inserting post like
if (isset($_REQUEST['pid'])) {
	$post_id = $_REQUEST['pid'];

	$insertPostlike = mysqli_query($con,"INSERT INTO post_likes VALUES ('','$user','$post_id')");
	header("location: newsfeed.php");
}else {
	header('location: newsfeed.php');
}

//deleting post like
if (isset($_REQUEST['upid'])) {
	$post_uid = $_REQUEST['upid'];

	$del_postlike = mysqli_query("DELETE FROM post_likes WHERE post_id='$post_uid'");
	header("location: newsfeed.php");
}else {
	header('location: newsfeed.php');
}

?>