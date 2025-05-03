<?php

if (!class_exists('DBController')) {
    class DBController
    {
        // Database Connection Properties
        protected $host = 'db';             // Docker container name
        protected $user = 'user';           // from docker-compose
        protected $password = 'pass';       // from docker-compose
        protected $database = "mydb";

        public $con = null;

        public function __construct()
        {
            $this->con = mysqli_connect($this->host, $this->user, $this->password, $this->database);
            if (!$this->con){
                echo "Connection Failed: " . mysqli_connect_error();
            }
        }

        public function __destruct()
        {
            $this->closeConnection();
        }

        protected function closeConnection(){
            if ($this->con != null ){
                $this->con->close();
                $this->con = null;
            }
        }
    }
}
