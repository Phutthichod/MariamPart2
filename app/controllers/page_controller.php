<?php
    class page extends Controller{
        public function __construct(){
            parent::__construct();
            
        }
        public function index(){
            $this->view->render('survey','views/survey/index.php');
        }
        public function error(){
            require_once('views/page/error.php');
        }
    }
?>