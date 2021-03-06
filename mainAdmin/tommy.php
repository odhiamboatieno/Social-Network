<?php 
ob_start();
session_start();
if (!isset($_SESSION['admin_user'])) {
	header('location: login.php');
}
else {
	$user = $_SESSION['admin_user'];

?>
<!DOCTYPE html>
<html>
<head>
	<title>All ShareTime Post</title>
	<link rel="icon" href="../img/title.png" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="adminStyle.css">
	<link rel="stylesheet" type="text/css" href="../css/header.css">
	<script type="text/javascript" src="./js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript">
		$(function() {
		  $('body').on('keydown', '#search', function(e) {
		    console.log(this.value);
		    if (e.which === 32 &&  e.target.selectionStart === 0) {
		      return false;
		    }  
		  });
		});
	</script>
</head>
<body>
<div class="main">
	<table class="adminHeader">
		<tr>
			<th>
				<a href="index.php"><h1>ShareTime Post</h1></a>
			</th>
			<th class="search">
				<form action="search.php" method="get">
					<input type="text" id="search" name="keywords" placeholder="Search Here..."  />
					<select name="topic" class="search_topic">
						<option>User</option>
						<option>Post</option>
						<option>ShareTime</option>
					</select>
					<button type="submit" name="search" ><img src="../img/search.png" style="margin: 0 0 -12px 1px; padding: 0;" height="33" width="33"></button>
				</form>
			</th>
		</tr>
	</table>
	<table class="adminmenu">
		<tr>
			<th><a href="users.php"><h1>User</h1></a></th>
			<th><a href="posts.php"><h1>Post</h1></a></th>
			<th style="background-color: #01093a;"><a href="tommy.php" ><h1>ShareTime</h1></a></th>
			<th><a href="report.php"><h1>Report</h1></a></th>
			<th><a href="logout.php"><h1 style="color: #292929;">Logout</h1></a></th>
		</tr>
	</table>
	<table class="rightsidemenu">
		<tr style="font-weight: bold;" colspan="10" bgcolor="#18057d">
			<th>Id</th>
			<th>Body</th>
			<th>Date</th>
			<th>Added By</th>
			<th>View Post</th>
		</tr>
		<tr>
			<?php include ( "./inc/connect.inc.php");
			$query = $con,"SELECT  * FROM sharetime ORDER BY id DESC LIMIT 15";
			$run = mysqli_query($query);
			while ($row=mysqli_fetch_assoc($run)) {
				$id = $row['id'];
				$body = substr($row['body'], 0,50);
				$date_added = $row['date_added'];
				$added_by = $row['added_by'];
			
			 ?>
			<th><?php echo $id; ?></th>
			<th style="text-align: left;"><?php echo $body; ?></th>
			<th><?php echo $date_added; ?></th>
			<th><?php echo $added_by; ?></th>
			<th class="editpost"><a href="viewShareTimePost.php?dpst=<?php echo $id; ?>">View</a></th>
		</tr>
		<?php } ?>
	</table>
</div>
</body>
</html>
<?php } ?>