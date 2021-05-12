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
?>
<?php 
	$username ="";
	$firstname ="";
	if (isset($_GET['u'])) {
		$username = mysqli_real_escape_string($_GET['u']);
		if (ctype_alnum($username)) {
			//check user exists
			$check = mysqli_query($con,"SELECT  username, first_name FROM users WHERE username='$username'");
			if (mysqli_num_rows($check)===1) {
				$get = mysqli_fetch_assoc($check);
				$username = $get['username'];
				$firstname = $get['first_name'];
			}
			else {
				die();
			}
		}
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $username; ?></title>
	<link rel="icon" href="./img/title.png" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="./css/header.css">
	<script type="text/javascript" src="js/main.js"></script>
</head>
<body>
	<?php include ( "./inc/header.inc.php"); ?>
		<div>
			<div style="width: 560px; margin: 0 auto;">
				<div class="profilePosts">

				<?php
				$getid = $_GET['id'];
				//post update
				$post = htmlspecialchars(@$_POST['post'], ENT_QUOTES);
				if ($post != "") {
					$date_added = date("Y-m-d");
					$added_by = $user;
					$user_posted_to = $username;

					$sqlCommand = $con,"INSERT INTO posts VALUES('', '$post', '$date_added', '$added_by', '$user_posted_to')";
					$query = mysqli_query($sqlCommand) or die (mysqli_error());
				}

				$getposts = mysqli_query($con,"SELECT  * FROM posts WHERE user_posted_to ='$username' ORDER BY id DESC LIMIT 10") or die(mysqli_error());
				while ($row = mysqli_fetch_assoc($getposts)) {
					$id = $row['id'];
					$body = $row['body'];
					$date_added = $row['date_added'];
					$added_by = $row['added_by'];
					$user_posted_to = $row['user_posted_to'];
					$get_user_info = mysqli_query($con,"SELECT  * FROM users WHERE username='$added_by'");
					$get_info = mysqli_fetch_assoc($get_user_info);
					$profilepic_info = $get_info['profile_pic'];

					//Get Relevant Comments
					$get_comments = mysqli_query($con,"SELECT  * FROM post_comments WHERE post_id='$id' ORDER BY id DESC");
					$comment = mysqli_fetch_assoc($get_comments);
					$comment_body = $comment['post_body'];
					$posted_to = $comment['posted_to'];
					$posted_by = $comment['posted_by'];
					$removed = $comment['post_removed'];
					?>
					<script language="javascript">
					function toggle<?php echo $id; ?>() {
						var ele = document.getElementById("toggleComment<?php echo $id; ?>");
						var text = document.getElementById("displayComment<?php echo $id; ?>");
						if (ele.style.display == "block") {
							ele.style.display = "none"
						}else {
							ele.style.display = "block";
						}
					}
					</script>

					<?php
					//count comment
					$get_comments = mysqli_query($con,"SELECT  * FROM post_comments WHERE post_id='$id' ORDER BY id DESC");
					$count = mysqli_num_rows($get_comments);
					//showing data on profile
					if ($profilepic_info == "") {
						echo "<div class='postBody'>
							<div style='float: left; margin-left: 10px;'><img src='img/default_propic.png' style= 'border-radius: 22px'; alt=\"$added_by's Profile\" title=\"$added_by\" height='45' width='45'  /></div>
							<div class='posted_by'><a href='$added_by' title=\"Go to $added_by's Profile\">$added_by</a></div><br /><br />
							<div class='posted_date'>$date_added</div> <br /><br /> 
							<div class='posted_body'>".nl2br($body)."</div>
							<br /><hr />
							<div class='likeComShare'>
							<a href='#'>Like</a>
							<a href='javascript:;' onClick='javascript:toggle$id()'>Comments ($count)</a>
							<a href='#'>More</a>
							</div>
						</div> 
						<div id='toggleComment$id' class='commentBody'>
						<br />
						<iframe src='./comment_frame.php?id=$id 'frameborder='0' style='width: 100%; height: 70%;'></iframe>
						</div> 
						";
					}else {
						echo "<div class='postBody'>
							<div style='float: left; margin-left: 10px;'><img src='userdata/profile_pics/$profilepic_info' style= 'border-radius: 22px'; alt=\"$added_by's Profile\" title=\"$added_by\" height='45' width='45'  /></div>

							<div class='posted_by'><a href='$added_by' title=\"Go to $added_by's Profile\">$added_by</a></div><br /><br />
							<div class='posted_date'>$date_added</div> <br /><br /> 
							<div class='posted_body'>".nl2br($body)."</div>
							<br /><hr />
							<div class='likeComShare'>
							<a href='#'>Like</a>
							<a href='javascript:;' onClick='javascript:toggle$id()'>Comments . $count</a>
							<a href='#'>More</a>
							</div>
						</div> 
						<div id='toggleComment$id' class='commentBody'>
						<br />
						<iframe src='./comment_frame.php?id=$id 'frameborder='0' style='width: 100%; height: 70%;'></iframe>
						</div>
						";
					}
				}

				?>
				</div>
				</br>
			</div>
		</div>
	</div>

	</div>


</body>
</html>
