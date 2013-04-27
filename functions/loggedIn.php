<?php 
	if(session_id()=='') {
    	session_start();
    }
	$profilePage = "pages/profile.php?uid=";

	$uid = $_SESSION['uid'];
	$profilePage = $profilePage . $uid;
	//echo(session_id());

	echo '<li><a href="#" onclick="ajaxGet(\'' . $profilePage . '\', \'content\')">Profile</a></li>';
?>
<li><a href="#" onclick="logout()">Log out</a></li>'