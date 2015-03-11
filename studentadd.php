<?php
include "before.html";
$mysqli = new mysqli('localhost', 'root', '', 'students');
$mysqli->set_charset('utf8');
$result = $mysqli->query("SELECT * FROM courses");
$result2 = $mysqli->query("SELECT * FROM specialities");
?>
<p>Добавяне на Студент<br>
<form action="" method="post">
    Потребителско Име:<input type="text" name="user-ime" ><br>
    Парола:<input type="text" name="user-pass" ><br>
    Парола:<input type="text" name="user-pass2" ><br>
    E-mail:<input type="text" name="mail" ><br>

    Собствено Име:<input type="text" name="stu-ime" ><br>
    Фамилия:<input type="text" name="stu-familiq" ><br>
    Факултетен номер:<input type="text" name="stu-faknom" ><br>
    Курс:<select name="kurs">
        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<option value=" . $row['course_id'] . ">" . $row['course_name'] . "</option>";
        }
        ?>  
    </select>
    Специалност:<select name="spec">
        <?php
        while ($row2 = $result2->fetch_assoc()) {
            echo "<option value=" . $row2['speciality_id'] . ">" . $row2['speciality_name_long'] . "</option>";
        }
        ?>  
    </select><br>
    Форма на обучение:<select name="obu"><option value="Р">Редовно</option>
        <option value="З">Задочно</option></select><br>
    <button type="reset">Откажи</button><button type="submit">Добави</button>
</form>
</body>
</html>
<?php
if ('post' === strtolower($_SERVER['REQUEST_METHOD'])) {
    if (!($stmt = $mysqli->prepare("INSERT INTO students (student_fname,student_lname,student_fnumber,student_email,student_course_id,student_speciality_id,student_education_form) VALUES(?,?,?,?,?,?,?)"))) {
        echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }

    if (!$stmt->bind_param("ssisiis", $_POST['stu-ime'],$_POST['stu-familiq'],$_POST['stu-faknom'],$_POST['mail'],$_POST['kurs'],$_POST['spec'],$_POST['obu'])) {
        echo "Binding parameters failed: (" . $mysqli->errno . ") ";
    }
    if ($stmt->execute()) {
        echo "Записа беше успешен :)";
    }



    $lastid = $mysqli->insert_id;
    echo("<br>" . $lastid . "<br>");
    if (!($stmt1 = $mysqli->prepare("INSERT INTO users (user_id,user_name,user_fname,user_lname,user_password,user_email) VALUES(?,?,?,?,?,?)"))) {
        echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }

    if (!$stmt1->bind_param("isssis", $lastid, $_POST['user-ime'], $_POST['stu-ime'], $_POST['stu-familiq'], $_POST['user-pass'], $_POST['mail'])) {
        echo "Binding parameters failed: (" . $mysqli->errno . ") ";
    }
    if ($stmt1->execute()) {
        echo "Записа беше успешен :)";
    }
}
?>