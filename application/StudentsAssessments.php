<?php

namespace application;
class StudentsAssessments {
    private $student;
    private $subject;
    public function __construct($student,$subject) {
        $this->student = $student;
         $this->subject = $subject;
    
}
public function getAssessment(){
    echo 'Assessment is (6)';
}
public function getCurrentWorkLoadLecture(){
    echo 'CurrentWorkLoadLecture is 72';
}
public function getCurentWorkLoadExercises(){
    echo 'CurentWorkLoadExercises is 50';
}
}
