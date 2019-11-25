<?php
    class group_staff_survey_Model extends Model{
        public function __construct(){
            parent::__construct();
        }
        public function insertData($nameG,$nameS){ 
            $sql = "INSERT INTO `group_staff`(`name`) VALUE('$nameG')";
            $id = $this->db->insert($sql);
            $sql = "UPDATE `staff` SET `id_group_staff` = '$id' WHERE `id_staff` = $nameS[0] OR `id_staff` = $nameS[1] OR `id_staff` = $nameS[2]";
            $this->db->update($sql);
            header("Location: http://localhost/db_029/?controller=group_staff_survey&action=index");
        }
        public function getData(){
            $sql = "SELECT *, `group_staff`.`name` AS `GN`,`staff`.`name` AS `SN` FROM `group_staff` join `staff` 
            on (`group_staff`.`id_group_staff` = `staff`.`id_group_staff`)";
            return $this->db->select($sql);
        }
        public function getStaff(){
            $sql = "SELECT `id_staff`,`name`,`lname` FROM `staff` WHERE `id_group_staff` IS NULL";
            return $this->db->select($sql);
        }
        public function update($id,$nameG,$nameGO,$nameS){
            if($nameG!=$nameGO){
                $sql = "UPDATE `group_staff` SET `group_staff`.`name` = '$nameG' WHERE `group_staff`.`id_group_staff` = '$id'";
                $this->db->update($sql);
            }
            $sql = "UPDATE `staff` SET `id_group_staff` = NULL WHERE `id_group_staff` = '$id'";
            $this->db->update($sql);
            $sql = "UPDATE `staff` SET `id_group_staff` = '$id' WHERE `id_staff` = $nameS[0] OR `id_staff` = $nameS[1] OR `id_staff` = $nameS[2]";
            $this->db->update($sql);
            header("Location: http://localhost/db_029/?controller=group_staff_survey&action=index");
        }
    }
?>