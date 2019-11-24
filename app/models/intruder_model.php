<?php
    class intruder_Model extends Model{
        public function __construct(){
            parent::__construct();
        }
        public function getData(){
            $sql = "SELECT `firstname`,`lastname`,`id`,`id_intruder_group` FROM `intruder` WHERE `id_intruder_group` IS NOT NULL GROUP BY `firstname`,`lastname`,`id_intruder_group`";
            return $this->db->select($sql);
        } 
    }
?>