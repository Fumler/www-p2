<?php
	try {
	$indexDb = new PDO('mysql:host=localhost;dbname=pages;charset=UTF8', $_SERVER['DBUSER'], $_SERVER['DBPASS']);
	$db = $indexDb;
	} catch (PDOException $e) {
	    print "Error!: " . $e->getMessage() . "<br/>";
	    die();
	}

    //require_once($_SERVER["DOCUMENT_ROOT"].'/www-p2/classes/user1.class.php');
?>