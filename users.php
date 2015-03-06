
<?php include "before.html" ?>
        <script type="text/javascript">
        function removeuser(num)
{
   if (confirm("Изтриване на данни за Потребителя!?"))
     self.location.href="usersdel.php?del_id="+num;
}    
function edituser(num)
{

   if (confirm("Редактиране на данни за Дисциплинa!?"))
     self.location.href="useredit.php?edit_id="+num;
}  
        </script>
    <a href="useradd.php">Добавяне на Потребител</a><br>
    <form action="">
      Потребителско Име:<input type="text" name="user_name" ><br>
      E-mail:<input type="text" name="user_email" ><br>
    <button type="submit">Търси</button>
    </form><br>
    <table width="200" border="1">
  <tr>
    <th >#</th>
        <th >Потребителско Име</th>
    <th >Email</th>
    <th >Операции</th>
  </tr>
      <?php
    $mysqli = new mysqli('localhost', 'root', '', 'students'); 
$mysqli->set_charset('utf8');

$query=("SELECT * FROM users where 1");
if(isset($_GET['user_name']) &&!empty($_GET['user_name'])){
   $query .= sprintf(" AND user_name = '%s'",$_GET['user_name']);
  }
  if(isset($_GET['user_email']) && !empty($_GET['user_email'])){
   $query .= sprintf(" AND user_email ='%s'",$_GET['user_email']);
  }

 printf($query); $result=$mysqli->query($query);
$mysqli->close();
while ($row=$result->fetch_assoc())
{
    echo "<tr><th>".$row["user_id"]."</th>"."<th>".$row["user_name"]."</th><th>".$row["user_email"]."<th><a href='javascript:removeuser(".$row['user_id'].")'>DEL</a>"." "."<a href='javascript:edituser(".$row['user_id'].")'>Редакция </a></th>";
}
            
    ?>
</table>

    </body>
</html>
