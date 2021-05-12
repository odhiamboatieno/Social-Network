<?php include ( "./inc/connect.inc.php"); ?>
<?php  
ob_start();
session_start();
if (!isset($_SESSION['user_login'])) {
	header('location: login.php');
}
else {
	$user = $_SESSION['user_login'];
}

if (isset($_REQUEST['did'])) {
	$id = $_REQUEST['did'];
	//delete from directory
	$get_file = mysqli_query($con,"SELECT  * FROM ShareTime WHERE id='$id'");
	$get_file_name = mysqli_fetch_assoc($get_file);
	$db_filename = $get_file_name['photos'];
	$db_user_name = $get_file_name['added_by'];
	if($db_user_name == $user) {
		$delete_file = unlink("http://www.ShareTime.com/userdata/tommy_pics/".$db_filename);
		//delete post
		$result1 = mysqli_query("DELETE FROM share_likes WHERE share_id='$id'");
		$result = mysqli_query("DELETE FROM ShareTime WHERE id='$id'");
		header("location: index.php");
	}else {
		header("location: index.php");
	}
	
}else {
	header('location: index.php');
}

?>