<?php
include 'before.php';


$result = $mysqli->query("SELECT * FROM students_assessments where sa_id=".$_REQUEST['del_id']);
$row = $result->fetch_assoc();
$mysqli->query("delete FROM students_assessments where sa_id=".$_REQUEST['del_id']);
echo "Данните за посочената оценка са изтрити.<br>";

$mysqli->close();
?>
<script>setTimeout('self.location.href="Ases.php"',2100);</script>
