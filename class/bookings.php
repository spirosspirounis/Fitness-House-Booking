<?php
class Items{   
    
    private $booksTable = "bookings";      
    public $id;
    public $class;
    public $date;
	public $time;
	public $username;
    public $email;
    public $phone_number;
    private $conn;
	
    public function __construct($db){
        $this->conn = $db;
    }	
	
	function read(){	
		if($this->id) {
			$stmt = $this->conn->prepare("SELECT * FROM ".$this->booksTable." WHERE id = ?");
			$stmt->bind_param("i", $this->id);					
		} else {
			$stmt = $this->conn->prepare("SELECT * FROM ".$this->booksTable);		
		}		
		$stmt->execute();			
		$result = $stmt->get_result();		
		return $result;	
	}
	
	function create(){
		
		$stmt = $this->conn->prepare("
			INSERT INTO ".$this->booksTable."(`class`, `date`, `time`, `username`, `email`, `phone_number`)
			VALUES(?,?,?,?,?,?)");
		
		$this->class = htmlspecialchars(strip_tags($this->class));
		$this->date = htmlspecialchars(strip_tags($this->date));
		$this->time = htmlspecialchars(strip_tags($this->time));
		$this->username = htmlspecialchars(strip_tags($this->username));
		$this->email = htmlspecialchars(strip_tags($this->email));
		$this->phone_number = htmlspecialchars(strip_tags($this->phone_number));
		
		
		$stmt->bind_param("ssssss", $this->class, $this->date, $this->time, $this->username, $this->email, $this->phone_number);
		
		if($stmt->execute()){
			return true;
		}
	 
		return false;		 
	}
		
	function update(){
	 
		$stmt = $this->conn->prepare("
			UPDATE ".$this->booksTable." 
			SET class= ?, date = ?, time = ?, username = ?, email = ?, phone_number = ? WHERE id = ?");
	 
		$this->id = htmlspecialchars(strip_tags($this->id));
		$this->class = htmlspecialchars(strip_tags($this->class));
		$this->date = htmlspecialchars(strip_tags($this->date));
		$this->time = htmlspecialchars(strip_tags($this->time));
		$this->username = htmlspecialchars(strip_tags($this->username));
		$this->email = htmlspecialchars(strip_tags($this->email));
		$this->phone_number = htmlspecialchars(strip_tags($this->phone_number));
	 
		$stmt->bind_param("ssssss", $this->class, $this->date, $this->time, $this->username, $this->email, $this->phone_number, $this->id);
		
		if($stmt->execute()){
			return true;
		}
	 
		return false;
	}
	
	// function delete(){
		
	// 	$stmt = $this->conn->prepare("
	// 		DELETE FROM ".$this->booksTable." 
	// 		WHERE id = ?");
			
	// 	$this->id = htmlspecialchars(strip_tags($this->id));
	 
	// 	$stmt->bind_param("i", $this->id);
	 
	// 	if($stmt->execute()){
	// 		return true;
	// 	}
	 
	// 	return false;		 
	// }
}
?>