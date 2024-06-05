<?php

    require 'database.php';
   

    class Crud{
        private static $connection ;

        public function __construct(){
            $database = new Database();
            self::$connection = $database->getConnection();
        }

        //validation of data
        private function validateItem($item_arr){
            
            // Required Fields
            $requiredFields = ['name', 'email', 'password'];
            foreach ($requiredFields as $field) {
                if (!isset($item_arr[$field]) || empty($item_arr[$field])) {
                    return "Missing or empty required field: $field";
                }
            }

            // Field Length
            $fieldLengths = [
                'name' => ['min' => 3, 'max' => 50],
                'email' => ['min' => 10, 'max' => 50],
            ];
            foreach ($fieldLengths as $field => $length) {
                $value = $item_arr[$field] ?? '';
                $valueLength = strlen($value);
                if ($valueLength < $length['min'] || $valueLength > $length['max']) {
                    return "Invalid length for field $field";
                }
            }
            
            // Validate email format
            $email = $item_arr['email'];
            
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return "Invalid email format";
        
            }

            
            //validate password
            $password = $item_arr['password'];
            $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z\d]).{8,}$/';

            if (!preg_match($pattern, $password)) {
                return "Invalid password format";
            }


            return true; // Validation successful
        }
        


        // Hash Password
        private function hashPassword($password) {
            return password_hash($password, PASSWORD_DEFAULT);
        }



        //insert to the database
        public function insert($table, $item_arr){

            $validationResult = $this->validateItem($item_arr);

            if ($validationResult !== true) {
                echo $validationResult;
                return;
        }

            $password = $item_arr['password'];
            $hashedPassword = $this->hashPassword($password);

            $statement = "Insert into ". $table;

            $column = "(";
            $values = "values(";

            foreach( $item_arr as $key => $value){
                $column .= $key. ",";
                if ($key === 'password') {
                    $values .= "'" . $hashedPassword . "',";
                } elseif (is_int($value)) {
                    $values .= $value . ",";
                } else {
                    $values .= "'" . $value . "',";
                }
            }

            $column = rtrim($column,",");
            $values = rtrim($values,",");
            $column .= ")";
            $values .= ")";
            
            $statement .= $column . $values;

            $result = mysqli_query(self::$connection, $statement);
            if($result){
                echo "Inserted successfully";
            }
        
        }



    // Get User ID by Email
    private function getUserIdByEmail($email) {
        $query = "SELECT lid FROM login WHERE email = '$email'";
        $result = mysqli_query(self::$connection, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            return $row['lid'];
        }

        return null;
    }




    // Password Change
    public function changePassword($tablename,$item_arr, $oldPassword, $newPassword) {
        // Verify Old Password
        $userId = $this->getUserIdByEmail($item_arr['email']);
        $query = "SELECT password FROM " . $tablename . " WHERE lid = " . $userId;
        $result = mysqli_query(self::$connection, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $hashedPassword = $row['password'];
            
            if (password_verify($oldPassword, $hashedPassword)) {
                // Old password is correct, proceed with password change
                
                $hashedNewPassword = $this->hashPassword($newPassword);
                
                $updateQuery = "UPDATE " . $tablename. " SET password = '".$hashedNewPassword."' WHERE lid = ".$userId;
                $updateResult = mysqli_query(self::$connection, $updateQuery);
                
                if ($updateResult) {
                    echo "Password changed successfully";
                } else {
                    echo "Failed to change password";
                }
                
                return;
            }
        }

        echo "Old password is incorrect";
    }



    public function deleteUser($tableName) {
        $userId = $this->getUserIdByEmail($item_arr['email']);
        $query = "DELETE FROM $tableName WHERE lid = $userId";
        $result = mysqli_query(self::$connection, $query);
    
        if ($result) {
            echo "User deleted successfully";
        } else {
            echo "Failed to delete user";
        }
    }
    
}