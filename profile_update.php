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
//getting user info
$check_user = mysqli_query($con,"SELECT  * FROM users WHERE username='$user'");
$get_check_user_row = mysqli_fetch_assoc($check_user );
$gender_user_db = $get_check_user_row ['gender'];
?>

<!DOCTYPE html>
<html>
<head>
	<title>Profile Update</title>
	<link rel="icon" href="./img/title.png" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="./css/header.css">
</head>
<body>
<?php include ( "./inc/header.inc.php"); ?>
<?php 
//take the user back
if ($user) {
	if (isset($_POST['no'])) {
		header('Location: profile_update.php');
	}
}else {

}

//define veriable
$error= "";

//Check whether the user has uploaded a cover pic or not
$check_pic = mysqli_query($con,"SELECT  cover_pic FROM users WHERE username='$user'");
$get_pic_row = mysqli_fetch_assoc($check_pic);
$cover_pic_db = $get_pic_row['cover_pic'];
//check for cover delete
						$pro_changed = mysqli_query($con,"SELECT  * FROM posts WHERE added_by='$user' AND (discription='updated his cover photo.' OR discription='updated her cover photo.') ORDER BY id DESC LIMIT 1");
						$get_pro_changed = mysqli_fetch_assoc($pro_changed);
		$pro_num = mysqli_num_rows($pro_changed);
		if ($pro_num == 0) {
			$cover_pic= "img/sharetime_defaultcover.png";
		}else {
			$pro_changed_db = $get_pro_changed['photos'];
		if ($pro_changed_db != $cover_pic_db ) {
			$cover_pic= "img/sharetime_defaultcover.png";
		}else {
			$cover_pic= "userdata/profile_pics/".$cover_pic_db ;
		}
		}
//cover image upload
if (isset($_POST['uploadcov'])) {

	if ($_FILES['coverpic'] == "") {
		$error= "<p class='error_echo'>Please choose a pic!</p>";
	}else {
		//finding file extention
		$profile_pic_name = @$_FILES['coverpic']['name'];
		$file_basename = substr($profile_pic_name, 0, strripos($profile_pic_name, '.'));
		$file_ext = substr($profile_pic_name, strripos($profile_pic_name, '.'));

	if (((@$_FILES['coverpic']['type']=='image/jpeg') || (@$_FILES['coverpic']['type']=='image/png') || (@$_FILES['coverpic']['type']=='image/gif')) && (@$_FILES['coverpic']['size'] < 2000000)) {
		$chare = $user;
		if (file_exists("userdata/profile_pics/$chare")) {
			//nothing
		}else {
			mkdir("userdata/profile_pics/$chare");
		}
		
		
		$filename = strtotime(date('Y-m-d H:i:s')) . $file_ext;

		if (file_exists("userdata/profile_pics/$chare/".@$_FILES["coverpic"]["name"])) {
			echo @$_FILES["coverpic"]["name"]."Already exists";
		}else {
			move_uploaded_file(@$_FILES["coverpic"]["tmp_name"], "userdata/profile_pics/$chare/".$filename);
			//echo "Uploaded and stored in: userdata/profile_pics/$chare/".@$_FILES["coverpic"]["name"];
			
			$date_added = date("Y-m-d");
			$added_by = $user;
			$user_posted_to = $user;
			if ($gender_user_db == 'Male') {
				$discription = "updated his cover photo.";
			}else if ($gender_user_db == 'Female') {
				$discription = "updated her cover photo.";
			}
			
			$photos = "$chare/$filename";
			$sqlCommand = $con,"INSERT INTO posts(date_added,added_by,user_posted_to,discription,photos,newsfeedshow) VALUES('$date_added','$added_by', '$user_posted_to','$discription', '$photos','Male')";
			$query = mysqli_query($sqlCommand) or die (mysqli_error());
			$cover_pic_query = mysqli_query("UPDATE users SET cover_pic='$chare/$filename' WHERE username='$user' ");
			header("Location: profile.php?u=$user");
		}
	}
	else {
		$error= "<p class='error_echo'>Invalid File! Your image must be no larger than 200KB and it must be either a .jpg, .jpeg, .png or .gif</p>";
	}

}
}


//Check whether the user has uploaded a profile pic or not
$check_pic = mysqli_query($con,"SELECT  profile_pic FROM users WHERE username='$user'");
$get_pic_row = mysqli_fetch_assoc($check_pic);
$profile_pic_db = $get_pic_row['profile_pic'];
						//check for propic delete
						$pro_changed = mysqli_query($con,"SELECT  * FROM posts WHERE added_by='$user' AND (discription='changed his profile picture.' OR discription='changed her profile picture.') ORDER BY id DESC LIMIT 1");
						$get_pro_changed = mysqli_fetch_assoc($pro_changed);
		$pro_num = mysqli_num_rows($pro_changed);
		if ($pro_num == 0) {
			$profile_pic = "img/default_propic.png";
		}else {
			$pro_changed_db = $get_pro_changed['photos'];
		if ($pro_changed_db != $profile_pic_db) {
			$profile_pic = "img/default_propic.png";
		}else {
			$profile_pic = "userdata/profile_pics/".$profile_pic_db;
		}
		}
