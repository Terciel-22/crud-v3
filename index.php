<?php 

    require_once "controller/StudentController.php";
    
    $controller = new StudentController();
    $controller->index();
    echo '<a href="/crud-v3/create.php">Add new</a>';
    if(isset($_GET["delete_id"]))
    {
        $controller->delete($_GET["delete_id"]);
    }
?>