<?php
include 'before.html';
include 'application/config/autoloader.php';

$student = application\StudentFactory::createStudent();
$student->setName('Иван Божаков');
$student->setCourse(new application\Course('peti'));
$student->setSpecialitie(new application\Specialitie());


$studentSearch = \application\StudentFactory::search($student);


$studenttable = application\StudentFactory::createStudentTable($studentSearch->searchByNameCourseAndSpecialities());
$studenttable->createTable();


$connect = application\Connect::getInstance();

$studentGrid = $connect->query(application\Search::getAllStudentForGrid());
$allSubject = $connect->query(application\Search::getAllSubjects());
$num_subject = $allSubject->rowCount();

?>

<div>
    <table border="1" style="width:100%">
        <tr>
            <td colspan="1"></td>
            <td colspan="6"></td>
            <td colspan="9">Предмети (хорариум и оценка)</td>
        </tr>
        <tr>
            <td></td>
            <td colspan="2"></td>
            <?php
            foreach ($allSubject as $row) {
                echo "<td colspan='3'>" . $row['subject_name'] . "</td>";
            }
            ?>
            <td colspan="3">Общо</td>
        </tr>
        <tr>
            <td>#</td>
            <td>Име,Фамилия</td>
            <td>Курс</td>

            <td>Лекции</td>
            <td>Упражнения</td>
            <td>Оценака</td>

            <td>Лекции</td>
            <td>Упражнения</td>
            <td>Оценака</td>

            <td>Лекции</td>
            <td>Упражнения</td>
            <td>Оценака</td>

            <td>ср.Успех</td>
            <td>Лекции</td>
            <td>Упражнения</td>

        </tr>

        <?php foreach ($studentGrid as $student) {
            // echo $student['LISTOFSUBJECTS'].'<br>';
            $list_of_subject = explode(',', $student['LISTOFASSESSMENTS']);
            $list_of_sa_lecture = explode(',', $student['LISTOF_SA_WORKLOAD_LECTURES']);
            $list_of_sa_workload_exericies = explode(',', $student['LISTOF_SA_WORKLOAD_EXERCISES']);

            //horariumi

            $LISTOF_SUBJECT_WORKLOAD_LECTURES = explode(',', $student['LISTOF_SUBJECT_WORKLOAD_LECTURES']);
            $LISTOF_SUBJECT_WORKLOAD_EXERCISES = explode(',', $student['LISTOF_SUBJECT_WORKLOAD_EXERCISES']);

            switch ($student['COURSE_NAME']) {
                case 'Първи курс':
                    $course_name_number = 1;
                    break;
                case 'Втори курс':
                    $course_name_number = 2;
                    break;
                case 'Трети курс':
                    $course_name_number = 3;
                    break;
                case 'Четвърти курс':
                    $course_name_number = 4;
                    break;

            }
            ?>
            <?php echo "<tr><td >{$student['STUDENT_ID']}</td>
                    <td>{$student['STUDENT_FNAME']} {$student['STUDENT_FNAME']}({$student['STUDENT_FNUMBER']})</td>
                    <td>{$student['COURSE_NAME']}, {$student['SPECIALITY_NAME_SHORT']}, ({$course_name_number})</td>
                    ";
            $avg_workload_subject_lecture = 0;
            $avg_workload_subject_exsercise = 0;

            $avg_workload_sa_lecture = 0;
            $avg_workload_sa_exsercise = 0;

            for ($i = 0; $i < $num_subject; $i++) {
                $avg_workload_subject_lecture += $LISTOF_SUBJECT_WORKLOAD_LECTURES[$i];
                $avg_workload_subject_exsercise += $LISTOF_SUBJECT_WORKLOAD_EXERCISES[$i];

                $avg_workload_sa_lecture += $list_of_sa_lecture[$i];
                $avg_workload_sa_exsercise += $list_of_sa_workload_exericies[$i];
                switch ($list_of_subject[$i]) {
                    case '2':
                        $asses = 'Слаб';
                        break;
                    case '3':
                        $asses = 'Среден';
                        break;
                    case '4':
                        $asses = 'Добър';
                        break;
                    case '5':
                        $asses = 'Мн.Добър';
                        break;
                    case '6':
                        $asses = 'Отличен';
                        break;
                }
                echo
                    "<td>{$list_of_sa_lecture[$i]}({$LISTOF_SUBJECT_WORKLOAD_LECTURES[$i]})</td>
                        <td>{$list_of_sa_workload_exericies[$i]}({$LISTOF_SUBJECT_WORKLOAD_EXERCISES[$i]})</td>
                        <td>{$asses}({$list_of_subject[$i]})</td>" .
                    "";
                ?>
            <?php }
            echo $avg_workload_subject_lecture; ?>
            <td><?php echo floor($avg_workload_sa_lecture / $num_subject) . '(' . floor($avg_workload_subject_lecture / $num_subject) . ')'; ?></td>
            <td><?php echo floor($avg_workload_sa_exsercise / $num_subject) . '(' . floor($avg_workload_subject_exsercise / $num_subject) . ')'; ?></td>
            <?php //todo avg asses?>
            <td>Среден(3)</td>
            <?php echo "</tr>"; ?>
        <?php } ?>

    </table>
</div>
</body>
</html>
