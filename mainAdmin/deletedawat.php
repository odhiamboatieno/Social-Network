<?php 
ob_start();
session_start();
if (!isset($_SESSION['admin_user'])) {
	header('location: login.php');
}
else {
	$user = $_SESSION['admin_user'];

?>
<?php include ( "./inc/connect.inc.php"); ?>
<?php  
if (isset($_REQUEST['dpst'])) {
	$id = $_REQUEST['dpst'];
	//delete from directory
	$get_file = mysqli_query($con,"SELECT  * FROM ShareTime WHERE id='$id'");
	$get_file_name = mysqli_fetch_assoc($get_file);
	$db_filename = $get_file_name['photos'];
	$delete_file = unlink("../userdata/tommy_pics/".$db_filename);

	//delete post
	$result = mysqli_query("DELETE FROM ShareTime WHERE id='$id'");
		header("location: tommy.php");
}
?>

<?php } ?>