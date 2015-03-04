<?php
include 'before.html';
$mysqli = new mysqli('localhost', 'root', '', 'students');
$mysqli->set_charset('utf8'); 

$mysqli->query("delete FROM courses where course_id=".$_REQUEST['del_id']);
echo "Данните за посочения курс са изтрити.<br>";

$mysqli->close();
?>
<script>setTimeout('self.location.href="coursess.php"',2100);</script>
