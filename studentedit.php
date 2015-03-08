<?php
include "before.html";
$mysqli = new mysqli('localhost', 'root', '', 'students');
$mysqli->set_charset('utf8');
$result = $mysqli->query("SELECT * FROM courses");
?>
    <p>Редактиране на Студент<br>
        <form action="">
      Потребителско Име:<input type="text" name="user-ime" ><br>
      Парола:<input type="text" name="user-pass" ><br>
      Парола:<input type="text" name="user-pass2" ><br>
      E-mail:<input type="text" name="user-mail" ><br>
        <button type="reset">Откажи</button><button type="submit">Добави</button>
    </form>
    <form action="">
      Собствено Име:<input type="text" name="stu-ime" ><br>
      Фамилия:<input type="text" name="stu-familiq" ><br>
       Факултетен номер:<input type="text" name="stu-faknom" ><br>
    Курс:<select name="kurs">
<?php while ($row = $result->fetch_assoc()) {
    echo "<option value=" . $row['course_id'] . ">" . $row['course_name'] . "</option>";
} ?>  
    </select><br>
Специалност:<select name="stu-spec"><option></option></select><br>
Форма на обучение:<select name="stu-obu4"><option>Редовно</option>
<option>Задочно</option></select><br>
        <button type="reset">Откажи</button><button type="submit">Редактирай</button>
    </form>
    </body>
</html>
