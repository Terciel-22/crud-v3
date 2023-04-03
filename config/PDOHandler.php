<?php 
    class PDOHandler
    {
        private $db,$stmt;

        function __construct()
        {   
            $dns = "mysql:host=localhost;dbname=crud;port=3306;charset=utf8mb4";
            $username = "root";
            $password = "";
            $option = [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_OBJ];
            try {
                $this->db = new PDO($dns,$username,$password,$option);
            } catch(PDOException $e)
            {
                echo "Error: ". $e->getMessage();
                exit();
            }
        }

        public function prepareStatement($sql)
        {
            $this->stmt = $this->db->prepare($sql);
        }

        public function bindValueToStatement($param, $value, $type=null)
        {
            if(is_null($type))
            {
                switch(true)
                {
                    case is_int($value):
                        $type = PDO::PARAM_INT;
                        break;
                    case is_bool($value):
                        $type = PDO::PARAM_BOOL;
                        break;
                    case is_null($value):
                        $type = PDO::PARAM_NULL;
                        break;
                    default:
                        $type = PDO::PARAM_STR;
                }
            }

            try {
                $this->stmt->bindValue($param, $value, $type);
            } catch(PDOException $e)
            {
                echo "Error: ". $e->getMessage();
                exit();
            }
        }

        public function executeStatement()
        {
            try {
                return $this->stmt->execute();
            } catch(PDOException $e)
            {
                echo "Error: ". $e->getMessage();
                exit();
            }
        }

        public function getRowCount()
        {
            try {
                return $this->stmt->rowCount();
            } catch(PDOException $e)
            {
                echo "Error: ". $e->getMessage();
                exit();
            }
        }

        public function getSingleRow()
        {
            try {
                return $this->stmt->fetch();
            } catch(PDOException $e)
            {
                echo "Error: ". $e->getMessage();
                exit();
            }
        }

        public function getAllRows()
        {
            try {
                return $this->stmt->fetchAll();
            } catch(PDOException $e)
            {
                echo "Error: ". $e->getMessage();
                exit();
            }
        }
    }
?>