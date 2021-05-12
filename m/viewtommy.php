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

if (isset($_REQUEST['pid'])) {
	$id = mysqli_real_escape_string($_REQUEST['pid']);
}else {
	header('location: index.php');
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>View ShareTime - ShareTime</title>
	<meta charset="utf-8" />
	<link rel="icon" href="http://www.ShareTime.com/img/title.png" type="image/x-icon">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/style.css">
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
<div class="pro_body">
<div class="pro_header">
	<nav class="pro_hdr_menu">
		<ul>
			<li><a href="index.php">ShareTime</a></li>
			<li><a href="newsfeed.php">Newsfeed</a></li>
			<li><a href="profile.php?u=<?php echo "$user"; ?>">Profile</a></li>
			<li><a href="messages.php">Message</a></li>
			<li> <a href="followRequest.php">Friends</a></li>
			<li> <a href="notification.php">Notification</a></li>
			<li> <a href="search.php">Search</a></li>
		</ul>
	</nav>
</div>
<?php 


echo "
	<div class='profilePosts' style= 'margin: 0 auto';>";
	
//for getting post
$getposts = mysqli_query($con,"SELECT  * FROM ShareTime WHERE id ='$id'") or die(mysqli_error());
$getposts_num = mysqli_num_rows($getposts );
if ($getposts_num == 0) {
	header('location: index.php');
}else {

while ($row = mysqli_fetch_assoc($getposts)) {
		$id = $row['id'];
		$body = $row['body'];
		$date_added = $row['date_added'];
		$added_by = $row['added_by'];
		$photos_db = $row['photos'];
		$photos = "http://www.ShareTime.com/userdata/tommy_pics/".$photos_db;
		$get_posted_to_info = mysqli_query($con,"SELECT  * FROM users WHERE username='$user_posted_to'");
		$get_posted_info = mysqli_fetch_assoc($get_posted_to_info);
		$posted_to_fname = $get_posted_info['first_name'];
		$get_user_info = mysqli_query($con,"SELECT  * FROM users WHERE username='$added_by'");
		$get_info = mysqli_fetch_assoc($get_user_info);
		$profile_pic_db= $get_info['profile_pic'];
		$add_by_fname = $get_info['first_name'];
		
		
			//check for propic delete
						$pro_changed = mysqli_query($con,"SELECT  * FROM posts WHERE added_by='$added_by' AND (discription='changed his profile picture.' OR discription='changed her profile picture.') ORDER BY id DESC LIMIT 1");
						$get_pro_changed = mysqli_fetch_assoc($pro_changed);
		$pro_num = mysqli_num_rows($pro_changed);
		if ($pro_num == 0) {
			$profile_pic = "http://www.ShareTime.com/img/default_propic.png";
		}else {
			$pro_changed_db = $get_pro_changed['photos'];
		if ($pro_changed_db != $profile_pic_db) {
			$profile_pic = "http://www.ShareTime.com/img/default_propic.png";
		}else {
			$profile_pic = "http://www.ShareTime.com/userdata/profile_pics/".$profile_pic_db;
		}
		}

		//Get Relevant Comments
		$get_comments = mysqli_query($con,"SELECT  * FROM ShareTime_comments WHERE ShareTime_id='$id' ORDER BY id DESC");
		$comment = mysqli_fetch_assoc($get_comments);
		$comment_body = $comment['post_body'];
		$posted_to = $comment['posted_to'];
		$posted_by = $comment['posted_by'];
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
				
					
						echo "<div style='margin-left: 10px;'><div class='posted_by'><a href='profile.php?u=$added_by' title=\"Go to $added_by's Profile\">$add_by_fname</a> <span style='color: #9E9E9E; font-weight: normal;'>$discription</span></div>";
						echo "<div class='posted_date'>$date_added</div></div>";

						
						echo "<div class='posted_body' style='padding: 5px 13px 0 10px;'>".nl2br($body)."";

						if ($photos_db == "") {
						}else {
							echo "<a href='viewtommy.php?pid=".$id."'><img src='$photos' style='max-width: 420px; width: 100%; border: 1px solid #ddd;'/></a>";
						}

						echo "
						</div>
						<br />
						<div class='likeComShare'>";
						$like_query = mysqli_query($con,"SELECT  * FROM share_likes WHERE user_name='$user' AND share_id='$id' ORDER BY id DESC LIMIT 1");
						$rows_uname = mysqli_num_rows($like_query);
						if ($rows_uname == 1) {
							echo "<a href='dlikesppl.php?dlikep=".$id."' style='color: #ef8d02;' >Liked ($count_like)</a>";
							echo "<a href='viewtommy.php?pid=".$id."'>Comments ($count)</a>";
						}else if ($user != '') {
							echo "<a href='tommylike.php?did=".$id."' >Like ($count_like)</a>";
							echo "<a href='viewtommy.php?pid=".$id."'>Comments ($count)</a>";
						}else {
							echo "<a href='login.php' >Like ($count_like)</a>";
							echo "<a href='login.php' >Comments ($count)</a>";
						}
						
						if ($added_by == $user) {
									echo "<a onclick='return confirm_delete();' href='deletetommy.php?did=".$id."' >Delete</a>";
								}
						
						echo "</div>
					</div>
					<div class='commentBodyview'>
					<iframe style='width: 100%; height: auto; min-height: 300px;' src='./tommycomments.php?id=$id' frameborder='0'></iframe>
					</div>";
		}
	}
 ?>
 </div>

 </div>
 <div>
			<?php include("./inc/footer.inc.php") ?>
		</div>
</body>
</html>