<?php 

//check for noti
$check_for_post_noti = mysqli_query($con,"SELECT  * FROM post_comments WHERE posted_to='$user' AND opened='no' ORDER BY id DESC");
$post_noti_num = mysqli_num_rows($check_for_post_noti);
$check_for_ShareTime_noti = mysqli_query($con,"SELECT  * FROM ShareTime_comments WHERE ShareTime_to='$user' AND opened='no' ORDER BY id DESC");
$ShareTime_noti_num = mysqli_num_rows($check_for_ShareTime_noti);
$noti_num = $post_noti_num + $ShareTime_noti_num;

//get msg row
$get_unread_query = mysqli_query($con,"SELECT  opened FROM pvt_messages WHERE user_to='$user' && opened='no'");
$get_unread = mysqli_fetch_assoc($get_unread_query);
$unread_numrows = mysqli_num_rows($get_unread_query);
$unread_msg_numrows = $unread_numrows;

//get follow row
$get_follow_query = mysqli_query($con,"SELECT  opened FROM follow WHERE user_to='$user' && opened='no'");
$get_follow = mysqli_fetch_assoc($get_follow_query );
$follow_numrows = mysqli_num_rows($get_follow_query );
$unread_follow_numrows = $follow_numrows;

//getting user first message
$get_first_message = mysqli_query($con,"SELECT  * FROM pvt_messages WHERE user_to='$user' ORDER BY id DESC LIMIT 1");
$first_message_row = mysqli_fetch_assoc($get_first_message);
$first_message_id = $first_message_row['id'];
$first_message_uname = $first_message_row['user_from'];
if (isset($_POST['gotoinbox'])) {
	$setopened_query = mysqli_query("UPDATE pvt_messages SET opened='yes' WHERE user_to='$user'");
	header("location: messages.php?u=$first_message_uname");
}

//notification 
if (isset($_POST['gotonoti'])) {
	$pstopened_query = mysqli_query("UPDATE post_comments SET opened='yes' WHERE posted_to='$user'");
	
}

//followers
if (isset($_POST['gotofollow'])) {
	$pstopened_query = mysqli_query("UPDATE follow SET opened='yes' WHERE user_to='$user'");
	header("location: followRequest.php");
}


if ($noti_num == "") {
	echo '<li>
	<form method="POST" action="">
	<button type="submit"  name="gotonoti" style="background: none; cursor: pointer; border: none;">
	<img src="./img/noti1.png" style="margin: 13px 30px 13px 2px;" height="22" width="22">
	</button>
	</form>
	</li>';
}else {
	echo '<li>
	<form method="POST" action="">
	<button type="submit"  name="gotonoti" style="background: none; cursor: pointer; border: none;">
	<a href="notifications.php" title="View Notification" style="color: red;">
	<img src="./img/noti2.png" style="margin: -4px;" height="22" width="22">'.$noti_num.'</a>
	</li>';
}
if ($unread_numrows == "") {
	echo '<li>
	<form method="POST" action="">
	<button type="submit"  name="gotoinbox" style="background: none; cursor: pointer; border: none;">
	<img src="./img/msg2.png" style="margin: 6px;" height="35" width="37">
	</button>
	</form>
	</li>';
}else {
	echo '
	<li>
	<form method="POST" action="">
	<button type="submit"  name="gotoinbox" style="background: none; cursor: pointer; border: none;">
	<a href="messages.php"  title="View Messages" style="color: red;">
	<img src="./img/msg3.png" style="margin: -13px;" height="39" width="39">'.$unread_msg_numrows.'</a>
	</button>
	</form>
	</li>';
}

if ($follow_numrows == "") {
	echo '<li>
	<form method="POST" action="">
	<button type="submit"  name="gotofollow" style="background: none; cursor: pointer; border: none;">
	<img src="./img/follow1.png" style="margin: 11px 2px 11px 11px;" height="22" width="22">
	</button>
	</form>
	</li>';
}else {
	echo '
	<li>
	<form method="POST" action="">
	<button type="submit"  name="gotofollow" style="background: none; cursor: pointer; border: none;">
	<a href="followRequest.php"  title="View Follow" style="color: red; margin: 14px;">
	<img src="./img/follow2.png" style="margin: -4px;" height="22" width="22">'.$unread_follow_numrows.'</a>
	</button>
	</form>
	</li>';
}


echo '<li><a href="profile.php?u='.$user.'" title="Go to profile"><img src="'.$profile_pic.'" class="h_propic"  height="30" width="30"></a></li>
<li><a href="newsfeed.php" style=" margin: 17px 0px 17px 17px;" title="Go to newsfeed"><img src="./img/home1.png" style="margin:-5px; padding: 0 5px;" height="22" width="22"></a></li>
</div>';
}









?>