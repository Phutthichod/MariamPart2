<?php
    class intruder_Model extends Model{
        public function __construct(){
            parent::__construct();
        }
        public function getData(){
            $sql = "SELECT * FROM `intruder`";
            return $this->db->select($sql);
        } 
    }
?>