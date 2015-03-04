<?php include "before.html" ?>
        <script type="text/javascript">
        function removecourse(num)
{
   if (confirm("Изтриване на данни за курса!?"))
     self.location.href="asesdel.php?del_id="+num;
}    
        </script>
<a href="asesadd.php">Нова оценка</a><br>
<form action="">
Име:<input type="text" name="stu-ime"><br>
Дисциплина:<select name="ass-disciplina">
         <option value="">asdasd</option>
         <option value="">asdads</option>
         <button type="submit">Търси</button>
     </select>
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
    $mysqli = new mysqli('localhost', 'root', '', 'students'); 
$mysqli->set_charset('utf8'); 
if($_GET["stu-ime"]!=""){
$result = $mysqli->query("SELECT STUDENT_ID, STUDENT_FNAME, STUDENT_LNAME,subject_name, sa_assesment FROM students JOIN students_assessments ON SA_STUDENT_ID = STUDENT_ID JOIN subjects ON SUBJECT_ID = SA_SUBJECT_ID
 where student_fname='".$_GET["stu-ime"]."'");
} else {$result = $mysqli->query("SELECT STUDENT_ID, STUDENT_FNAME, STUDENT_LNAME, STUDENT_FNUMBER, subject_name, sa_assesment FROM students JOIN students_assessments ON SA_STUDENT_ID = STUDENT_ID JOIN subjects ON SUBJECT_ID = SA_SUBJECT_ID");}
$mysqli->close();
while ($row=$result->fetch_assoc())
{
    echo "<tr><th>".$row["student_id"]."</th><th>".$row["student_fname"]." ".$row["student_lname"]."</th><th>".$row["subject_name"]."</th><th>".$row["sa_assesment"]."</th><th><a href='javascript:removeass(".$row['sa_id'].")'>DEL</a>"." "."<a>Редакция </a></th>";
}
            
    ?>
</table>

</body>
</html>
