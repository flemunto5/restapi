<?php 
     
     /**
      * DB Connection
      */
     class Database
     {
     	private $host = 'sql2.freesqldatabase.com';
     	private $db_name = 'sql2250976';
     	private $username = 'sql2250976';
     	private $password = 'cQ4%wU2*';
     	private $conn;

     	public function connect()
     	{
     		$this->conn = null;

     		try{
     			$this->conn=new PDO('mysql:host='.$this->host.';dbname=' .$this->db_name, $this->username, $this->password);
     			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

     		}catch(PDOException $e){
     			echo 'Connection Error : ' . $e->getMessage();

     		}
           return $this->conn;
     	}
     }
?>