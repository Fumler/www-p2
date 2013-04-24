<?php
global $_SESSION;
	session_start();
	session_destroy();
	//header("Location: login.php");
    echo("logged out");
?>