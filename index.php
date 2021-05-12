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
/*
//user location
$user_ip = getenv('REMOTE_ADDR');
$geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$user_ip"));
$city = $geo["geoplugin_city"];
$region = $geo["geoplugin_regionName"];
$country = $geo["geoplugin_countryName"];
*/
//update online time
$sql = mysqli_query($con,"UPDATE users SET chatOnlineTime=now() WHERE username='$user'");

$username ="";
if (isset($_GET['u'])) {
	$username = mysqli_real_escape_string($_GET['u']);
	if (ctype_alnum($username)) {
		//check user exists
		$check = mysqli_query($con,"SELECT  username, first_name FROM users WHERE username='$username'");
		if (mysqli_num_rows($check)===1) {
			$get = mysqli_fetch_assoc($check);
			$username = $get['username'];
		}
		else {
			die();
		}
	}
}

//Check whether the user has uploaded a cover pic or not
$check_pic = mysqli_query($con,"SELECT  cover_pic FROM users WHERE username='$user'");
$get_pic_row = mysqli_fetch_assoc($check_pic);
$cover_pic_db = $get_pic_row['cover_pic'];
//check for userfrom propic delete
						$pro_changed = mysqli_query($con,"SELECT  * FROM posts WHERE added_by='$user' AND (discription='updated his cover photo.' OR discription='updated her cover photo.') ORDER BY id DESC LIMIT 1");
						$get_pro_changed = mysqli_fetch_assoc($pro_changed);
		$pro_num = mysqli_num_rows($pro_changed);
		if ($pro_num == 0) {
			$cover_pic= "img/sharetime_defaultcover.png";
		}else {
			$pro_changed_db = $get_pro_changed['photos'];
		if ($pro_changed_db != $cover_pic_db ) {
			$cover_pic= "img/default_propic.png";
		}else {
			$cover_pic= "userdata/profile_pics/".$cover_pic_db ;
		}
		}

//Check whether the user has uploaded a profile pic or not
$check_pic = mysqli_query($con,"SELECT  profile_pic FROM users WHERE username='$user'");
$get_pic_row = mysqli_fetch_assoc($check_pic);
$profile_pic_db = $get_pic_row['profile_pic'];
//check for userfrom propic delete
						$pro_changed = mysqli_query($con,"SELECT  * FROM posts WHERE added_by='$user' AND (discription='changed his profile picture.' OR discription='changed her profile picture.') ORDER BY id DESC LIMIT 1");
						$get_pro_changed = mysqli_fetch_assoc($pro_changed);
		$pro_num = mysqli_num_rows($pro_changed);
		if ($pro_num == 0) {
			$profile_pic= "img/default_propic.png";
		}else {
			$pro_changed_db = $get_pro_changed['photos'];
		if ($pro_changed_db != $profile_pic_db ) {
			$profile_pic= "img/default_propic.png";
		}else {
			$profile_pic= "userdata/profile_pics/".$profile_pic_db ;
		}
		}

//name query
$about_query = mysqli_query($con,"SELECT  first_name FROM users WHERE username='$user'");
$get_result = mysqli_fetch_assoc($about_query);
$first_name_user = $get_result['first_name'];


?>

<!DOCTYPE html>
<html>
<head>
	<title>ShareTime</title>
	<link rel="icon" href="./img/title.png" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="./css/header.css">
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
	<script>
		if(/Android|webOS|iPhone|iPad|iPod|BlackBerry/IEMobile/i.test(navigator.userAgent)){
		if(document.URL !="http://sharetime.epizy.com")
		{
		window.location ="http://sharetime.epizy.com";
		}
		}
	</script>
	<script type="text/javascript">
		  <!--
		  if (screen.width <= 800) {
		    window.location = "http://sharetime.epizy.com/login.php";
		  }
		  //-->
		</script>
</head>
<body>
	<?php include ( "./inc/header.inc.php" ); ?>
		<div style="width: 900px; margin: 52px auto;">
			<div style="float: left;">
				<div class="homeLeftSideContent" >
					<div class="home_cov" style= "background: url(<?php echo $cover_pic; ?>) repeat center center;">
						<div style="float: left;">
							<img src="<?php echo $profile_pic; ?>" height="70" width="70" style="border-radius: 40px; margin: 20px 0 0 10px;border: 2px solid #fff;" />
						</div>
						<div class="home_cov_data">
							<a href="profile_update.php" class="home_cov_nm" >Edit your profile</a><br>
						</div><br>
						<div class="homenavemanu">
							<div >
								<div ><a href="index.php" style="color: #06228e">ShareTime</a></div>
								<div ><a href="newsfeed.php">Newsfeed</a></div>
								<div ><a href="profile.php?u=<?php echo $user; ?>">Me</a></div>
							</div>
						</div>
					</div>
				</div>
				<div class="settingsleftcontent" style="width: 301px;  margin-top: 15px;">
					<?php include './inc/profilefooter.inc.php'; ?>

				</div>
			</div>
			<div style="float: right;">
				<div class="postForm">
					<form action="" method="POST">
						<textarea type="text" id="post" name="post" onkeyup="clean("post")" onkeydown="clean("post")" rows="4" cols="58"  class="postForm_text" placeholder="What you are thinking..."></textarea>
						<input type="submit" name="send" value="ShareTime" class="postSubmit" >
					</form>
				</div>
				<div class="profilePosts">
					<?php
					//post update
					//$post = $_POST['post'];
					$post = isset($_POST['post']) ? $_POST['post'] : '';
					$post =  trim($post);
					$post = mysqli_real_escape_string($post);

					if ($post != "") {
						$date_added = date("Y-m-d");
						$added_by = $user;
						$user_posted_to = $user;
						$sqlCommand = "INSERT INTO posts(ShareTime_body,date_added,added_by,user_posted_to,ShareTime_give) VALUES('$post', '$date_added','$added_by', '$user_posted_to','1')";
						$query = mysqli_query($sqlCommand) or die (mysqli_error());
						header("Location: index.php");
					}

					//timeline query table
					$lastid = "";
					$getposts = mysqli_query($con,"SELECT  * FROM posts WHERE ShareTime_give !='0' ORDER BY id DESC LIMIT 10") or die(mysqli_error());
					if (mysqli_num_rows($getposts)) {
					echo '<ul id="recs">';
					while ($row = mysqli_fetch_assoc($getposts)) {
						include ( "./inc/newsfeed.inc.php" );
						$lastid = $row['id'];
					}
					echo '<li class="getmore" id="'.$lastid.'" >Show More</li>';
					echo '</ul>';
					}
					echo '
			</div>
		</br>
	</div>
</div>
</div>
</div>
</div>';
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('.getmore').live('click',function() {
				var lastid = $(this).attr('id');
				$.ajax({
					type: 'GET',
					url: 'showmorenext.php',
					data: 'lastid='+lastid,
					beforeSend: function() {
						$('.getmore').html('Loading....');
					},
					success: function(data) {
						$('.getmore').remove();
						$('#recs').append(data);
					}
				});
			});
		});
	</script>
</body>
</html>
