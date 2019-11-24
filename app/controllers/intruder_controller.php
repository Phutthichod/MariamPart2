<?php
    class intruder extends Controller{
        public function __construct(){
            parent::__construct();
            
        }
        public function index(){
            $this->view->data = $this->model->getData();
            $this->view->render('intruder','views/intruder/index.php');
        }
    }
?>