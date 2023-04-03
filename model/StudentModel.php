<?php

    require_once("config/PDOHandler.php");

    class StudentModel
    {
        private $pdoHandler;

        function __construct()
        {
            $this->pdoHandler = new PDOHandler();
        }

        public function getStudents()
        {
            $sql = "SELECT * FROM students";
            $this->pdoHandler->prepareStatement($sql);
            $this->pdoHandler->executeStatement();
            return $this->pdoHandler->getAllRows();
        }

        public function getStudentByID($id)
        {
            $sql = "SELECT * FROM students WHERE id = :id";
            $this->pdoHandler->prepareStatement($sql);
            $this->pdoHandler->bindValueToStatement(":id",$id);
            $this->pdoHandler->executeStatement();
            return $this->pdoHandler->getSingleRow();
        }

        public function storeStudent($first_name, $last_name, $age)
        {
            $sql = "INSERT INTO students(first_name, last_name, age) VALUES (:first_name, :last_name, :age)";
            $this->pdoHandler->prepareStatement($sql);
            $this->pdoHandler->bindValueToStatement(":first_name",$first_name);
            $this->pdoHandler->bindValueToStatement(":last_name",$last_name);
            $this->pdoHandler->bindValueToStatement(":age",$age);
            return $this->pdoHandler->executeStatement();
        }

        public function updateStudent($id, $first_name, $last_name, $age)
        {
            $sql = "UPDATE students SET first_name=:first_name, last_name=:last_name, age=:age WHERE id=:id";
            $this->pdoHandler->prepareStatement($sql);
            $this->pdoHandler->bindValueToStatement(":id",$id);
            $this->pdoHandler->bindValueToStatement(":first_name",$first_name);
            $this->pdoHandler->bindValueToStatement(":last_name",$last_name);
            $this->pdoHandler->bindValueToStatement(":age",$age);
            return $this->pdoHandler->executeStatement();
        }

        public function deleteStudent($id)
        {
            $sql = "DELETE FROM students WHERE id=:id";
            $this->pdoHandler->prepareStatement($sql);
            $this->pdoHandler->bindValueToStatement(":id",$id);
            return $this->pdoHandler->executeStatement();
        }

        public function searchStudent($target)
        {
            $sql = "SELECT * FROM students WHERE first_name LIKE :first_name OR last_name LIKE :last_name OR age LIKE :age";
            $this->pdoHandler->prepareStatement($sql);
            $this->pdoHandler->bindValueToStatement(":first_name","%$target%");
            $this->pdoHandler->bindValueToStatement(":last_name","%$target%");
            $this->pdoHandler->bindValueToStatement(":age","%$target%");
            $this->pdoHandler->executeStatement();
            return $this->pdoHandler->getAllRows();
        }
    }
?>