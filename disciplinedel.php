<?php
include 'before.php';


$result = $mysqli->query("SELECT * FROM subjects where subject_id=".$_REQUEST['del_id']);
$row = $result->fetch_assoc();
$mysqli->query("delete FROM subjects where subject_id=".$_REQUEST['del_id']);
echo "Данните за посочената дисциплина са изтрити.<br>";

$mysqli->close();
?>
<script>setTimeout('self.location.href="discipline.php"',2100);</script>

