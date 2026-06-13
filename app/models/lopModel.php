<?php
require_once '../app/core/DB.php';

class lopModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = ConnectDB::Connect();
    }

    public function create($malop, $tenlop, $ghichu)
    {
        $query = "INSERT INTO tbl_lops (malop, tenlop, ghichu) VALUES (:malop, :tenlop, :ghichu)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':malop', $malop);
        $stmt->bindParam(':tenlop', $tenlop);
        $stmt->bindParam(':ghichu', $ghichu);
        return $stmt->execute();
    }

    public function getAll()
    {
        $query = "SELECT * FROM tbl_lops ORDER BY malop ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $query = "SELECT * FROM tbl_lops WHERE ID = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $tenlop, $ghichu)
    {
        $query = "UPDATE tbl_lops SET tenlop = :tenlop, ghichu = :ghichu WHERE ID = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':tenlop', $tenlop);
        $stmt->bindParam(':ghichu', $ghichu);
        return $stmt->execute();
    }

    public function countSinhvienByMalop($malop)
    {
        $query = "SELECT COUNT(*) FROM tbl_sinhviens WHERE malop = :malop";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':malop', $malop);
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }

    public function delete($id)
    {
        $query = "DELETE FROM tbl_lops WHERE ID = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function paging($limit = 5, $offset = 0)
    {
        $query = "SELECT * FROM tbl_lops ORDER BY ID DESC LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $selectAllQuery = $this->conn->query("SELECT COUNT(*) FROM tbl_lops");
        $totalRecord = (int) $selectAllQuery->fetchColumn();
        $totalPage = $limit > 0 ? (int) ceil($totalRecord / $limit) : 0;

        return [
            'lops' => $result,
            'totalpage' => $totalPage
        ];
    }
}
?>
