<?php
namespace application;

class Search {

    private $studentData;

    public function __construct(Student $student) {
        $this->studentData = $student;
    }

    public function searchByNameCourseAndSpecialities() {
        $this->studentData->getName();
        $this->studentData->getCource();
        $this->studentData->getSpecialitie();
    }

    /**
     * 
     * @return string SQL Return all student from Databese
     * @static
     */
    public static function getAllStudent() {
        return 'SQL return all student from database';
    }

}
