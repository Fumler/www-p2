<?php 
	// This is done separately from the $user object, since the object is undefined here
	
	$uid = $_POST['uid'];
	$oldPwd = $_POST['oldPwd'];
	$newPwd = $_POST['newPwd'];
	$newPwdR = $_POST['newPwdR'];

	if ($newPwd == $newPwdR) {
		global $user;

		$user->changePassword($oldPwd, $newPwd);
	}
	else {
		echo "derpiderpidum";
	}
?>