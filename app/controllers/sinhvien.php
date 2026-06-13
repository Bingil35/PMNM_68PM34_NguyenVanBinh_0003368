<?php

require_once '../app/core/Controller.php';
require_once '../app/models/sinhvienModel.php';
require_once '../app/models/lopModel.php';

class sinhvien extends Controller
{
    public function index($limit = 5, $offset = 0)
    {
        $keyword = trim($_GET['keyword'] ?? '');
        $sort = $_GET['sort'] ?? '';
        $dir = $_GET['dir'] ?? 'asc';
        $allowedSorts = ['hoten', 'mssv'];
        $allowedDirs = ['asc', 'desc'];

        if (!in_array($sort, $allowedSorts, true)) {
            $sort = '';
        }

        if (!in_array($dir, $allowedDirs, true)) {
            $dir = 'asc';
        }

        $sinhvienModel = $this->model('sinhvienModel');
        $result = $sinhvienModel->paging((int) $limit, (int) $offset, $keyword, $sort, $dir);

        $this->view('layout/masterlayout', [
            'viewname' => 'sinhvien/index',
            'sinhviens' => $result['sinhviens'],
            'title' => 'Danh sách sinh viên',
            'totalpage' => $result['totalpage'],
            'totalrecord' => $result['totalrecord'],
            'limit' => $limit,
            'offset' => $offset,
            'keyword' => $keyword,
            'sort' => $sort,
            'dir' => $dir
        ]);
    }

    public function create()
    {
        $lopModel = $this->model('lopModel');

        $this->view('layout/masterlayout', [
            'viewname' => 'sinhvien/create',
            'title' => 'Thêm sinh viên',
            'lops' => $lopModel->getAll()
        ]);
    }

    public function store()
    {
        $hoten = $_POST['hoten'] ?? '';
        $gioitinh = $_POST['gioitinh'] ?? '';
        $mssv = $_POST['mssv'] ?? '';
        $malop = $_POST['malop'] ?? '';

        $sinhvienModel = $this->model('sinhvienModel');
        $result = $sinhvienModel->create($hoten, $gioitinh, $mssv, $malop);

        if ($result) {
            header('Location: /sinhvien/index');
            return;
        }

        echo 'Thêm mới sinh viên không thành công';
    }

    public function edit($id)
    {
        $sinhvienModel = $this->model('sinhvienModel');
        $lopModel = $this->model('lopModel');
        $sinhvien = $sinhvienModel->getById((int) $id);

        if (!$sinhvien) {
            echo 'Không tìm thấy sinh viên';
            return;
        }

        $this->view('layout/masterlayout', [
            'viewname' => 'sinhvien/edit',
            'title' => 'Cập nhật sinh viên',
            'sinhvien' => $sinhvien,
            'lops' => $lopModel->getAll()
        ]);
    }

    public function update($id)
    {
        $hoten = $_POST['hoten'] ?? '';
        $gioitinh = $_POST['gioitinh'] ?? '';
        $mssv = $_POST['mssv'] ?? '';
        $malop = $_POST['malop'] ?? '';

        $sinhvienModel = $this->model('sinhvienModel');
        $result = $sinhvienModel->update((int) $id, $hoten, $gioitinh, $mssv, $malop);

        if ($result) {
            header('Location: /sinhvien/index');
            return;
        }

        echo 'Cập nhật sinh viên không thành công';
    }

    public function delete($id)
    {
        $sinhvienModel = $this->model('sinhvienModel');
        $result = $sinhvienModel->delete((int) $id);

        if ($result) {
            header('Location: /sinhvien/index');
            return;
        }

        echo 'Xóa sinh viên không thành công';
    }
}
?>
