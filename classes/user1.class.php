<?php
if(session_id()=='') 
{
	session_start();
}
include($_SERVER["DOCUMENT_ROOT"].'/www-p2/functions/connect.php');

/**
 * This class handles all user handling operations, login state, login/logout, new user creation, changing password.
 * This class also provides login status, and for logged in users you can query userid and username.
 *
 * @author oivindk
 *
 */
/**
 * Constructor for the class, handles login/logout and carry forward of login status.
 * Uses global variables _POST and _SESSION, reads uname/pwd from _POST and writes uid to _SESSION
 */
global $_POST, $_SESSION, $db;

// $this->db = $db;										// Store a reference to the database handler
if (isset ($_POST['uname']))
{														// Try to log in
	$_SESSION['uname'] = $_POST['uname'];
	$sql = 'SELECT * FROM users WHERE uname=:uname';
	$sth = $db->prepare ($sql);
	$sth->bindParam (':uname', $_SESSION['uname']);
	$sth->execute ();

	if ($row = $sth->fetch()) // User name found, we can check the password
	{
		$uid = $row['uid'];
		$sth->closeCursor();
		$sql = 'SELECT * FROM users WHERE uid=:uid AND pwd=:pwd';
		$sth = $db->prepare ($sql);
		$sth->bindParam (':uid', $uid);
		$pwd = $uid.$_POST['pwd'].SALT;					// Create password with uid and SALT value
		// Show possible hash algorithms
		// print_r(hash_algos());
		// Output the hash value, usefull for debuging
		// echo hash_hmac('sha512', $pwd, SITEKEY);

		$hash = hash_hmac('sha512', $pwd, SITEKEY);
		//echo $hash;

		if(isset($_POST['remember']) && $_POST['uname'] == $_COOKIE['uname'])
		{
			if(isset($_COOKIE['pwd']))
			{
				$hash = $_COOKIE['pwd'];
			}
		}												// Password stored as sha512 hash

		$sth->bindParam (':pwd', $hash);
		$sth->execute ();



		if ($row = $sth->fetch())  // Password found, set _SESSION value
		{
			$hour = time() + (60 * 60); // 2 weeks
			$_SESSION['uid'] = $row['uid'];

			if(isset($_POST['remember']))
			{
				$_POST['remember'] = (int)$_POST['remember'];
				$_SESSION['remember'] = $_POST['remember'];
				setcookie('uname', $_POST['uname'], $hour);
				setcookie('pwd', $hash, $hour);
				setcookie('blogRemember', $_POST['uname'], $hour * 24 * 7 * 52); // year..
			}
			else
			{
				if(isset($_COOKIE['blogRemember']))
				{
					$past = time() - 100;
					setcookie(blogRemember, gone, $past);
				}
			}
			echo("login");
			return;
		}
	}
	$this->error = '<strong>Oh snap!</strong> Your username or password seems to be wrong, try again.';			// Display error message on login form
} else if (isset ($_POST['logout'])) {					// Log out
	unset ($_SESSION['uid']);
} else if (isset ($_SESSION['uid'])) {					// A user is logged in, find the username
	$_SESSION['uid'];
	$sql = 'SELECT * FROM users WHERE uid=:uid';
	$sth = $db->prepare ($sql);
	$sth->bindParam (':uid', $_SESSION['uid']);
	$sth->execute ();
	$row = $sth->fetch();
	$_SESSION['uname'] = $row['uname'];
}

?>