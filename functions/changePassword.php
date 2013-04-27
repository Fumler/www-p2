<?php 
	require_once('../classes/userFunctions.php');

	$SALT = getSalt();
	$SITEKEY = getSitekey();

	$uid 	= $_POST['uid'];
	$oldpwd = $_POST['oldPwd'];
	$pwd 	= $_POST['newPwd'];
	$pwdR 	= $_POST['newPwdR'];

	require_once('connect.php');

	if ($pwdR === $pwd) {
		$sql = 'UPDATE users SET pwd=:pwd WHERE uid=:uid AND pwd=:oldpwd';
		$sth = $db->prepare ($sql);

		$sth->bindParam (':uid', $uid);	

		$pwd = $uid.$pwd.$SALT;
		$sth->bindParam ('pwd', hash_hmac('sha512', $pwd, $SITEKEY));

		$oldpwd = $uid.$oldpwd.$SALT;
		$sth->bindParam ('oldpwd', hash_hmac('sha512', $oldpwd, $SITEKEY));

		$sth->execute ();

		if ($sth->rowCount()==0) {
			throw new Exception ('Unable to change password');
			echo "noChange";
		}
		else {
			echo "success";
		}

		$sth->closeCursor();	
	}
	else {
		throw new Exception('Passwords don\'t match');
		echo "noMatch";
	}
?>