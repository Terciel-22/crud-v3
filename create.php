<?php 
    require_once "controller/StudentController.php";

    $controller = new StudentController();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $controller->store();
    } else 
    {
        $controller->create();
    }
?>