<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title></title>
    </head>
    <body>
        <?php
        include 'application/config/autoloader.php';

        $student = application\StudentFactory::createStudent();
        $student->setName('Иван Божаков');
        $student->setCourse(new application\Course('peti'));
        $student->setSpecialitie(new application\Specialitie());


        $studentSearch = \application\StudentFactory::search($student);


        $studenttable = application\StudentFactory::createStudentTable($studentSearch->searchByNameCourseAndSpecialities());
        $studenttable->createTable();



        $connect = application\Connect::getInstance();
        $studenGrid = $connect->query(application\Search::getAllStudentForGrid());
        $allSubject = $connect->query(application\Search::getAllSubjects());
        //var_dump($studenGrid);
       
        ?>

        <div>
            <table border="1" style="width:100%">
                <tr> 
                    <td colspan="1"></td>
                    <td colspan="6"></td>
                    <td colspan="8">Предмети (хорариум и оценка)</td>
                </tr>
                <tr>
                    <td ></td>
                    <td colspan="2"></td>
                    <?php
                    foreach ($allSubject as $row) {
                        echo "<td colspan='3'>".$row['subject_name'] . "</td>";
                    }
                    ?>
                    <td colspan="3">Общо</td>
                </tr>
                <tr>
                    <td >#</td>
                    <td >Име,Фамилия</td>
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
                <tr>
                    <td >1</td>
                    <td>Иван Господинов(123456789)</td>
                    <td>Първи Курс,Бит,(3)</td>
                    <td>80(120)</td> 
                    <td>80(120)</td>
                    <td>Среден(3)</td>
                    <td>80(120)</td> 
                    <td>80(120)</td>
                    <td>Среден(3)</td>
                    <td>80(120)</td> 
                    <td>80(120)</td>
                    <td>Среден(3)</td>
                    <td>160(240)</td>
                    <td>160(240)</td> 
                    <td>Среден(3)</td>
                </tr>
            </table>
        </div>
    </body>
</html>
