<?php include_once __DIR__.'/../connection/config.php'; ?>

<?php 

class ConnectionDB {
    private $host = HOST;
    private $username = USERNAME;
    private $password = PASSWORD;
    private $db_name = DB_NAME;

    private $con;

    public function __construct() {
        $this->connect();
    }

    // connection to database
    public function connect () {
        $this->con = new mysqli($this->host, $this->username, $this->password, $this->db_name);
        if(mysqli_connect_errno()) {
            $this->error = "Connectiont failed ". mysqli_connect_errno();
            return false;
        }
    }

    // S E L E C T
    public function query($query) {
        $result = $this->con->query($query);
        if($result) {
            if($result->num_rows > 0) return $result;
        }
        else return false;
    }

    // I N S E R T 
    public function insert($query) {
        $result = $this->con->query($query);
        return $result;
    }


}