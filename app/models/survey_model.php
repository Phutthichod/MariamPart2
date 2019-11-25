<?php
    class survey_Model extends Model{
        public function __construct(){
            parent::__construct();
        }
        public function insertRound($round,$startTime,$endTime){
            $sql = "INSERT INTO `roundOfSurvey`(`id`,`start`,`end`) VALUE($round,'$startTime','$endTime')";
            $this->db->insert($sql);
            header("Location: http://localhost/db_029/?controller=survey&action=round");
        }
        public function getDataRound(){
            $sql = "SELECT * FROM `roundOfSurvey`";
            return $this->db->select($sql);
        }
        public function updateRound($roundO,$round,$startTime,$endTime){
            $sql = "UPDATE `roundOfSurvey` SET `id` = $round, `start` = '$startTime', `end` = '$endTime' WHERE `id` = $roundO";
            $this->db->update($sql);
        }
        public function getZone(){
            $sql = "SELECT *  FROM `zone`";
            return $this->db->select($sql);
        }
        public function getRound(){
            $sql = "SELECT *  FROM `roundOfSurvey`";
            return $this->db->select($sql);
        }
        public function getGSS(){
            $sql = "SELECT *  FROM `group_staff`";
            return $this->db->select($sql);
        }
        public function insertSurvey($idRound,$idZone,$idStaff,$date,$time){
            $sql = "INSERT INTO `survey_round`(`id_round`,`id_group_staff`,`date`) VALUE($idRound,'$idStaff','$date')";
            $idRound = $this->db->insert($sql);
            $sql = "INSERT INTO `survey_of_zone`(`id_zone`,`id_survey_round`,`time`) VALUE('$idZone',$idRound,'$time')";
            $this->db->insert($sql);
            header("Location: http://localhost/db_029/?controller=survey&action=index");
        }
        public function getData(){
            $sql = "SELECT COUNT(`intruder_group`.`id`) as `amountI`,`survey_round`.`id`  as `id_SR`,`date`,`id_round`,`id_group_staff`,`survey_of_zone`.`id` as `id_SZ`,`survey_of_zone`.`time` as `time_SZ`,`zone`.`id_zone`,`id_survey_round`,`general_condition`,`distace`,`area`,`name`
            FROM `survey_round` join `survey_of_zone` 
                       on (`survey_round`.`id` = `survey_of_zone`.`id_survey_round`) join `zone`
                       on (`zone`.`id_zone`=`survey_of_zone`.`id_zone`) left join `intruder_group` on (`intruder_group`.`id_survey_of_zone` = `survey_of_zone`.`id`)
                       GROUP BY `survey_of_zone`.`id`";
            return $this->db->select($sql);
        }
        public function insertGI($id_zone,$time,$operation,$fname, $lname, $amountI,$zone,$idR){
            $sql = "INSERT INTO `intruder_group`(`id_survey_of_zone`,`operator`,`amount_intruder`,`time`) VALUE($id_zone,'$operation',$amountI,'$time')";
            $idI= $this->db->insert($sql);
            foreach($fname as $key => $value){
                $sql = "INSERT INTO `intruder`(`firstname`,`lastname`,`id_intruder_group`) VALUE('$value',"."'$lname[$key]'".",$idI)";
                $this->db->insert($sql);
            }
            header("Location: http://localhost/db_029/?controller=survey&action=detail&zone=$zone&id=$id_zone&idRound=$idR");
        }
        public function getDataDetail($id){
            $sql = "SELECT *,COUNT(`intruder`.`id`) as `amount` FROM  `survey_of_zone` join `intruder_group`
            on (`intruder_group`.`id_survey_of_zone` = `survey_of_zone`.`id`) join `intruder`
            on (`intruder`.`id_intruder_group` = `intruder_group`.`id`) WHERE `survey_of_zone`.`id` = $id
            group BY  `intruder_group`.`id` ORDER BY `intruder_group`.`time`" ;
            return $this->db->select($sql);
        }
        public function getDataDetailList($id){
            $sql = "SELECT * FROM  `survey_of_zone` join `intruder_group`
            on (`intruder_group`.`id_survey_of_zone` = `survey_of_zone`.`id`) join `intruder`
            on (`intruder`.`id_intruder_group` = `intruder_group`.`id`) WHERE `survey_of_zone`.`id` = $id
            ORDER BY `intruder_group`.`time`" ;
            return $this->db->select($sql);
        }
        public function getListIntruder($id){
            $sql = "SELECT * FROM `intruder` WHERE `intruder`.`id_intruder_group` = $id";
            echo json_encode($this->db->select($sql));
        }
        public function updateSurvey($idRound,$idZone,$idStaff,$date,$time,$id_SR,$id_SZ){
            $sql = "UPDATE `survey_round` SET `id_round` =  '$idRound',`id_group_staff` = '$idStaff',`date` ='$date'  WHERE `id` = $id_SR";
            $this->db->update($sql);
            $sql = "UPDATE `survey_of_zone` SET `id_zone` = '$idZone',`time` = '$time' WHERE `id` = $id_SZ";
            $this->db->update($sql);
            header("Location: http://localhost/db_029/?controller=survey&action=index");
        } 
        public function updateGI($id_zone,$id,$time,$operation,$fname, $lname, $amountI,$idI,$zone,$idR){
            $sql = "UPDATE `intruder_group` SET `operator` = '$operation',`amount_intruder` = $amountI,`time` = '$time' WHERE `id` = $id";
            $this->db->UPDATE($sql);
            foreach($idI as $val){
                $sql = "DELETE FROM `intruder` WHERE `id_intruder_group` = $id AND `id` = $val";
                $this->db->delete($sql);
            }
            foreach($fname as $key => $value){
                $sql = "INSERT INTO `intruder`(`firstname`,`lastname`,`id_intruder_group`) VALUE('$value',"."'$lname[$key]'".",$id)";
                $this->db->insert($sql);
            }
            
            header("Location: http://localhost/db_029/?controller=survey&action=detail&zone=$zone&id=$id_zone&idRound=$idR");
        }
        public function getDataOption($date ,$round,$zone,$group,$intruder){
            $d = '=';
            $r = '=';
            $z = '=';
            $g = '=';
            $i = '<=';
            if($group === '0') $g = '<>';
            if($date === '0') $d = '<>';
            if($zone === '0') $z = '<>';
            if($round === '0') $r = '<>';
            if($intruder == 0) $i= '>=';
            if($intruder == 1) $i= '>';
            $sql = "SELECT COUNT(`intruder_group`.`id`) as `amountI`,`survey_round`.`id`  as `id_SR`,`date`,`id_round`,`id_group_staff`,`survey_of_zone`.`id` as `id_SZ`,`survey_of_zone`.`time` as `time_SZ`,`zone`.`id_zone`,`id_survey_round`,`general_condition`,`distace`,`area`,`name`
            FROM `survey_round` join `survey_of_zone` 
                       on (`survey_round`.`id` = `survey_of_zone`.`id_survey_round`) join `zone`
                       on (`zone`.`id_zone`=`survey_of_zone`.`id_zone`) left join `intruder_group` on (`intruder_group`.`id_survey_of_zone` = `survey_of_zone`.`id`)
                        WHERE  `zone`.`id_zone` $z '$zone' AND`date` $d '$date' AND `id_round` $r $round AND `id_group_staff` $g '$group'
                         GROUP BY `survey_of_zone`.`id` HAVING `amountI` $i 0";
             echo json_encode($this->db->select($sql));
            //  print_r($this->db->select($sql));

        }
        
    }
?>