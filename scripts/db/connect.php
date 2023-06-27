<?php

    namespace App;

    use PDO;
    use PDOException;

    class connect{
        private $conn;
        public function __construct(private $dsn = "mysql", private $port = 3306) {
            try {
                $this->conn = new \PDO($_ENV["DSN"].":host=".$_ENV["HOST"].";dbname=".$_ENV["DBNAME"].";user=".$_ENV["USERNAME"].";password=".$_ENV["PASSWORD"]);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Error de conexión: " . $e->getMessage());
            }
        }

        public function getConnection() {
            return $this->conn;
        }
    }

    // namespace App;

    // class connect{
    //     public $con;
    //     function __construct(){
    //         try{
    //             $this->con=new \PDO($_ENV["DSN"].":host=".$_ENV["HOST"].";dbname=".$_ENV["DBNAME"].";user=".$_ENV["USERNAME"].";password=".$_ENV["PASSWORD"]);
    //             $this->con->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    //             //echo "Connection success";
    //         } catch(\PDOException $e){
    //             echo "Connection failed". $e->getMessage();
    //         }
    //         return $this->con;
    //     }
    // }

    
?>