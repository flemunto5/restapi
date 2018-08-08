<?php

 /**
  * 
  */
 class County
 {
 	//DB stuff
 	private $conn;
 	private $table = 'county';

 	//post properties
 	public $id;
 	public $countyName;

 	//constructor with DB
 	public function __construct($db)
 	{
 		$this->conn=$db;
    }
 		//get posts
 		public function read(){

 			//create query
 			$query = 'SELECT * FROM '.$this->table.' ORDER BY id DESC';

 			//prepare statement
 			$stmt = $this->conn->prepare($query);

 			//execute query
 			$stmt->execute();

 			return $stmt;


 		}

 		//get single post
 		public function read_single(){
 			
 			//create query
 			$query = 'SELECT * FROM '.$this->table.' WHERE id=? LIMIT 0,1';
 			//prepare statement
 			$stmt = $this->conn->prepare($query);

 			//Bind ID
 			$stmt->bindParam(1,$this->id);

 			//execute query
 			$stmt->execute();

 			$row=$stmt->fetch(PDO::FETCH_ASSOC);

 			//set properties
 			$this->id = $row['id'];
 			$this->countyName= $row['countyName'];

 		}

 		public function create(){

 			//create query
 			$query ='INSERT INTO '.$this->table.'
 			SET countyName = :countyName';

 			//prepare statement
 			$stmt = $this->conn->prepare($query);

 			//clean data
 			$this->countyName = htmlspecialchars(strip_tags($this->countyName));

 			//Bind ID
 			$stmt->bindParam(':countyName',$this->countyName);

 			//execute query
 			if($stmt->execute()){
 				return true;
 			}
            //print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);
 			return false;
 		}

 		public function update(){

 			//create query
 			$query ='UPDATE '.$this->table.'
 			SET countyName = :countyName WHERE id=:id';

 			//prepare statement
 			$stmt = $this->conn->prepare($query);

 			//clean data
 			$this->countyName = htmlspecialchars(strip_tags($this->countyName));
 			$this->id = htmlspecialchars(strip_tags($this->id));

 			//Bind ID
 			$stmt->bindParam(':countyName',$this->countyName);
 			$stmt->bindParam(':id',$this->id);

 			//execute query
 			if($stmt->execute()){
 				return true;
 			}
            //print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);
 			return false;
 		}

 		public function delete(){

 			//create query
 			$query = 'DELETE FROM ' . $this->table.' WHERE id = :id';

 			//prepare statement
 			$stmt = $this->conn->prepare($query);

 			//clean data
 			$this->id = htmlspecialchars(strip_tags($this->id));

 			//Bind ID
 			$stmt->bindParam(':id',$this->id);

 			//execute query
 			if($stmt->execute()){
 				return true;
 			}
            //print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);
 			return false;


 		}
 	
 }

?>