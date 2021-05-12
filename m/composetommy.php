<?php include ( "./inc/connect.inc.php" ); ?>
<?php  
ob_start();
session_start();
if (!isset($_SESSION['user_login'])) {
	header('location: signin.php');
}
else {
	$user = $_SESSION['user_login'];
}



$photoLocat = 'http://www.ShareTime.com';
?>
<?php 
//Check whether the user has uploaded a profile pic or not
$check_pic = mysqli_query($con,"SELECT  profile_pic FROM users WHERE username='$user'");
$get_pic_row = mysqli_fetch_assoc($check_pic);
$profile_pic_db = $get_pic_row['profile_pic'];
//check for userfrom propic delete
						$pro_changed = mysqli_query($con,"SELECT  * FROM posts WHERE added_by='$user' AND (discription='changed his profile picture.' OR discription='changed her profile picture.') ORDER BY id DESC LIMIT 1");
						$get_pro_changed = mysqli_fetch_assoc($pro_changed);
		$pro_num = mysqli_num_rows($pro_changed);
		if ($pro_num == 0) {
			$profile_pic= $photoLocat."/img/default_propic.png";
		}else {
			$pro_changed_db = $get_pro_changed['photos'];
		if ($pro_changed_db != $profile_pic_db ) {
			$profile_pic= $photoLocat."/img/default_propic.png";
		}else {
			$profile_pic= $photoLocat."/userdata/profile_pics/".$profile_pic_db ;
		}
		}

 ?>

 <?php 
	//ShareTime update and file check
	$error = "";
	$ShareTime = "";
	$ShareTime = $_POST['ShareTime'];
	$ShareTime = trim($ShareTime);
	$ShareTime = mysqli_real_escape_string($ShareTime);
	$pic = @$_FILES['uploadFile'];
	if ($pic != "") {
		if (isset($_FILES['uploadFile'])) {
			//finding file extention
			$profile_pic_name = @$_FILES['uploadFile']['name'];
			$file_basename = substr($profile_pic_name, 0, strripos($profile_pic_name, '.'));
			$file_ext = substr($profile_pic_name, strripos($profile_pic_name, '.'));

		if (((@$_FILES['uploadFile']['type']=='image/jpeg') || (@$_FILES['uploadFile']['type']=='image/png') || (@$_FILES['uploadFile']['type']=='image/gif')) && (@$_FILES['uploadFile']['size'] < 200000)) {
			$chare = $user;
			if (file_exists($photoLocat."/userdata/profile_pics/$chare")) {
				//nothing
			}else {
				mkdir($photoLocat."/userdata/profile_pics/$chare");
			}
			
			
			$filename = strtotime(date('Y-m-d H:i:s')) . $file_ext;

			if (file_exists($photoLocat."/userdata/profile_pics/$chare/".@$_FILES["uploadFile"]["name"])) {
				echo @$_FILES["uploadFile"]["name"]."Already exists";
			}else {
				$target_file = $photoLocat."/userdata/profile_pics/$chare/".$filename;
				move_uploaded_file(@$_FILES["uploadFile"]["tmp_name"], $target_file);
				
				$date_added = date("Y-m-d");
				$added_by = $user;
				$user_posted_to = $user;
				$photos = "$chare/$filename";
				$sqlCommand = $con,"INSERT INTO posts(ShareTime_body,date_added,added_by,user_posted_to,photos,ShareTime_give) VALUES('$ShareTime', '$date_added','$added_by', '$user_posted_to','$photos','1')";
				$query = mysqli_query($sqlCommand) or die (mysqli_error());
				header("Location: index.php");
				}
			}else if ($ShareTime != "") {
				$date_added = date("Y-m-d");
				$added_by = $user;
				$user_posted_to = $user;
				$sqlCommand = $con,"INSERT INTO posts(ShareTime_body,date_added,added_by,user_posted_to,ShareTime_give) VALUES('$ShareTime', '$date_added','$added_by', '$user_posted_to','1')";
				$query = mysqli_query($sqlCommand) or die (mysqli_error());
				header("Location: index.php");
			}
			else if ($ShareTime == "") {
			$error= "<p class='error_echo'>Please write your post!</p>";
			}else {
			$error= "<p class='error_echo'>Invalid File! Your image must be no larger than 200KB.</p>";
			}
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>ShareTime</title>
	<meta charset="utf-8" />
	<link rel="icon" href="http://www.ShareTime.com/img/title.png" type="image/x-icon">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript" src="js/main.js"></script>
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
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
					<li><a href="followRequest.php">Friends</a></li>
					<li><a href="notification.php">Notification</a></li>
					<li><a href="search.php">Search</a></li>
				</ul>
			</nav>
		</div>
		<?php echo $error; ?>
		<div class="post_field" style="padding: 10px;">
		<table style="width: 100%;">
			<tbody>
				<form action="" method="POST"  enctype='multipart/form-data'>
					<tr style="margin-right: 10px;">
							<td>
								<div class="">
									<textarea type="text" id="post" name="ShareTime" onkeyup="clean("post")" onkeydown="clean("post")" class="WpostForm_text" placeholder="What you are thinking..."></textarea>

								</div>
							</td>
					</tr>
					<tr>
					<table style="width: 100%;">
						<td style="float: left; padding: 14px 0px;">
							<input id='uploadFile' value="Photo" style="width: 150px;" type='file' name='uploadFile' >
						</td>
						<td>
							<input type='submit' name='uploadpic' value='ShareTime' class='WpostSubmit' >
						</td>
					</table>
					</tr>
				</form>
			</tbody>
		</table>
		</div>

</div>
</body>
</html>
