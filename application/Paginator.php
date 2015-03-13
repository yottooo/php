<?php namespace application;

class Paginator
{

    private $connection;
    public $page;
    private $start = 0;
    public $limit;
   public $total;
    private $query_string_search;
    protected $query;

    public function __construct($connection, $query, $query_string_search = '', $limit = 15)
    {
         if(!empty($_GET['page']) && !is_numeric($_GET['page'])){
              header("Location: .");
         }
        $this->query_string_search = $query_string_search;
        if (!isset($_GET['page'])) {
            $_GET['page'] = 1;
        }
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
        $this->limit = $limit;
         $rows = $this->connection->query($this->query);
        $num_row = $rows->rowCount();
        $this->total = ceil($num_row / $this->limit);
             if( $this->total<$_GET['page'] ){
       header("Location: .");
    }
    }

    public function pagination()
    {
        if (isset($this->page)) {
            $this->start = ($this->page - 1) * $this->limit;
        }
        $query = $this->connection->query($this->query . " LIMIT {$this->start},{$this->limit}");
        return $query;
    }

    public function links()
    {
     
        $rows = $this->connection->query($this->query);
        $num_row = $rows->rowCount();
        $this->total = ceil($num_row / $this->limit);
    
        if ($this->page > 1) {
             echo "<a href='?page=1". "' class='button'>Първа страница</a>";
            if ($this->query_string_search == '') {
                echo "<a href='?page=" . ($this->page - 1) . "' class='button'>PREVIOUS</a>";
            } else {
                echo "<a href='?page=" . ($this->page - 1) . '&' . $this->query_string_search . "' class='button'>PREVIOUS</a>";
            }
            
        }
        if ($this->page != $this->total) {
            if ($this->query_string_search == '') {
                echo "<a href='?page=" . ($this->page + 1) . "' class='button'>NEXT</a>";
            } else {
                echo "<a href='?page=" . ($this->page + 1) . '&' . $this->query_string_search . "' class='button'>NEXT</a>";
            }

        }
        
 echo "<a href='?page=" . ($this->total) . '&' . $this->query_string_search . "' class='button'>Последна страница</a>";
        echo "<ul class='page'>";
        for ($i = 1; $i <= $this->total; $i++) {
            if ($i == $this->page) {
                echo "<li class='current'>" . $i . "</li>";
            } else {
                echo "<li><a href='?page=" . $i . '&' . $this->query_string_search . "'>" . $i . "</a></li>";
            }
        }
        echo "</ul>";
    }

}