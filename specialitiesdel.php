<?php
include 'before.html';
$mysqli = new mysqli('localhost', 'root', '', 'students');
$mysqli->set_charset('utf8'); 

$result = $mysqli->query("SELECT * FROM specialities where speciality_id=".$_REQUEST['del_id']);
$row = $result->fetch_assoc();
$mysqli->query("delete FROM specialities where speciality_id=".$_REQUEST['del_id']);
echo "Данните за посочената специалност са изтрити.<br>";

$mysqli->close();
?>
<script>setTimeout('self.location.href="specialities.php"',2100);</script>
