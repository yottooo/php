<?php
include "before.html";
$mysqli = new mysqli('localhost', 'root', '', 'students');
$mysqli->set_charset('utf8');
$result = $mysqli->query("SELECT * FROM subjects");

?>
    <body>
    <p>Добавяне на оценка<br>
    <form action="">
       Име:<input type="text" name="ass-ime" ><br>
       Дисциплина:<select name="disc">
        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<option value=" . $row['subject_id'] . ">" . $row['subject_name'] . "</option>";
        }
        ?>  
    </select>
       Хорариум(Л):<input type="text" name="ass-L" ><br>
      Хорариум(У): <input type="text" name="ass-U" ><br>
       Оценка:<input type="text" name="ass-Ocenka" s><br>
        <button type="reset">Откажи</button><button type="submit">Добави</button>
    </form>
    </body>
</html>
