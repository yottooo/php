<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php include 'before.php';?>
        <script type="text/javascript">
        function removespeciality(num)
{
   if (confirm("Изтриване на данни за специалноста!?"))
     self.location.href="specialitiesdel.php?del_id="+num;
}    
 function editspeciality(num)
{

   if (confirm("Редактиране на данни за специалноста!?"))
     self.location.href="specialitieedit.php?edit_id="+num;
}  
        </script>
    <a href="specialitieadd.php">Добавяне на Специалност</a><br>
    <form action="">
       Име:<input type="text" name="spec-ime" ><br>
<button type="submit">Търси</button>
    </form><br>
    <table width="200" border="1">
  <tr>
    <th >#</th>
    <th >Пълно име</th>
    <th >Абревиатура</th>
    <th >Операции</th>
  </tr>
      <?php

if($_GET["spec-ime"]!=""){
$result = $mysqli->query("SELECT * FROM specialities where speciality_name_long='". $_GET["spec-ime"] ."'");
} else {$result = $mysqli->query("SELECT * FROM specialities ");}
$mysqli->close();
while ($row=$result->fetch_assoc())
{
  echo "<tr><th>".$row["speciality_id"]."</th>"."<th>".$row["speciality_name_long"]."</th><th>".$row["speciality_name_short"]."<th><a href='javascript:removespeciality(".$row['speciality_id'].")'>DEL</a>"." "."<a href='javascript:editspeciality(".$row['speciality_id'].")'>Редакция </a></th>";
}
            ;
    ?>
</table>

    </body>
</html>
