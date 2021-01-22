<?php
    class Patient{

        // Connection
        private $conn;

        // Table
        private $db_table = "Patient";

        // Columns
        public $patientNo;
        public $name;
        public $mobile;
        public $age;
        public $Problem;
        public $checkedOn;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        
        // CREATE
        public function createPatient(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        name = :name, 
                        mobile = :mobile, 
                        age = :age, 
                        problem = :problem, 
                        checkedOn = :checkedOn";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->mobile=htmlspecialchars(strip_tags($this->mobile));
            $this->age=htmlspecialchars(strip_tags($this->age));
            $this->problem=htmlspecialchars(strip_tags($this->problem));
            $this->checkedOn=htmlspecialchars(strip_tags($this->checkedOn));
        
            // bind data
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":mobile", $this->mobile);
            $stmt->bindParam(":age", $this->age);
            $stmt->bindParam(":problem", $this->problem);
            $stmt->bindParam(":checkedOn", $this->checkedOn);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // SELECT
        public function getPatient(){
            $sqlQuery = "SELECT
                        patientNo, 
                        name, 
                        mobile, 
                        age, 
                        problem, 
                        checkedOn
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       patientNo = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->patientNo);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->name = $dataRow['name'];
            $this->mobile = $dataRow['mobile'];
            $this->age = $dataRow['age'];
            $this->problem = $dataRow['problem'];
            $this->checkedOn = $dataRow['checkedOn'];
        }        

        // UPDATE
        public function updatePatient(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        name = :name, 
                        mobile = :mobile, 
                        age = :age, 
                        problem = :problem, 
                        checkedOn = :checkedOn
                    WHERE 
                        patientNo = :patientNo";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->mobile=htmlspecialchars(strip_tags($this->mobile));
            $this->age=htmlspecialchars(strip_tags($this->age));
            $this->problem=htmlspecialchars(strip_tags($this->problem));
            $this->checkedOn=htmlspecialchars(strip_tags($this->checkedOn));
            $this->patientNo=htmlspecialchars(strip_tags($this->patientNo));
        
            // bind data
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":mobile", $this->mobile);
            $stmt->bindParam(":age", $this->age);
            $stmt->bindParam(":problem", $this->problem);
            $stmt->bindParam(":checkedOn", $this->checkedOn);
            $stmt->bindParam(":patientNo", $this->patientNo);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deletePatient(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE patientNo = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->patientNo=htmlspecialchars(strip_tags($this->patientNo));
        
            $stmt->bindParam(1, $this->patientNo);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>