<?php 
	$uid 	= $_POST['uid'];
	$fname 	= $_POST['fname'];
	$lname 	= $_POST['lname'];
	$email 	= $_POST['email'];

	$user->updateUser($uid, $fname, $lname, $email);

	/*
	require_once('connect.php');

	// Prepare SQL statement
	$sql = 'UPDATE users SET fname=:fname, lname=:lname, email=:email WHERE uid=:uid';
	$sth = $db->prepare($sql);
	$sth->bindParam(':uid', $uid);
	$sth->bindParam(':fname', $fname);
	$sth->bindParam(':lname', $lname);
	$sth->bindParam(':email', $email);
	$sth->execute();

	if ($sth->rowCount() == 0) {
		throw new Exception('Query failed');
	}
	else {
		echo "success";
	}

	$sth->closeCursor();*/
?>