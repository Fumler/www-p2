<?php

// Original by okolloen@hig.no, edited for our projects purposes.

header ('Content-type: application/json'); // Return json encoded data

session_start();
require_once 'connect.php';

// Returns public pages and users attached to those pages
if(isset($_POST['privacy'])) {
	$sql = 'SELECT name, id FROM pages WHERE privacy=?';
	$sth = $db -> prepare ($sql);
	$sth -> execute (array ($_POST[ 'privacy' ]));

	die( json_encode ($sth -> fetchAll() ));
}

// Fetches and returns all users who has registered pages
if( isset($_POST[ 'find_users' ]))
{
	$sql = 'SELECT users.id, uname FROM users, pages where uname=users.id GROUP BY uname ORDER BY uname';
	$sth = $db -> prepare( $sql );
	$sth -> execute();

	die( json_encode ( $sth -> fetchAll() ));   // Outputs the message and ends the script
}

// Return pages for a given user
if( isset($_POST[ 'for_user' ]))
{
	$sql = 'SELECT name, id, uid FROM pages WHERE uid=? AND parent=? ORDER BY name';
	$sth = $db -> prepare ($sql);
	$sth -> execute (array ($_POST[ 'for_users' ], $_POST[ 'id' ]));

	die( json_encode ( $sth -> fetchAll() ));	// Outputs the message and ends the script
}

if( isset($_POST[ 'pageId' ]))
{
	$sql = 'SELECT content, uid, privacy FROM pages WHERE id = ?';
	$sth = $db -> prepare ($sql);
	$sth -> execute (array ($_POST[ 'pageId' ]));

	die( json_encode ($sth -> fetchAll() ));	// Outputs the message and ends the script
}

// no user requested, or no user logged in.
if( isset($_SESSION[ 'uid' ]))
{
	// Return pages for the logged in user
	$sql = 'SELECT name, id, uid FROM pages WHERE uid=? AND parentid=? ORDER BY name';
	$sth = $db -> prepare ($sql);
	$sth -> execute (array ($_SESSION[ 'uid' ], $_POST[ 'id' ]));

	die( json_encode ($sth -> fetchAll() ));
}

die("no query");
?>