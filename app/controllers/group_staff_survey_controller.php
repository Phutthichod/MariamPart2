<?php
    class group_staff_survey extends Controller{
        public function __construct(){
            parent::__construct();
        }
        public function index(){
            // print_r($this->staff);
            $this->view->staff = $this->model->getStaff();
            $this->view->nameS = $this->model->getData();
            $this->view->render('GSS','views/GSS/index.php');  
        }
        public function insert(){
            $nameG = $_POST['name-group'];
            $nameS = $_POST['id-staff'];
            $this->model->insertData($nameG,$nameS);
            // $this->index();
        }
        public function update(){
            // print_r($_POST);
            $id = $_POST['id'];
            $nameG = $_POST['name-group-edit'];
            $nameGO = $_POST['name-group-old'];
            $nameS = $_POST['id-staff-edit'];
            $this->model->update($id,$nameG,$nameGO,$nameS);
            $this->index();
        }
    }
?>