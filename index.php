<?php 

    require_once "controller/StudentController.php";
    
    $controller = new StudentController();
    $controller->index();
    
    if(isset($_GET["delete_id"]))
    {
        $controller->delete($_GET["delete_id"]);
    }
?>