//Profile image upload
if (isset($_POST['uploadpro'])) {
	if ($_FILES['profilepic'] == "") {
		$error= "<p class='error_echo'>Please choose a pic!</p>";
	}else {
		//finding file extention
		$profile_pic_name = @$_FILES['profilepic']['name'];
		$file_basename = substr($profile_pic_name, 0, strripos($profile_pic_name, '.'));
		$file_ext = substr($profile_pic_name, strripos($profile_pic_name, '.'));

	if (((@$_FILES['profilepic']['type']=='image/jpeg') || (@$_FILES['profilepic']['type']=='image/png') || (@$_FILES['profilepic']['type']=='image/gif')) && (@$_FILES['profilepic']['size'] < 2000000)) {
		$chare = $user;
		if (file_exists("userdata/profile_pics/$chare")) {
			//nothing
		}else {
			mkdir("userdata/profile_pics/$chare");
		}
		
		
		$filename = strtotime(date('Y-m-d H:i:s')) . $file_ext;

		if (file_exists("userdata/profile_pics/$chare/".$filename)) {
			echo @$_FILES["profilepic"]["name"]."Already exists";
		}else {
			move_uploaded_file(@$_FILES["profilepic"]["tmp_name"], "userdata/profile_pics/$chare/".$filename);
			//echo "Uploaded and stored in: userdata/profile_pics/$chare/".@$_FILES["profilepic"]["name"];
			
			$date_added = date("Y-m-d");
			$added_by = $user;
			$user_posted_to = $user;
			if ($gender_user_db == 'Male') {
				$discription = "changed his profile picture.";
			}else if ($gender_user_db == 'Female') {
				$discription = "changed her profile picture.";
			}
			
			$photos = "$chare/$filename";
			$sqlCommand = $con,"INSERT INTO posts(date_added,added_by,user_posted_to,discription,photos,newsfeedshow) VALUES('$date_added','$added_by', '$user_posted_to','$discription', '$photos','Male')";
			$query = mysqli_query($sqlCommand) or die (mysqli_error());
			$profile_pic_query = mysqli_query("UPDATE users SET profile_pic='$chare/$filename' WHERE username='$user' ");
			header("Location: profile.php?u=$user");
		}
	}
	else {
		$error= "<p class='error_echo'>Invalid File! Your image must be no larger than 200KB and it must be either a .jpg, .jpeg, .png or .gif</p>";
	}
}

}
?>
<div style="margin-top: 48px;">
<div style="width: 900px; margin: 0 auto;">
	<ul>
		<li><div><?php echo $error; ?></div></li>
		<li style="float: left;">
			<div class="settingsleftcontent">
				<ul>
					<li><a href="profile_update.php" style="background-color: #ef8d02; border-radius: 3px; color: #fff;">Profile Update</a></li>
					<li><a href="account_update.php">Account</a></li>
					<li><a href="password_update.php">Password</a></li>
					<li><a href="workedu_update.php">Work and Education</a></li>
					<li><a href="cbinfo_update.php">Contact and Basic Info</a></li>
					<li><a href="location_update.php">Location and Places</a></li>
					<li><a href="details_update.php">Details About</a></li>
				</ul>
			</div>
			<div class="settingsleftcontent">
				<?php include './inc/profilefooter.inc.php'; ?>
			</div>
		</li>
		<li style="float: right;">
			<div class="uiaccountstyle">
			<h2><p>Upload Your Profile Photo</p></h2>
			<form action="" method="POST" enctype="multipart/form-data">
				<img src="<?php echo $profile_pic; ?>" width="82"></br>
				<input type="file" name="profilepic" class="placeholder" ></br></br>
				<h2><p style="font-style: italic; font-size: 13px">Allowed Extensions: *jpg *jpeg *png *gif</p></h2></br></br>
				<input type="submit" name="uploadpro" title="Update profile photo" class="confirmSubmit" value="Upload Image">&nbsp;&nbsp;
				<input type="submit" name="no" value="Cancel" title="Cancel" class="cancelSubmit"> </br>
			</form>
			</div>
			<div class="uiaccountstyle">
			<h2><p>Upload Your Cover Photo</p></h2>
				<form action="" method="POST" enctype="multipart/form-data">
					<img src="<?php echo $cover_pic; ?>" width="110" height="55" ></br>
					<input type="file" class="placeholder" name="coverpic"></br></br>
					<h2><p style="font-style: italic; font-size: 13px">Allowed Extensions: *jpg *jpeg *png *gif</p></h2></br></br>
					<input type="submit" name="uploadcov" class="confirmSubmit" title="Upload cover photo" value="Upload Image">&nbsp;&nbsp;
					<input type="submit" name="no" value="Cancel" title="Cancel" class="cancelSubmit"> </br>
				</form>
			</div>
		</li>
	</ul>
</div>
</div>
</body>
</html>