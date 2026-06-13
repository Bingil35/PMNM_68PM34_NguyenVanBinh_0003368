<?php

require_once '../app/core/Controller.php';
require_once '../app/models/lopModel.php';

class lop extends Controller
{
    public function index($limit = 5, $offset = 0)
    {
        $lopModel = $this->model('lopModel');
        $result = $lopModel->paging((int) $limit, (int) $offset);

        $this->view('layout/masterlayout', [
            'viewname' => 'lop/index',
            'lops' => $result['lops'],
            'title' => 'Danh sách lớp học',
            'totalpage' => $result['totalpage'],
            'limit' => $limit,
            'offset' => $offset
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
        $malop = $_POST['malop'] ?? '';
        $tenlop = $_POST['tenlop'] ?? '';
        $ghichu = $_POST['ghichu'] ?? '';

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
        $malop = $_POST['malop'] ?? '';
        $tenlop = $_POST['tenlop'] ?? '';
        $ghichu = $_POST['ghichu'] ?? '';

        $lopModel = $this->model('lopModel');
        $result = $lopModel->update((int) $id, $malop, $tenlop, $ghichu);

        if ($result) {
            header('Location: /lop/index');
            return;
        }

        echo 'Cập nhật lớp học không thành công';
    }

    public function delete($id)
    {
        $lopModel = $this->model('lopModel');
        $result = $lopModel->delete((int) $id);

        if ($result) {
            header('Location: /lop/index');
            return;
        }

        echo 'Xóa lớp học không thành công';
    }
}
?>
