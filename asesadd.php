<?php
include "before.php";


$result = $mysqli->query("SELECT * FROM subjects");
$result2 = $mysqli->query("SELECT * FROM students order by student_fname ASC");
?>
    <body>
    <p>Добавяне на оценка<br>
    <form action="" method="post">
       Име:<select  name="ime" >
               <?php
        while ($row2 = $result2->fetch_assoc()) {
            echo "<option value=" . $row2['student_id'] . ">" . $row2['student_fname'] ." ". $row2['student_lname']."</option>";
        }
        ?> </select><br>      
       Дисциплина:<select name="disc">
        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<option value=" . $row['subject_id'] . ">" . $row['subject_name'] . "</option>";
        }
        ?>  
    </select><br>
       Хорариум(Л):<input type="text" name="ass-L" ><br>
      Хорариум(У): <input type="text" name="ass-U" ><br>
       Оценка:<input type="text" name="ass-Ocenka" s><br>
        <button type="reset">Откажи</button><button type="submit">Добави</button>
    </form>
    </body>
</html>
<?php
if ('post' === strtolower($_SERVER['REQUEST_METHOD'])) {
    if (!($stmt = $mysqli->prepare("INSERT INTO students_assessments (sa_student_id,sa_subject_id,sa_workload_lectures,sa_workload_exercises,sa_assesment) VALUES(?,?,?,?,?)"))) {
        echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }

    if (!$stmt->bind_param("iiiii",$_POST['ime'],$_POST['disc'],$_POST['ass-L'],$_POST['ass-U'],$_POST['ass-Ocenka'])) {
        echo "Binding parameters failed: (" . $mysqli->errno . ") ";
    }
    if ($stmt->execute()) {
        echo "Записа беше успешен :)";
    }
header('Location: Ases.php');

}
?>