<?php
if(isset($_GET['controller'])&&isset($_GET['action'])){
    $controller = $_GET['controller'];
    $action = $_GET['action'];

}else{
    $controller = 'survey';
    $action = 'index';
}

$controllers = array('survey'=>['index','round','detail','insertRound','updateRound','insertSurvey','insertGI','getListIntruder','updateSurvey','updateGI'],'page'=>['index','error'],'group_staff_survey'=>['index','insert','update'],'intruder'=>['index']);
function call($controller,$action){
    require_once("app/controllers/".$controller."_controller.php"); 
    $c = new $controller;
    $c->loadModel($controller);
    $c->$action();
}

if(array_key_exists($controller,$controllers)){
    if(in_array($action,$controllers[$controller])){
        call($controller,$action);
    }else{
        call('page','error');
    }
}else{
    call('page','error');
}


?>