
<?php include "before.html" ?>
        <script type="text/javascript">
        function removeuser(num)
{
   if (confirm("Изтриване на данни за Потребителя!?"))
     self.location.href="usersdel.php?del_id="+num;
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
$result = $mysqli->query("SELECT * FROM users ");
/*if($_GET["user_name"]=="" || $_GET["user_email"]==""){
if($_GET["user_email"]==""){$result = $mysqli->query("SELECT * FROM users where user_name='". $_GET["user_name"] ."'");}
else if($_GET["user_name"]=="" ){$result = $mysqli->query("SELECT * FROM users where user_email='". $_GET["user_email"] ."'");}
} else
if($_GET["user_name"]!="" && $_GET["user_email"]!=""){"SELECT FROM users where user_email='". $_GET["user_email"] ."' and user_name='". $_GET["user_name"] ."'";}
   */
$mysqli->close();
while ($row=$result->fetch_assoc())
{
    echo "<tr><th>".$row["user_id"]."</th>"."<th>".$row["user_name"]."</th><th>".$row["user_email"]."<th><a href='javascript:removeuser(".$row['user_id'].")'>DEL</a>"." "."<a>Редакция </a></th>";
}
            
    ?>
</table>

    </body>
</html>
