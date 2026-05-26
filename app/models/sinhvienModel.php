<?php
require_once '../app/core/DB.php';
class sinhvienModel {
    public function __construct() {
        $db = new ConnectDB();
        $this->conn = $db->connect();
    }
    public function getAllSinhVien(){
        $query = "SELECT * FROM tbl_sinhviens";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>