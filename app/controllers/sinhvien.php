<?php

    require_once '../app/core/Controller.php';
    require_once '../app/models/sinhvienModel.php';
    class sinhvien extends Controller {
        public function index($limit = 5, $offset = 0){
            $sinhvienModel = $this->model('sinhvienModel');
            $result = $sinhvienModel->paging($limit, $offset);
            $sinhviens = $result['sinhviens'];
            $totalpage = $result['totalpage'];
            $this->view('layout/masterlayout', ['viewname' => 'sinhvien/index', 'sinhviens' => $sinhviens, 'title' => 'Danh sách sinh viên', 'totalpage'=>$totalpage]);
        }

        public function create(){
           require_once '../app/views/sinhvien/create.php';
        }

        public function store(){
            $hoten = $_POST['hoten'];
            $gioitinh = $_POST['gioitinh'];
            $mssv = $_POST['mssv'];
            $sinhvienModel = $this->model('sinhvienModel');
            $result = $sinhvienModel->create($hoten, $gioitinh, $mssv);
            if($result) {
                header("Location: /sinhvien/index");
            } else {
                echo "Thêm mới sinh viên thất bại";
            }
        }
    }
?>