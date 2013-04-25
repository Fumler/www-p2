<?php 
	$profilePage = "pages/profile.php?uid=";

	$uid = $_SESSION['uid'];
	$profilePage = $profilePage . $uid;


	echo '<li><a href="#" onclick="ajaxGet(\'' . $profilePage . '\', \'content\')">Profile</a></li>';
?>
<li><a href="#" onclick="logout()">Log out</a></li>'