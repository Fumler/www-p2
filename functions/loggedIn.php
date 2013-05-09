<?php
	if(session_id()=='') {
    	session_start();
    }
	$profilePage = "pages/profile.php?uid=";

	$uid = $_SESSION['uid'];
	$profilePage = $profilePage . $uid;
	//echo(session_id());

	echo '<li><a href="pages/profile.php?uid='.$uid.'" rel="address:profile">Profile</a></li>';
?>
<li><a href="#" onclick="logout()">Log out</a></li>
