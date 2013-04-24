<?php 
require_once('connect.php');

function getUser($uid) { // gets info about a specific user
    global $db;
    $sql = 'SELECT * FROM users WHERE uid=:uid';
    $sth = $db->prepare($sql);
    $sth->bindParam(':uid', $uid);
    $sth->execute();
    $result = $sth->fetch(PDO::FETCH_ASSOC);
    $sth->closeCursor();
    return $result;
}
?>