<?php
include "before.html";
$mysqli = new mysqli('localhost', 'root', '', 'students');
$mysqli->set_charset('utf8');
$result = $mysqli->query("SELECT * FROM courses");
$result2 = $mysqli->query("SELECT * FROM specialities");
?>
<p>Добавяне на Студент<br>
<form action="" method="post">
    Собствено Име:<input type="text" name="stu-ime" ><br>
    Фамилия:<input type="text" name="stu-familiq" ><br>
    Факултетен номер:<input type="text" name="stu-faknom" ><br>
    E-mail:<input type="text" name="mail" ><br>
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
    if ($mysqli->query("UPDATE students SET student_fname='".$_POST['stu-ime']."', student_lname='".$_POST['stu-familiq']."', student_fnumber='".$_POST['stu-faknom']."', student_email='".$_POST['mail']."',student_course_id='".$_POST['kurs']."' ,student_speciality_id='".$_POST['spec']."' 
        where student_id=".$_REQUEST['edit_id'])){
        echo "Записа беше успешен :)";
        header("Location: students.php");
    }






}
?>