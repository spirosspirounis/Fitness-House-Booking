<?php
class Database{
	
	private $host  = 'db24.grserver.gr:3306';
    private $user  = 'fitnessBooking';
    private $password   = "tI1?fq98";
    private $database  = "spirossp473158_fitness_house_booking"; 
    
    public function getConnection(){		
		$conn = new mysqli($this->host, $this->user, $this->password, $this->database);
		if($conn->connect_error){
			die("Error failed to connect to MySQL: " . $conn->connect_error);
		} else {
			return $conn;
		}
    }
}
?>