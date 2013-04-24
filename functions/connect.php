<?php 
	try {
	$indexDb = new PDO('mysql:host=localhost;dbname=pages;charset=UTF8', $_SERVER['DBUSER'], $_SERVER['DBPASS']);
	$db = $indexDb;
	} catch (PDOException $e) {
	    print "Error!: " . $e->getMessage() . "<br/>";
	    die();
	}
?> 