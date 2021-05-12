<?php 
mysqli_connect("localhost","ShareTimeco_td","sinEmi4334222") or die("Couldn't connet to SQL server");
mysqli_select_db("ShareTimeco_td") or die("Couldn't select DB");

//time formate
function formatDate($date){
	return date('g:i a', strtotime($date));
}

?>