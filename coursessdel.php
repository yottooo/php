<?php
include 'before.php';


$mysqli->query("delete FROM courses where course_id=".$_REQUEST['del_id']);
echo "Данните за посочения курс са изтрити.<br>";

$mysqli->close();
?>
<script>setTimeout('self.location.href="coursess.php"',1100);</script>
