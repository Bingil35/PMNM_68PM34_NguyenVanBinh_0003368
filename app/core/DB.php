<?php
    class ConnectDB{
        private $host = 'localhost';
        private $db_name = '68pm34';
        private $username = 'root';
        private $password = '';
        public $conn;

        public static function Connect(){
            $self = new self();
            $self->conn = null;
            try{
  
                //this->conn = new mysqli($this ->host, $this->username, $this->password, $this->db_name);
                $self->conn = new PDO('mysql:host=' . $self->host . ';dbname=' . $self->db_name, $self->username, $self->password);

                $self->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $e){
                echo 'Connection Error: ' . $e->getMessage();
            }
            return $self->conn;
        }
    }