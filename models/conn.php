<?php
    class DBConn{
        private $host="localhost";
        private $dbUser="yoaoses";
        private $dbpass="lagartija21";
        private $dbName="proyecto";
        private $conn;

        public function __construct(){
            $this->conn=new mysqli($this->host,$this->dbUser,$this->dbpass,$this->dbName);
            if($this->conn->connect_error){
                die("Error de conexion:".$this->conn->connect_error);
            }
        }
        public function getConn(){
            return $this->conn;
        }
    }
?>