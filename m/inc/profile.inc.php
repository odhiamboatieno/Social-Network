<script type="text/javascript">
	function clean (e) {
		var textfield = document.getElementById(e);
		var regex = /fuck/gi;
		textfield.value = textfield.value.replace(regex, "Funny!");
	    }
</script>

<?php 
	//Check whether the user has uploaded a cover pic or not
	$check_pic = mysqli_query($con,"SELECT  cover_pic FROM users WHERE username='$username'");
	$get_pic_row = mysqli_fetch_assoc($check_pic);
	$cover_pic_db = $get_pic_row['cover_pic'];
	//check for cover delete
						$pro_changed = mysqli_query($con,"SELECT  * FROM posts WHERE added_by='$username' AND (discription='updated his cover photo.' OR discription='updated her cover photo.') ORDER BY id DESC LIMIT 1");
						$get_pro_changed = mysqli_fetch_assoc($pro_changed);
		$pro_num = mysqli_num_rows($pro_changed);
		if ($pro_num == 0) {
			$cover_pic= "http://www.ShareTime.com/img/sharetime_defaultcover.png";
		}else {
			$pro_changed_db = $get_pro_changed['photos'];
		if ($pro_changed_db != $cover_pic_db ) {
			$cover_pic= "http://www.ShareTime.com/img/sharetime_defaultcover.png";
		}else {
			$cover_pic= "http://www.ShareTime.com/userdata/profile_pics/".$cover_pic_db ;
		}
		}

	//Check whether the user has uploaded a profile pic or not
	$check_pic = mysqli_query($con,"SELECT  profile_pic FROM users WHERE username='$username'");
	$get_pic_row = mysqli_fetch_assoc($check_pic);
	$profile_pic_db = $get_pic_row['profile_pic'];
						//check for propic delete
						$pro_changed = mysqli_query($con,"SELECT  * FROM posts WHERE added_by='$username' AND (discription='changed his profile picture.' OR discription='changed her profile picture.') ORDER BY id DESC LIMIT 1");
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

	//edit profile
	if (isset($_POST['updateProfile'])) {
		header("location: about.php?u=$username");
	}
	
	//writeposttofrnd
	if (isset($_POST['writeposttofrnd'])) {
		header("location: composepost.php");
	}
	

	//sent messege
	if (isset($_POST['sendmsg'])) {
		header("location: message.php?u=$username");
	}



	//follow request system
	if (@($_POST['follow'])) {
		$if_followed = mysqli_query($con,"SELECT  * FROM follow WHERE user_to='$username' AND user_from='$user'");
		$followed_found = mysqli_num_rows($if_followed);
		if ( $followed_found >= 1 ) {
			header("location: profile.php?u=$username");
		}else{
		$user_from = $user;
		$user_to = $username;
		$create_follow = mysqli_query($con,"INSERT INTO follow VALUES ('', '$user_from', '$user_to', NOW(), 'no')");
		}
	}

	//unfollow request system
	if (@($_POST['unfollow'])) {
		$if_following = mysqli_query($con,"SELECT  * FROM follow WHERE user_to='$username' AND user_from='$user'");
		$following_found = mysqli_num_rows($if_following);
		if ( $following_found >= 1 ) {
			$delete_follow = mysqli_query("DELETE FROM follow WHERE user_from='$user' && user_to='$username' ");
		}else{
			header("location: profile.php?u=$username");
		}
	}
	//unfriend system
	if (@($_POST['unfriend'])) {
		$if_following = mysqli_query($con,"SELECT  * FROM follow WHERE user_to='$username' AND user_from='$user'");
		$following_found = mysqli_num_rows($if_following);
		if ( $following_found >= 1 ) {
			$delete_follow1 = mysqli_query("DELETE FROM follow WHERE user_from='$user' && user_to='$username' ");
			$delete_follow2 = mysqli_query("DELETE FROM follow WHERE user_from='$username' && user_to='$user' ");
		}else{
			header("location: profile.php?u=$username");
		}
	}

	//name query

	$about_query = mysqli_query($con,"SELECT  first_name,verify_id FROM users WHERE username='$username'");
	$get_result = mysqli_fetch_assoc($about_query);
	$first_name_user = $get_result['first_name'];
	$verify_id_user = $get_result['verify_id'];
?>
<div class="blur_back" style= "background: url(<?php echo $cover_pic; ?>) repeat center center;">
	<div style= "height: 60px;"></div>
		<div class="u_profile" style= "background: url(<?php echo $profile_pic; ?>) repeat; background-color: #FFFFFF;"></div></br>
		<div style="margin: 0px auto 20px; text-shadow: 0px 0px 7px rgb(6, 102, 7); text-align: center;">
			<div style="line-height: 1.3;">
				<?php 
					if ($verify_id_user == 'yes') {
						echo '<div><span style="font-size: 23px; font-weight: 800; color: #ffffff" >'.$first_name_user.'</span><span class="verifiedicon" style="background: url(http://www.ShareTime.com/img/verifiLogo.png) repeat; background-size: cover !important;" title="Verified profile"></span></div>';
					}else {
						echo '<span style="font-size: 20px; font-weight: 800; color: #ffffff" >'.$first_name_user.'</span>';
					}
				 ?>
				
			</div>
		</div>
		<div style="margin: 10px;">
			<form action="" method="POST">
				<?php
				if ($user == $username) {
					echo "<button value='button' name='updateProfile' class='frndPokMsg'>Edit Profile</button>";
					echo '<input type="submit" name="writeposttofrnd" style= "float: right;"  class="frndPokMsg" value="Write Post" />';
				}else {
					$check_if_follow = mysqli_query($con,"SELECT  * FROM follow WHERE (user_from='$user' AND user_to='$username') ORDER BY id DESC LIMIT 2");
					$num_follow_found = mysqli_num_rows($check_if_follow);
					if ( $num_follow_found != "" ) {
						$check_if_friend = mysqli_query($con,"SELECT  * FROM follow WHERE (user_from='$username' AND user_to='$user') ORDER BY id DESC LIMIT 2");
						$num_friend_found = mysqli_num_rows($check_if_friend);
						if ( $num_friend_found != "" ) {
							echo '<input type="submit" name="unfriend"  class="frndPokMsg" title="Unfriend '.$first_name_user.'" value="UnFriend" />';
							echo '<input type="submit" name="sendmsg" style= "float: right;"  class="frndPokMsg" value="Message" />';
						}else {
							echo '<input type="submit" name="unfollow"  class="frndPokMsg" title="Unfollow '.$first_name_user.'" value="Following" />';
							echo '<input type="submit" name="sendmsg" style= "float: right;"  class="frndPokMsg" value="Message" />';
						}
						
					}else {
						$if_uname_follow = mysqli_query($con,"SELECT  * FROM follow WHERE (user_from='$username' AND user_to='$user') ORDER BY id DESC LIMIT 2");
						$uname_follow_found = mysqli_num_rows($if_uname_follow);
						if ( $uname_follow_found != "" ) {
							echo '<input type="submit" name="follow"  class="frndPokMsg followsYou" title="Follow back '.$first_name_user.'" value="Follows You" />';
							echo '<input type="submit" name="sendmsg" style= "float: right;"  class="frndPokMsg" value="Message" />';
						}else {
							echo '<input type="submit" name="follow"  class="frndPokMsg" title="follow '.$first_name_user.'" value="Follow" />';
							echo '<input type="submit" name="sendmsg" style= "float: right;"  class="frndPokMsg" value="Message" />';
						}
						}
					
					}
					?>
			</form>
		</div>
</div>