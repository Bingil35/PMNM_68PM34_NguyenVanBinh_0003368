<?php
require_once '../app/core/DB.php';

class SinhvienModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = ConnectDB::Connect();
    }

    public function getAllSinhvien()
    {
        $query = "SELECT sv.*, l.tenlop FROM tbl_sinhviens sv LEFT JOIN tbl_lops l ON sv.malop = l.malop";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($hoten, $gioitinh, $mssv, $malop)
    {
        $query = "INSERT INTO tbl_sinhviens (hoten, gioitinh, mssv, malop) VALUES (:hoten, :gioitinh, :mssv, :malop)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':hoten', $hoten);
        $stmt->bindParam(':gioitinh', $gioitinh);
        $stmt->bindParam(':mssv', $mssv);
        $stmt->bindParam(':malop', $malop);
        return $stmt->execute();
    }

    public function getById($id)
    {
        $query = "SELECT * FROM tbl_sinhviens WHERE ID = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $hoten, $gioitinh, $mssv, $malop)
    {
        $query = "UPDATE tbl_sinhviens SET hoten = :hoten, gioitinh = :gioitinh, mssv = :mssv, malop = :malop WHERE ID = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':hoten', $hoten);
        $stmt->bindParam(':gioitinh', $gioitinh);
        $stmt->bindParam(':mssv', $mssv);
        $stmt->bindParam(':malop', $malop);
        return $stmt->execute();
    }

    public function delete($id)
    {
        $query = "DELETE FROM tbl_sinhviens WHERE ID = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function paging($limit = 5, $offset = 0, $keyword = '', $sort = '', $dir = 'asc')
    {
        $keyword = trim($keyword);
        $where = '';
        $sortableColumns = ['hoten', 'mssv'];
        $sortDirection = strtolower($dir) === 'desc' ? 'DESC' : 'ASC';

        if (!in_array($sort, $sortableColumns, true)) {
            $orderBy = 'sv.ID DESC';
        } elseif ($sort === 'hoten') {
            $vietnameseCollation = 'utf8mb4_vietnamese_ci';
            $fullName = 'TRIM(sv.hoten)';
            $spaceCount = "(LENGTH({$fullName}) - LENGTH(REPLACE({$fullName}, ' ', '')))";
            $lastName = "SUBSTRING_INDEX({$fullName}, ' ', -1)";
            $familyName = "SUBSTRING_INDEX({$fullName}, ' ', 1)";
            $middleName = "CASE
                WHEN {$spaceCount} >= 2 THEN TRIM(SUBSTRING(
                    {$fullName},
                    LENGTH(SUBSTRING_INDEX({$fullName}, ' ', 1)) + 1,
                    LENGTH({$fullName}) - LENGTH(SUBSTRING_INDEX({$fullName}, ' ', 1)) - LENGTH(SUBSTRING_INDEX({$fullName}, ' ', -1))
                ))
                ELSE ''
            END";
            $orderBy = "{$lastName} COLLATE {$vietnameseCollation} {$sortDirection},
                        {$middleName} COLLATE {$vietnameseCollation} {$sortDirection},
                        {$familyName} COLLATE {$vietnameseCollation} {$sortDirection},
                        sv.ID DESC";
        } else {
            $orderBy = "sv.mssv {$sortDirection}, sv.ID DESC";
        }

        if ($keyword !== '') {
            $where = "WHERE sv.mssv LIKE :keyword
                      OR sv.hoten LIKE :keyword
                      OR sv.malop LIKE :keyword
                      OR l.tenlop LIKE :keyword";
        }

        $query = "SELECT sv.*, l.tenlop
                  FROM tbl_sinhviens sv
                  LEFT JOIN tbl_lops l ON sv.malop = l.malop
                  {$where}
                  ORDER BY {$orderBy}
                  LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($query);
        if ($keyword !== '') {
            $keywordLike = '%' . $keyword . '%';
            $stmt->bindParam(':keyword', $keywordLike);
        }
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $countQuery = "SELECT COUNT(*)
                       FROM tbl_sinhviens sv
                       LEFT JOIN tbl_lops l ON sv.malop = l.malop
                       {$where}";
        $countStmt = $this->conn->prepare($countQuery);
        if ($keyword !== '') {
            $countStmt->bindParam(':keyword', $keywordLike);
        }
        $countStmt->execute();
        $totalRecord = (int) $countStmt->fetchColumn();
        $totalPage = $limit > 0 ? (int) ceil($totalRecord / $limit) : 0;

        return [
            'sinhviens' => $result,
            'totalpage' => $totalPage,
            'totalrecord' => $totalRecord
        ];
    }
}
?>
