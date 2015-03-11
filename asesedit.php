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
    if ($mysqli->query("UPDATE students_assessments SET sa_subject_id='".$_POST['disc']."', sa_workload_lectures='".$_POST['ass-L']."', sa_workload_exercises='".$_POST['ass-U']."', sa_assesment='".$_POST['ass-Ocenka']."' 
        where sa_id=".$_REQUEST['edit_id'])){
        echo "Записа беше успешен :)";
    }




header('Location: Ases.php');

}
?>