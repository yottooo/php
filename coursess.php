<?php include 'before.html';?>
        <script type="text/javascript">
        function removecourse(num)
{
   if (confirm("Изтриване на данни за курса!?"))
     self.location.href="coursessdel.php?del_id="+num;
}    
        </script>
    <a href="courseadd.php">Нов курс</a><br>
    <form method="GET">
       Име на Курс:<input type="text" name="kurs-ime" ><button type="submit">Търси</button>
    </form><br>
    <table width="200" border="1">
      <tr>
        <th >#</th>
        <th >Име</th>
        <th >Операции</th>
      </tr>
    <?php
    $mysqli = new mysqli('localhost', 'root', '', 'students'); 
$mysqli->set_charset('utf8'); 
if($_GET["kurs-ime"]!=""){
$result = $mysqli->query("SELECT * FROM courses where course_name='". $_GET["kurs-ime"] ."'");
} else {$result = $mysqli->query("SELECT * FROM courses ");}
$mysqli->close();
while ($row=$result->fetch_assoc())
{
    echo "<tr><th>".$row["course_id"]."</th>"."<th>".$row["course_name"]."</th><th><a href='javascript:removecourse(".$row['course_id'].")'>DEL</a>"." "."<a>Редакция </a></th>";
}
            
    ?>
          </table>
    </body>
</html>
