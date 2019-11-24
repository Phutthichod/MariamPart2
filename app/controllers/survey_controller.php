<?php
    class survey extends Controller{
        public function __construct(){
            parent::__construct();
            
        }
        public function index(){
            $this->view->data = $this->model->getData();
            $this->view->zone = $this->model->getZone();
            $this->view->round = $this->model->getRound();
            $this->view->staff = $this->model->getGSS();
            $this->view->render('survey',"views/survey/index.php");
        }
        public function round(){
            $this->view->data = $this->model->getDataRound();
            $this->view->render('SR','views/SR/index.php');
        }
        public function detail(){
            $this->view->data = $this->model->getDataDetail($_GET['id']);
            $this->view->render('survey','views/survey/detail.php');
        }
        public function insertRound(){
            $round = $_POST['round'];
            $startTime = (explode(" ",($_POST['time'][0])))[0].":00";
            $endTime = (explode(" ",($_POST['time'][1])))[0].":00";
            $this->model->insertRound($round,$startTime,$endTime);
        }
        public function updateRound(){
            $roundO = $_POST['roundO'];
            $round = $_POST['round-edit'];
            $startTime = (explode(" ",($_POST['time-edit'][0])))[0].":00";
            $endTime = (explode(" ",($_POST['time-edit'][1])))[0].":00";
            $this->model->updateRound($roundO,$round,$startTime,$endTime);
            $this->round();
        }
        public function insertSurvey(){
            $idRound = $_POST['round'];
            $idZone = $_POST['zone'];
            $idStaff = $_POST['staff'];
            $date = $_POST['date'];
            $time = (explode(" ",($_POST['time'])))[0].":00";
            $this->model->insertSurvey($idRound,$idZone,$idStaff,$date,$time);
        }
        public function insertGI(){
            $id_zone = $_POST['id'];
            $time = (explode(" ",($_POST['time'])))[0].":00";
            $operation = $_POST['operation'];
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $amountI = sizeof($fname); 
            $zone = $_POST['zone'];
            $idR = $_POST['idR'];
            $this->model->insertGI($id_zone,$time,$operation,$fname, $lname, $amountI,$zone,$idR);
        }
        public function getListIntruder(){
            $id = $_POST['id'];
            $this->model->getListIntruder($id);
        }
        public function updateSurvey(){
            // print_r($_POST);
            $id_SR = $_POST['id_SR'];
            $id_SZ = $_POST['id_SZ'];
            $idRound = $_POST['round-edit'];
            $idZone = $_POST['zone-edit'];
            $idStaff = $_POST['staff-edit'];
            $date = $_POST['date-edit'];
            $time = (explode(" ",($_POST['time-edit'])))[0].":00";
            $this->model->updateSurvey($idRound,$idZone,$idStaff,$date,$time,$id_SR,$id_SZ);
        }
        public function updateGI(){
            // print_r($_POST);
            $time = (explode(" ",($_POST['time-edit'])))[0].":00";
            $operation = $_POST['operation-edit'];
            $fname = $_POST['fname-edit'];
            $lname = $_POST['lname-edit'];
            $amountI = sizeof($fname); 
            $id = $_POST['id'];
            $idI = $_POST['idI'];
            $zone = $_POST['zone'];
            $idR = $_POST['idR'];
            $id_zone = $_POST['id_zone'];
            $this->model->updateGI($id_zone,$id,$time,$operation,$fname, $lname, $amountI,$idI,$zone,$idR);
        } 
    }
?>