<?php

require_once '../app/core/Controller.php';
require_once '../app/models/lopModel.php';

class lop extends Controller
{
    public function index($limit = 5, $offset = 0, $message = '')
    {
        $allowedPageSizes = [5, 10, 20, 50];

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

        $lopModel = $this->model('lopModel');
        $result = $lopModel->paging($limit, $offset);

        $this->view('layout/masterlayout', [
            'viewname' => 'lop/index',
            'lops' => $result['lops'],
            'title' => 'Danh sách lớp học',
            'totalpage' => $result['totalpage'],
            'limit' => $limit,
            'offset' => $offset,
            'message' => $this->getMessageText($message)
        ]);
    }

    public function create()
    {
        $this->view('layout/masterlayout', [
            'viewname' => 'lop/create',
            'title' => 'Thêm lớp học'
        ]);
    }

    public function store()
    {
        $malop = trim($_POST['malop'] ?? '');
        $tenlop = trim($_POST['tenlop'] ?? '');
        $ghichu = trim($_POST['ghichu'] ?? '');

        $lopModel = $this->model('lopModel');
        $result = $lopModel->create($malop, $tenlop, $ghichu);

        if ($result) {
            header('Location: /lop/index');
            return;
        }

        echo 'Thêm lớp học mới không thành công';
    }

    public function edit($id)
    {
        $lopModel = $this->model('lopModel');
        $lop = $lopModel->getById((int) $id);

        if (!$lop) {
            echo 'Không tìm thấy lớp học';
            return;
        }

        $this->view('layout/masterlayout', [
            'viewname' => 'lop/edit',
            'title' => 'Cập nhật lớp học',
            'lop' => $lop
        ]);
    }

    public function update($id)
    {
        $tenlop = trim($_POST['tenlop'] ?? '');
        $ghichu = trim($_POST['ghichu'] ?? '');

        $lopModel = $this->model('lopModel');
        $result = $lopModel->update((int) $id, $tenlop, $ghichu);

        if ($result) {
            header('Location: /lop/index');
            return;
        }

        echo 'Cập nhật lớp học không thành công';
    }

    public function delete($id)
    {
        $lopModel = $this->model('lopModel');
        $lop = $lopModel->getById((int) $id);

        if (!$lop) {
            header('Location: /lop/index/5/0/not-found');
            return;
        }

        if ($lopModel->countSinhvienByMalop($lop['malop']) > 0) {
            header('Location: /lop/index/5/0/has-students');
            return;
        }

        $result = $lopModel->delete((int) $id);

        if ($result) {
            header('Location: /lop/index');
            return;
        }

        header('Location: /lop/index/5/0/delete-failed');
    }

    private function getMessageText($message)
    {
        switch ($message) {
            case 'has-students':
                return 'Không thể xóa lớp học vì vẫn còn sinh viên thuộc lớp này.';
            case 'not-found':
                return 'Không tìm thấy lớp học cần xóa.';
            case 'delete-failed':
                return 'Xóa lớp học không thành công.';
            default:
                return '';
        }
    }
}
?>
