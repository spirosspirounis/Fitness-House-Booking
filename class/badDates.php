<?php
class Items{   
    
    private $baddatesTable = "badDates";      
    public $id;
	public $class;
	public $baddates;
    private $conn;
	
    public function __construct($db){
        $this->conn = $db;
    }	
	
	function read(){	
		if($this->id) {
			$stmt = $this->conn->prepare("SELECT * FROM ".$this->baddatesTable." WHERE id = ?");
			$stmt->bind_param("i", $this->id);					
		} else {
			$stmt = $this->conn->prepare("SELECT * FROM ".$this->baddatesTable);		
		}		
		$stmt->execute();			
		$result = $stmt->get_result();		
		return $result;	
	}
	
	function create(){
		
		$stmt = $this->conn->prepare("
			INSERT INTO ".$this->baddatesTable."(`class`, `baddates`)
			VALUES(?,?)");
		
		$this->class = htmlspecialchars(strip_tags($this->class));
		$this->baddates = htmlspecialchars(strip_tags($this->baddates));
		
		
		$stmt->bind_param("ss", $this->class, $this->baddates);
		
		if($stmt->execute()){
			return true;
		}
	 
		return false;		 
	}
		
	// function update(){
	 
	// 	$stmt = $this->conn->prepare("
	// 		UPDATE ".$this->baddatesTable." 
	// 		SET name= ?, time = ?, size = ? WHERE id = ?");
	 
	// 	$this->id = htmlspecialchars(strip_tags($this->id));
	// 	$this->name = htmlspecialchars(strip_tags($this->name));
	// 	$this->time = htmlspecialchars(strip_tags($this->time));
	// 	$this->size = htmlspecialchars(strip_tags($this->size));
	 
	// 	$stmt->bind_param("ssis", $this->name, $this->time, $this->size, $this->id);
		
	// 	if($stmt->execute()){
	// 		return true;
	// 	}
	 
	// 	return false;
	// }
	
	// function delete(){
		
	// 	$stmt = $this->conn->prepare("
	// 		DELETE FROM ".$this->baddatesTable." 
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