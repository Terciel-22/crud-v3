<?php 
    require_once "model/StudentModel.php";
    require_once "view/StudentView.php";

    class StudentController
    {   
        private $model, $view;

        function __construct()
        {
            $this->model = new StudentModel();
            $this->view = new StudentView();
        }

        function index()
        {
            $students = $this->model->getStudents();
            $this->view->renderStudentList($students);
        }

        function create()
        {
            $this->view->renderCreateForm();
        }

        function store()
        {
            $errors = array();
            $first_name = $last_name = $age = "";

            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                if(empty($_POST["first_name"]))
                {
                    $errors["first_name"] = "First name is required!";
                }else 
                {
                    $first_name = $this->sanitizeInput($_POST['first_name']);
                }
                if(empty($_POST["last_name"]))
                {
                    $errors["last_name"] = "Last name is required!";
                }else 
                {
                    $last_name = $this->sanitizeInput($_POST['last_name']);
                }
                if(empty($_POST["age"]) || !is_numeric($_POST["age"]))
                {
                    $errors["age"] = "Age is required and must be numeric!";
                }else 
                {
                    $age = $this->sanitizeInput($_POST['age']);
                }

                if(count($errors) == 0)
                {
                    $this->model->storeStudent($first_name, $last_name, $age);
                    header("Location: /facebook/");
                } else 
                {
                    $this->view->renderCreateForm($errors);
                }
            }
        }

        function edit()
        {
            $id = $_GET["id"];
            $student = $this->model->getStudentByID($id);
            $this->view->renderEditForm($student);
        }

        function update()
        {
            $errors = array();
            $first_name = $last_name = $age = "";

            if($_SERVER["REQUEST_METHOD"] == "POST")
            {

                $id = $this->sanitizeInput($_POST['id']);

                if(empty($_POST["first_name"]))
                {
                    $errors["first_name"] = "First name is required!";
                }else 
                {
                    $first_name = $this->sanitizeInput($_POST['first_name']);
                }
                if(empty($_POST["last_name"]))
                {
                    $errors["last_name"] = "Last name is required!";
                }else 
                {
                    $last_name = $this->sanitizeInput($_POST['last_name']);
                }
                if(empty($_POST["age"]) || !is_numeric($_POST["age"]))
                {
                    $errors["age"] = "Age is required and must be numeric!";
                }else 
                {
                    $age = $this->sanitizeInput($_POST['age']);
                }

                if(count($errors) == 0)
                {
                    $this->model->updateStudent($id, $first_name, $last_name, $age);
                    header("Location: /facebook/");
                } else 
                {
                    $id = $_GET["id"];
                    $student = $this->model->getStudentByID($id);
                    $this->view->renderEditForm($student,$errors);
                }
            }
        }

        function delete($id)
        {
            $student = $this->model->deleteStudent($id);
            header("Location: /facebook/");
        }

        private function sanitizeInput($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    }
?>