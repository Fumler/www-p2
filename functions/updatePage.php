<?php

session_start();
require_once 'connect.php';

if(!empty($_POST['updateContent'])) {
    $sql = 'UPDATE pages SET content=? WHERE id=?';
    $sth = $db->prepare($sql);
    $sth->execute(array($_POST['updateContent'], $_POST['contentPageId']));
    die("success");

}
if(!empty($_POST['privacy'])) {
	$sql = 'UPDATE pages SET privacy=? WHERE id=?';
    $sth = $db->prepare($sql);
    $sth->execute(array($_POST['privacy'], $_POST['contentPageId']));
	die("success");
}
die("failure");

?>
