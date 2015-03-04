<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<?php include "before.html" ?>
            <script type="text/javascript">
        function removestu(num)
{
   if (confirm("Изтриване на данни за студента!?"))
     self.location.href="studel.php?del_id="+num;
}    
        </script>
    <a href="studentadd.php">Добавяне на Студент</a><br>
    <form action="">
 Име:<input type="text" name="stu-ime" ><br>
      E-mail:<input type="text" name="user-mail" ><br>
       Факултетен номер:<input type="text" name="stu-faknom" ><br>
Курс:<select name="kurs"><option value="1vi">Първи</option>
<option value="2ri">Втори</option>
<option value="3ti">Трети</option>
<option value="4ti">Четвърти</option>
</select>
Специалност:<select name="stu-spec"><option></option></select><br>
<button type="submit">Търси</button><br>
    </form>
    <table width="200" border="1">
  <tr>
    <th scope="col">#</th>
    <th scope="col">Име</th>
    <th scope="col">E-mail</th>
    <th scope="col">Факултетен</th>
    <th scope="col">Операции</th>
  </tr>
      <?php
    $mysqli = new mysqli('localhost', 'root', '', 'students'); 
$mysqli->set_charset('utf8'); 
if($_GET["stu-ime"]!=""){
$result = $mysqli->query("SELECT * FROM students where student_fname='". $_GET["stu-ime"] ."'");
} else {$result = $mysqli->query("SELECT * FROM students ORDER BY student_fname ASC");}
$mysqli->close();
while ($row=$result->fetch_assoc())
{
    echo "<tr><th>".$row["student_id"]."</th><th>".$row["student_fname"]." ".$row["student_lname"]."</th><th>".$row["student_email"]."</th><th>".$row["student_fnumber"]."</th><th><a href='javascript:removestu(".$row['student_id'].")'>DEL</a>"." "."<a>Редакция </a></th>";
}
            
    ?>
</table>

    </body>
</html>
