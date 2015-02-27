<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        include 'application/config/autoloader.php';

        $student = application\StudentFactory::createStudent();
        $student->setName('Иван Божаков');
        $student->setCourse(new application\Course());
        $student->setSpecialitie(new application\Specialitie());


        $studentSearch = \application\StudentFactory::search($student);


        $studenttable = application\StudentFactory::createStudentTable($studentSearch->searchByNameCourseAndSpecialities());
        $studenttable->createTable();
        ?>
    </body>
</html>
