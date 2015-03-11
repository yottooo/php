<?php
include 'before.php';


$result = $mysqli->query("SELECT * FROM users where user_id=".$_REQUEST['del_id']);
$row = $result->fetch_assoc();
$mysqli->query("delete FROM users where user_id=".$_REQUEST['del_id']);
echo "Данните за посочения потребител са изтрити.<br>";

$mysqli->close();
?>
    <script>setTimeout('self.location.href="users.php"',2000);</script>


