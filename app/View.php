<?php
    class view{
        public function __construct(){
            //this is new view
        }
        public function render($Isnav = '',$views = ''){
            if($Isnav!=''){
                require("layout/header.php");
                require("layout/navbar.php");
                require($views);
                require("layout/footer.php");
            }
        }
    }

?>