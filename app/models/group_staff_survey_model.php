<?php
    class group_staff_survey_Model extends Model{
        public function __construct(){
            parent::__construct();
        }
        public function insertData($id,$nameG,$nameS){ 
            $sql = "INSERT INTO `group_staff`(`id_group_staff`,`num`) VALUE('$nameG',3)";
            $this->db->insert($sql);
            $sql = "UPDATE `staff` SET `id_group_staff` = '$nameG' WHERE `id_staff` = $nameS[0] OR `id_staff` = $nameS[1] OR `id_staff` = $nameS[2]";
            $this->db->update($sql);
            header("Location: http://localhost/db_029/?controller=group_staff_survey&action=index");
        }
        public function getData(){
            $sql = "SELECT * FROM `group_staff` join `staff` 
                    on (`group_staff`.`id_group_staff` = `staff`.`id_group_staff`)";
            return $this->db->select($sql);
        }
        public function getStaff(){
            $sql = "SELECT `id_staff`,`name`,`lname` FROM `staff` WHERE `id_group_staff` IS NULL";
            return $this->db->select($sql);
        }
        public function update($nameG,$nameGO,$nameS){
            if($nameG!=$nameGO){
                $sql = "UPDATE `group_staff` SET `group_staff`.`id_group_staff` = '$nameG' WHERE `group_staff`.`id_group_staff` = '$nameGO'";
                $this->db->update($sql);
            }
            $sql = "UPDATE `staff` SET `id_group_staff` = NULL WHERE `id_group_staff` = '$nameG'";
            $this->db->update($sql);
            $sql = "UPDATE `staff` SET `id_group_staff` = '$nameG' WHERE `id_staff` = $nameS[0] OR `id_staff` = $nameS[1] OR `id_staff` = $nameS[2]";
            $this->db->update($sql);
        }
    }
?>