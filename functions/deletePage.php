<?php
session_start();
require_once 'connect.php';

if(!empty($_POST['page_id'])) {
    $sql = 'DELETE FROM pages WHERE id=?';
    $sth = $db->prepare($sql);
    $sth->execute(array($_POST['page_id']));
    die($_POST['page_id']);

}
die("No such id!");

?>
