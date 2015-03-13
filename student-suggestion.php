<?php
include 'application/config/autoloader.php';
$pdo = \application\Connect::getInstance();

$students = $pdo->query(\application\Search::studentSuggest($_GET['q']));

foreach($students as $student )
{
    echo '<li onclick="set_item(\''.str_replace("'", "\'", $student['student_fname'].' '.$student['student_lname']).'\')">'.$student['student_fname'].' '.$student['student_lname'].'</li><br>';
}