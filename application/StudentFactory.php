<?php

namespace application;

class StudentFactory {

    /**
     * 
     * @return \application\Student
     */
    public static function createStudent() {
        return new Student();
    }

    /**
     * 
     * @param \application\Student $student
     * @return \application\Search
     */
    public static function search(Student $student) {
        return new \application\Search($student);
    }

    /**
     * 
     * @param string $students is sql query who generate students table
     * @return \application\StudentTable
     */
    public static function createStudentTable($students) {
        return new \application\StudentTable($students);
    }

}
