<?php

    class Database{
        private static $host = "localhost";
        private static $username = "root";
        private static $password = "";
        private static $db_name = "crud";

        private static $connection = null;
        public function __construct(){
            self::$connection = mysqli_connect(
                self::$host,
                self::$username,
                self::$password,
                self::$db_name

            );
        }

        public function getConnection(){
            if( !isset( self::$connection ) ){
                self::$connection = new Database();
            }
            return self::$connection;
        }
    }