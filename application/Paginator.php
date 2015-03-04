<?php
namespace application;

class Paginator
{

    private $connection;
    private $page;
    private $start = 0;
    private $limit;
    private $total;
    protected $query;

    public function __construct($connection, $query,$limit=10)
    {
        $this->connection = $connection;
        if (empty($_GET['page']) || is_numeric($_GET['page'])) {
            $this->page = $_GET['page'];
        } else {
            throw new InvalidArgumentException("page must be a number");
        }
        if (!empty($query)) {
            $this->query = $query;
        } else {
            throw  new InvalidArgumentException("set sql query");
        }
        $this->limit=$limit;
    }

    public function pagination()
    {
        if (isset($this->page)) {
            $this->start = ($this->page - 1) * $this->limit;
        }
        $query = $this->connection->query($this->query . "LIMIT $this->start, $this->limit");
        return $query;
    }

    public function links()
    {
        $rows = $this->connection->query($this->query);
        $num_row = $rows->rowCount();
        $this->total = ceil($num_row / $this->limit);
        if ($this->page > 1) {
            echo "<a href='?page=" . ($this->page - 1) . "' class='button'>PREVIOUS</a>";
        }
        if ($this->page != $this->total) {
            echo "<a href='?page=" . ($this->page + 1) . "' class='button'>NEXT</a>";
        }

        echo "<ul class='page'>";
        for ($i = 1; $i <= $this->total; $i++) {
            if ($i == $this->page) {
                echo "<li class='current'>" . $i . "</li>";
            } else {
                echo "<li><a href='?page=" . $i . "'>" . $i . "</a></li>";
            }
        }
        echo "</ul>";
    }

}