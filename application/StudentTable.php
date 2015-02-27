<?php
namespace application;

class StudentTable {

    private $paginator;
    private $sudentSearchQuery;

    public function __construct($studentsResult) {
        $this->sudentSearchQuery = $studentsResult;
    }

    public function createTable() {
        $this->sudentSearchQuery;
    }

}
