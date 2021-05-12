<?php
$con=mysqli_connect("localhost", "root", "", "ShareTime");
if(mysqli_connect_errno()){
echo "Connection Fail".mysqli_connect_error(); }
//time formate

function formatDate($date){
	return date('F j, Y, g:i a', strtotime($date));
}
 ?>
