<?php

    require_once '../app/core/Controller.php';
    require_once '../app/models/sinhvienModel.php';
    class sinhvien extends Controller {
        public function index(){
            $sinhvienModel = $this->model('sinhvienModel');
            $sinhviens = $sinhvienModel->getAllSinhVien();

            $this->view("layout/masterlayout", ["viewname" => "sinhvien/index","sinhviens" => $sinhviens, "title" => "Danh sach sinh vien"]);
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