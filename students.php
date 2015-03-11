<?php
include "before.html";
$mysqli = new mysqli('localhost', 'root', '', 'students');
$mysqli->set_charset('utf8');
$result = $mysqli->query("SELECT * FROM courses");
?>
<script type="text/javascript">
    function removestu(num)
    {
        if (confirm("Изтриване на данни за студента!?"))
            self.location.href = "studel.php?del_id=" + num;
    }
        function editstu(num)
    {
        if (confirm("Редактиране на данни за студента!?"))
            self.location.href = "studentedit.php?edit_id=" + num;
    }
</script>
<a href="studentadd.php">Добавяне на Студент</a><br>
<form action="">
    Име:<input type="text" name="stu-ime" ><br>
    E-mail:<input type="text" name="user_email" ><br>
    Факултетен номер:<input type="text" name="stu-faknom" ><br>
    Курс:<select name="kurs"><option></option>
<?php while ($row = $result->fetch_assoc()) {
    echo "<option value=" . $row['course_id'] . ">" . $row['course_name'] . "</option>";
} ?>  
    </select>
    Специалност:<select name="stu-spec"><option></option>
<?php $result = $mysqli->query('SELECT * FROM specialities ');
while ($row = $result->fetch_assoc()) {
    echo "<option value=" . $row['speciality_id'] . ">" . $row['speciality_name_long'] . "</option>";
} ?>  </select><br>
    <button type="submit">Търси</button><br>
</form>
<table width="200" border="1">
    <tr>
        <th scope="col">#</th>
        <th scope="col">Име</th>
        <th scope="col">E-mail</th>
        <th scope="col">Факултетен</th>
        <th scope="col">Операции</th>
    </tr>
    <?php
    $query=("SELECT * FROM students JOIN courses ON STUDENT_COURSE_ID = COURSE_ID JOIN subjects ON STUDENT_SPECIALITY_ID = SUBJECT_ID WHERE 1 ");
    if (isset($_GET["stu-ime"])&& !empty($_GET['stu-ime'])) {
        $query .= sprintf(" AND student_fname= '%s'",$_GET["stu-ime"]);
    }
        if (isset($_GET["user_email"])&& !empty($_GET['user_email'])) {
        $query .= sprintf(" AND student_email='%s'",$_GET["user_email"]);
    }
        if (isset($_GET["stu-faknom"])&& !empty($_GET['stu-faknom'])) {
        $query .= sprintf(" AND student_fnumber='%s'",$_GET["stu-faknom"]);
    }
       if (isset($_GET["kurs"])&& !empty($_GET['kurs'])) {
        $query .= sprintf(" AND course_id='%d'",$_GET["kurs"]);
    }
        if (isset($_GET["stu-spec"])&& !empty($_GET['stu-spec'])) {
        $query .= sprintf(" AND subject_id='%d'",$_GET["stu-spec"]);
    }
    printf($query); $result=$mysqli->query($query);
    $mysqli->close();
    while ($row = $result->fetch_assoc()) {
        echo "<tr><th>" . $row["student_id"] . "</th><th>" . $row["student_fname"] . " " . $row["student_lname"] . "</th><th>" . $row["student_email"] . "</th><th>" . $row["student_fnumber"] . "</th><th><a href='javascript:removestu(" . $row['student_id'] . ")'>DEL</a>" . " " . "<a href='javascript:editstu(" . $row['student_id'] . ")'>Редакция </a></th>";
    }
    ?>
</table>

</body>
</html>
