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
	$sharepostid = $_REQUEST['dpst'];
}else {
	header('location: index.php');
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>View Post • ShareTime</title>
	<link rel="stylesheet" type="text/css" href="adminStyle.css">
	<link rel="icon" href="../img/title.png" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="adminStyle.css">
	<link rel="stylesheet" type="text/css" href="../css/header.css">
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

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
	<script type="text/javascript">
		$(function() {
		  $('body').on('keydown', '#post', function(e) {
		    console.log(this.value);
		    if (e.which === 32 &&  e.target.selectionStart === 0) {
		      return false;
		    }  
		  });
		});
	</script>
	<script type="text/javascript">
	function confirm_delete() {
		return confirm('Are you sure want to delete this?');
	}
	</script>
	<script type="text/javascript">
	function confirm_report() {
		return confirm('Are you sure want to report this?');
	}
	</script>
</head>
<body>
<div class="main"><table class="adminHeader">
		<tr>
			<th>
				<a href="index.php"><h1>View Full Post</h1></a>
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
			<th style="background-color: #01093a;"><a href="posts.php"><h1>Post</h1></a></th>
			<th><a href="tommy.php"><h1>ShareTime</h1></a></th>
			<th><a href="report.php"><h1>Report</h1></a></th>
			<th><a href="logout.php"><h1 style="color: #292929;">Logout</h1></a></th>
		</tr>
	</table>
	<div class="rightsidemenu">
		<?php 
		echo "
		<div style='max-width: 960px; margin: 0 auto;'>
			<div class='profilePosts' style= 'margin: 15px auto';>";
			
		//for getting post
		$getposts = mysqli_query($con,"SELECT  * FROM ShareTime WHERE id ='$sharepostid'") or die(mysqli_error());
		while ($row = mysqli_fetch_assoc($getposts)) {
				$id = $row['id'];
				$body = $row['body'];
				$date_added = $row['date_added'];
				$added_by = $row['added_by'];
				$photos_db = $row['photos'];
				$photos = "../userdata/tommy_pics/".$photos_db;
				$get_user_info = mysqli_query($con,"SELECT  * FROM users WHERE username='$added_by'");
				$get_info = mysqli_fetch_assoc($get_user_info);
				$profilepic_info = $get_info['profile_pic'];
				$add_by_fname = $get_info['first_name'];

				//Get Relevant Comments
				$get_comments = mysqli_query($con,"SELECT  * FROM ShareTime_comments WHERE ShareTime_id='$id' ORDER BY id DESC");
				$comment = mysqli_fetch_assoc($get_comments);
				$ShareTime_body = $comment['ShareTime_body'];
				$ShareTime_to = $comment['ShareTime_to'];
				$ShareTime_by = $comment['ShareTime_by'];
				?>

				<?php
				//count comment
				$get_comments = mysqli_query($con,"SELECT  * FROM ShareTime_comments WHERE ShareTime_id='$id' ORDER BY id DESC");
				$count = mysqli_num_rows($get_comments);
				//getting all like
				$get_like = mysqli_query($con,"SELECT  * FROM share_likes WHERE share_id='$id' ORDER BY id DESC");
				$count_like = mysqli_num_rows($get_like);
				//showing data on profile
						echo "<div class='postBody post_search_result_box'>";
							if ($profilepic_info == "") {
									echo "<div style='float: left; margin-left: 10px;'><img src='../img/default_propic.png' style= 'border-radius: 22px'; title=\"$added_by\" height='45' width='45'  /></div>";
							}else {
									echo "<div style='float: left; margin-left: 10px;'><img src='../userdata/profile_pics/$profilepic_info' style= 'border-radius: 22px'; title=\"$added_by\" height='45' width='45'  /></div>";
							}
							echo "<div class='posted_by'><a href='$added_by' title=\"Go to $added_by's Profile\">$add_by_fname</a></div><br /><br />";
							
							echo "<div class='posted_date'>$date_added</div> <br /> 
								<div class='posted_body'>".nl2br($body)."<br> ";
								if ($photos_db == "") {
									//nothing
								}else {
									echo "<img src='$photos' style='max-height: 450px; max-width: 486px; border: 1px solid #ddd;'/>";
								}
								echo "
								</div>
								<br /><hr />
								<div class='likeComShare'>
								<a href='like.php?pid=".$id."' >Like . $count_like</a>";
								echo "<a href=''>Comments ($count)</a>";
								echo "<a onclick='return confirm_delete();' href='deletedawat.php?dpst=".$id."' >Delete</a>";
								echo "</div>
							</div>
							<div class='commentBodyview'>
							<br />
							<iframe src='../tommycomments.php?id=$id' frameborder='0'></iframe>
							</div> <br />";
				}
		 ?>
		 </div>
		 </div>
	</div>
</div>
</body>
</html>
<?php } ?>