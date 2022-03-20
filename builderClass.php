<?php


class DBConnection
{
    private $host       = 'mysql:host=localhost;dbname=e-wallet'; //or localhost
    private $port       = 8081;
    private $user       = 'root';
    private $password   = '';
    private  $conn;
    private $stmt;
    public $sql;

    function __construct()
    {
        try {
            $this->conn  = new PDO($this->host, $this->user, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo 'Scussesfuly connected ';
        } catch (PDOException $e) {
            echo 'Failed To Connected' . $e;
        }
    }
    function query(string $sql)
    {
        $this->sql = $sql;
        return $this;
    }
    function orderBY($sql)
    {
        $this->sql = $this->sql . "  "  . $sql;
        return $this;
    }
    function groupBy($sql)
    {
        $this->sql = $this->sql . "  "  . $sql;
        return $this;
    }
    function done()
    {
        echo $this->sql;
        return $this->stmt = $this->conn->prepare($this->sql);
    }
    function bind(string $param, string $value, int $type)
    {
        $this->stmt->bindParam($param, $value, $type);
    }
    function execute(): bool
    {
        if ($this->stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }


    // return object
    function fetch()
    {
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    // return array 
    public function fetchAll(): array
    {
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function rowCount(): int
    {
        return $this->stmt->rowCount();
    }

    public function __destruct()
    { {
            $this->db = null;
            $this->stmt = null;
        }
    }
}
$order = 2;

$DB = new DBConnection();
$DB2 = new DBConnection();
$DB->query("SELECT * FROM products ")->groupBy("GROUP BY :group")->done();
$DB2->query("SELECT * FROM products ")->orderBY("ORDER BY :order ASC")->done();
$DB2->bind(":order", "product_price", PDO::PARAM_STR);
$DB->bind(":group", "category_id", PDO::PARAM_STR);
$DB->execute();
$DB2->execute();
$arr = $DB->fetchAll();
$arr2 = $DB2->fetchAll();

print_r($arr);
print_r($arr2);