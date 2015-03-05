<!DOCTYPE html>
<?php include 'before.html';?>

        <script type="text/javascript">
        function removedis(num)
{
   if (confirm("Изтриване на данни за Дисциплинa!?"))
     self.location.href="disciplinedel.php?del_id="+num;
}    
        </script>

    <p>Дисциплини<br>
    <a href="discpadd.php">Нова дисциплина</a><br>
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
    echo "<tr><th>".$row["subject_id"]."</th><th>".$row["subject_name"]."</th><th>".$row["subject_workload_lectures"]."</th><th>".$row["subject_workload_exercises"]."</th><th><a href='javascript:removedis(".$row['subject_id'].")'>DEL</a>"." "."<a>Редакция </a></th>";
}
   
?>
</table>
    </body>
</html>
