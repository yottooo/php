<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
    <a href="courseadd.html">Нов курс</a><br>
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
    echo "<tr><th>".$row["course_id"]."</th>"."<th>".$row["course_name"]."</th><th><a >DEL</a>"." "."<a>Редакция </a></th>";
}
            ;
    ?>
          </table>
    </body>
</html>
