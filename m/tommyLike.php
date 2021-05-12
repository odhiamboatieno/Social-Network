<?php include ( "./inc/connect.inc.php"); ?>
<?php  
ob_start();
session_start();
if (!isset($_SESSION['user_login'])) {
	header('location: login.php');
}
else {
	$user = $_SESSION['user_login'];
	
	//inserting ShareTime  like
	if (isset($_REQUEST['did'])) {
		$share_id = $_REQUEST['did'];
	
		$insertDwtlike = mysqli_query($con,"INSERT INTO share_likes VALUES ('','$user','$share_id')");
		header("location: index.php");
	}else {
		header('location: index.php');
	}
}

?>