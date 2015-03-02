<!DOCTYPE html>
<?php include 'before.html';?>
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
    <p>Дисциплини<br>
    <a href="discpadd.html">Нова дисциплина</a><br>
    <form action="">
       Име:<input type="text" name="disc-ime" ><br>
      <button type="submit">Търси</button>
    </form><br>
    <table width="200" border="1">
  <tr>
    <th width="10" scope="col">#</th>
    <th width="33" scope="col">Име:</th>
    <th width="110" scope="col">Хорариум(Л)</th>
    <th width="5" scope="col">Хорариум(У)</th>
    <th width="8" scope="col">Операции</th>
  </tr>
    <?php
    $mysqli = new mysqli('localhost', 'root', '', 'students'); 
$mysqli->set_charset('utf8'); 
if($_GET["disc-ime"]!=""){
$result = $mysqli->query("SELECT * FROM subjects where subject_name='". $_GET["disc-ime"] ."'");
} else {$result = $mysqli->query("SELECT * FROM subjects ");}
$mysqli->close();
while ($row=$result->fetch_assoc())
{
    echo "<tr><th>".$row["subject_id"]."</th><th>".$row["subject_name"]."</th><th>".$row["subject_workload_lectures"]."</th><th>".$row["subject_workload_exercises"]."</th><th><a >DEL</a>"." "."<a>Редакция </a></th>";
}
   
?>
</table>
    </body>
</html>
