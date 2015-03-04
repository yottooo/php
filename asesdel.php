<?php
include 'before.html';
$mysqli = new mysqli('localhost', 'root', '', 'students');
$mysqli->set_charset('utf8'); 

$result = $mysqli->query("SELECT * FROM students_assessments where sa_id=".$_REQUEST['del_id']);
$row = $result->fetch_assoc();
$mysqli->query("delete FROM students_assessments where sa_id=".$_REQUEST['del_id']);
echo "Данните за посочения студент са изтрити.<br>";

$mysqli->close();
?>
<script>setTimeout('self.location.href="Ases.php"',2100);</script>
