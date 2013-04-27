<?php

	header ('Content-type: application/json');

	session_start();
	require_once 'connect.php';

	if( !isset ($_SESSION[ 'uid' ]))
	{
		die (json_encode (array ('error' => 'No user is logged in')));
	}

?>