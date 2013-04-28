<?php

	header ('Content-type: application/json');

	session_start();
	require_once 'connect.php';

	if( isset ($_SESSION[ 'uid' ])) // if user is logged in, else kill the session. 
	{
		// Create a new page with the new name, parentID, user ID and content consisting of the
		// title of the page. 
		$parentid = $_POST[ 'parentID' ];
		$uid = $_SESSION[ 'uid' ];
		$name = $_POST[ 'name' ];
		$content = "<h1>" . $name . "</h1>";

		$sql = 'INSERT INTO pages (parentid, uid, name, content) VALUES (?, ?, ?, ?)';
		$sth = $db -> prepare( $sql );

		$result = $sth -> execute( array ( $parentid, $uid, $name, $content ));

		if( $result == 0 ) // An error occured, the page was not created. 
		{
			die( json_encode ( array ( 'error' => 'Error during database insertion' )));
		}


		// Retrieve the new page. 
		$sql = 'SELECT id, content FROM pages WHERE uid=? AND parentid=? AND name=?';
		$sth = $db -> prepare( $sql );

		$sth -> execute (array ( $uid, $parentid, $name ));

		// $result = array();
		// while($row = $sth -> fetch( PDO::FETCH_ASSOC ))
		// {
		// 	$result['data'][] = $row;
		// }

		die( json_encode (array ( $sth -> fetchAll() )));
	}

	die (json_encode (array ('error' => 'No user is logged in')));
?>