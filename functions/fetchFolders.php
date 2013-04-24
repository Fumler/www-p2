<?php

// Original by okolloen@hig.no, edited for our projects purposes.

header ('Content-type: application/json'); // Return json encoded data

session_start();
require_once 'connect.php';

// Fetches and returns all users who has registered folders
if( isset($_POST[ 'find_users' ])) 
{
	$sql = 'SELECT users.id, uname FROM users, folders where uname=users.id GROUP BY uname ORDER BY uname';
	$sth = $db -> prepare( $sql );
	$sth -> execute();

	die( json_encode ( $sth -> fetchAll() ));   // Outputs the message and ends the script
}

// Return folders for a given user
if( isset($_POST[ 'for_user' ]))
{
	$sql = 'SELECT name, id, uid FROM folders WHERE uid=? AND parent=? ORDER BY name';
	$sth = $db -> prepare ($sql);
	$sth -> execute (array ($_POST[ 'for_users' ], $_POST[ 'id' ]));

	die( json_encode ( $sth -> fetchAll() ));	// Outputs the message and ends the script
}

// no user requested, or no user logged in.
if( !isset($_SESSION[ 'user' ])) 
{
	die( json_encode (array ('error' => 'No user logged on')));
}

// Return folders for the logged in user
$sql = 'SELECT name, id, uid FROM folders WHERE uid=? AND parentid=? ORDER BY name';
$sth = $db -> prepare ($sql);
$sth -> execute (array ($_SESSION[ 'user' ], $_POST[ 'id' ]));

die( json_encode ($sth -> fetchAll() ));
?>