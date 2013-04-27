<?php
if(session_id()=='') 
{
	session_start();
}
include($_SERVER["DOCUMENT_ROOT"].'/www-p2/functions/connect.php');
include('userFunctions.php');

/**
 * Method to create a new user
 *
 * @param String $uname must be unique for all users
 * @param String $pwd no restrictions on the password
 * @throws Exception if not unique password, if unable to get the id of the new user or if the password can not be changed
 * Only the first should occure.
 */
if (isset($_POST['regUser']) && isset($_POST['regPwd']) && isset($_POST['regConfirmPwd'])) {
    if ($_POST['regPwd'] == $_POST['regConfirmPwd']) {
    	$pwd = $_POST['regPwd'];
    	$uname = $_POST['regUser'];
		try {
			global $db;
			$db->beginTransaction();							// Run in a transaction so that we can do a rollback
			$db->query ('LOCK TABLES users WRITE');			// Prevent others from creating a new user at the same time
			$sql = 'INSERT INTO users (uname) VALUES (:uname)';
			$sth = $db->prepare ($sql);
			$sth->bindParam (':uname', $uname);
			$sth->execute ();
			if ($sth->rowCount()==0) {							// No user created, probably because the user name is not unique
				$db->rollBack();								// Rollback (well, nothing has been done :)
				$db->query ('UNLOCK TABLES');					// Unlock the tables
				throw new Exception('<strong>Oh snap!</strong> User name is taken! Try again.');	// Throw exception
			}
			$sth->closeCursor();									// Prepare to find the id of the new user
			$sth = $db->prepare ('SELECT LAST_INSERT_ID() AS uid');
			$sth->execute();
			if ($row = $sth->fetch())								// uid found
				$uid = $row['uid'];
			else {													// uid not found
				$db->rollBack();								// Rollback, remove the user
				$db->query ('UNLOCK TABLES');
				throw new Exception('<strong>Oh snap!</strong> Something went wrong. Try again.');	// Throw an exception
			}
			$sth->closeCursor ();
			$sql = 'UPDATE users SET pwd=:pwd WHERE uid=:uid';		// Set the password for the new user
			$sth = $db->prepare ($sql);
			$sth->bindParam (':uid', $uid);
			$pwd = $uid.$pwd.getSalt();									// Create the password and create the hash value
			$saltedPw = hash_hmac('sha512', $pwd, getSitekey());
			$sth->bindParam (':pwd', $saltedPw);
			$sth->execute();										// Run the query
			if ($sth->rowCount()==0) {								// No password set
				$db->rollBack();								// Remove the user
				$db->query ('UNLOCK TABLES');
				throw new Exception('<strong>Oh snap!</strong> Something went wrong. Try again.');	// Throw an exception
			}
			$db->commit();
			echo("success");
		} 
		catch(Exception $e) 
		{
				$error = $e->getMessage();
		}
	}
}
?>