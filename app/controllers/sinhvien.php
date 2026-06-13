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
        $allowedPageSizes = [5, 10, 20, 50];
        $allowedSorts = ['hoten', 'mssv'];
        $allowedDirs = ['asc', 'desc'];

        if (isset($_GET['limit'])) {
            $limit = (int) $_GET['limit'];
            $offset = 0;
        }

        $limit = (int) $limit;
        $offset = (int) $offset;

        if (!in_array($limit, $allowedPageSizes, true)) {
            $limit = 5;
            $offset = 0;
        }

        if (!in_array($sort, $allowedSorts, true)) {
            $sort = '';
        }

        if (!in_array($dir, $allowedDirs, true)) {
            $dir = 'asc';
        }

        $sinhvienModel = $this->model('sinhvienModel');
        $result = $sinhvienModel->paging($limit, $offset, $keyword, $sort, $dir);

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
            'lops' => $lopModel->getAll(),
            'sinhvien' => [],
            'error' => ''
        ]);
    }

    public function store()
    {
        $hoten = trim($_POST['hoten'] ?? '');
        $gioitinh = $_POST['gioitinh'] ?? '';
        $mssv = trim($_POST['mssv'] ?? '');
        $malop = $_POST['malop'] ?? '';

        $sinhvienModel = $this->model('sinhvienModel');
        $lopModel = $this->model('lopModel');

        if ($sinhvienModel->existsMssv($mssv)) {
            $this->view('layout/masterlayout', [
                'viewname' => 'sinhvien/create',
                'title' => 'Thêm sinh viên',
                'lops' => $lopModel->getAll(),
                'sinhvien' => [
                    'hoten' => $hoten,
                    'gioitinh' => $gioitinh,
                    'mssv' => $mssv,
                    'malop' => $malop
                ],
                'error' => 'MSSV đã tồn tại. Vui lòng nhập MSSV khác.'
            ]);
            return;
        }

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
            'lops' => $lopModel->getAll(),
            'error' => ''
        ]);
    }

    public function update($id)
    {
        $hoten = trim($_POST['hoten'] ?? '');
        $gioitinh = $_POST['gioitinh'] ?? '';
        $mssv = trim($_POST['mssv'] ?? '');
        $malop = $_POST['malop'] ?? '';

        $sinhvienModel = $this->model('sinhvienModel');
        $lopModel = $this->model('lopModel');

        if ($sinhvienModel->existsMssv($mssv, (int) $id)) {
            $this->view('layout/masterlayout', [
                'viewname' => 'sinhvien/edit',
                'title' => 'Cập nhật sinh viên',
                'sinhvien' => [
                    'ID' => (int) $id,
                    'hoten' => $hoten,
                    'gioitinh' => $gioitinh,
                    'mssv' => $mssv,
                    'malop' => $malop
                ],
                'lops' => $lopModel->getAll(),
                'error' => 'MSSV đã tồn tại. Vui lòng nhập MSSV khác.'
            ]);
            return;
        }

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
