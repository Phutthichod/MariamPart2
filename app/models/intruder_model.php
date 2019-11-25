<?php
    class intruder_Model extends Model{
        public function __construct(){
            parent::__construct();
        }
        public function getData(){
            $sql = "SELECT `firstname`,`lastname`,`id_intruder_group`,`zone`.`name`,`intruder_group`.`time` FROM `intruder` join `intruder_group` on (`intruder`.`id_intruder_group` = `intruder_group`.`id`) join 
            `survey_of_zone` on (`survey_of_zone`.`id` = `intruder_group`.`id_survey_of_zone`) join `zone` on (`zone`.`id_zone` = `survey_of_zone`.`id_zone`) WHERE `id_intruder_group` IS NOT NULL GROUP BY `firstname`,`lastname`,`id_intruder_group`";
            return $this->db->select($sql);
        } 
    }
?>