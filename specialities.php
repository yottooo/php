<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php include 'before.html';?>
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
    <a href="specialitieadd.html">Добавяне на Специалност</a><br>
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
    $mysqli = new mysqli('localhost', 'root', '', 'students'); 
$mysqli->set_charset('utf8'); 
if($_GET["spec-ime"]!=""){
$result = $mysqli->query("SELECT * FROM specialities where speciality_name_long='". $_GET["spec-ime"] ."'");
} else {$result = $mysqli->query("SELECT * FROM specialities ");}
$mysqli->close();
while ($row=$result->fetch_assoc())
{
  echo "<tr><th>".$row["speciality_id"]."</th>"."<th>".$row["speciality_name_long"]."</th><th>".$row["speciality_name_long"]."<th><a >DEL</a>"." "."<a>Редакция </a></th>";
}
            ;
    ?>
</table>

    </body>
</html>
