<?php include "before.html"; 
 $mysqli = new mysqli('localhost', 'root', '', 'students');
$mysqli->set_charset('utf8');
$result = $mysqli->query('SELECT * FROM subjects ');
?>
        <script type="text/javascript">
        function removeass(num)
{
   if (confirm("Изтриване на данните за оценката!?"))
     self.location.href="asesdel.php?del_id="+num;
}            function editass(num)
{
   if (confirm("Изтриване на данните за оценката!?"))
     self.location.href="asesedit.php?edit_id="+num;
}  
        </script>
<a href="asesadd.php">Нова оценка</a><br>
<form action="">
Име:<input type="text" name="stu-ime"><br>
Дисциплина:<select name="ass-disciplina">
<?php while($row=$result->fetch_assoc()){echo "<option value=".$row['subject_name'].">".$row['subject_name']."</option>";} ?>      
     </select>
<button type="submit">Търси</button>
</form><br>
<table width="200" border="1">
  <tr>
    <th scope="col">#</th>
    <th scope="col">име,фамилия</th>
    <th scope="col">Дисциплина</th>
    <th scope="col">Оценка</th>
    <th scope="col">Операции</th>
  </tr>
      <?php

$query=("SELECT STUDENT_ID, STUDENT_FNAME, STUDENT_LNAME,subject_name, sa_assesment,sa_id FROM students JOIN students_assessments ON SA_STUDENT_ID = STUDENT_ID JOIN subjects ON SUBJECT_ID = SA_SUBJECT_ID
 WHERE 1");
if(isset($_GET['stu-ime']) &&!empty($_GET['stu-ime'])){
   $query .= sprintf(" AND STUDENT_FNAME = '%s'",$_GET['stu-ime']);
  }
  if(isset($_GET['ass-disciplina']) && !empty($_GET['ass-disciplina'])){
   $query .= sprintf(" AND subject_name ='%s'",$_GET['ass-disciplina']);
  }
  printf($query); $result=$mysqli->query($query);
    $mysqli->close();

          while ($row = $result->fetch_assoc()) {
              echo "<tr><th>" . $row["STUDENT_ID"] . "</th> <th>" . $row["STUDENT_FNAME"] . " " . $row["STUDENT_LNAME"] . "</th> <th>" . $row["subject_name"] . "</th> <th>" . $row["sa_assesment"] . "</th> <th><a href='javascript:removeass(" . $row['sa_id'] . ")'>DEL</a>" . " " . "<a href='javascript:editass(" . $row['sa_id'] . ")'>Редакция </a></th></tr>";
 }
    ?>
</table>

</body>
</html>
