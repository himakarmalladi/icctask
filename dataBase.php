<?php
class dataBase{
	private  $host = 'localhost';
	private  $usernamae = 'root';
	private  $password = '';
	private  $database = 'icc_task';
	public $conn;
	public function __construct(){
		$dsn = "mysql:host=$this->host;dbname=$this->database;charset=utf8";
		$this->conn = new PDO($dsn, $this->usernamae, $this->password,[
			PDO::ATTR_EMULATE_PREPARES => false, 
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		  ] );
	}
	public function pdo_insert_query($postData){
		if(empty($postData)) return false;
		$query = "INSERT INTO result (rollno, subject, mark_obtain, result, grade) VALUES (:rollno, :subject, :mark_obtain, :result, :grade)";
		$postData['Result'] = $postData['Result']=='Pass'?1:0;
    	$data = array(':rollno'=>$postData['Roll_Number'], ':subject'=>$postData['Subject'], ':mark_obtain'=>$postData['Marks_Obtain'], ':result'=>$postData['Result'],':grade'=>$postData['Grade']);
		$statement = $this->conn->prepare($query);
		$statement->execute($data);
		$insertId = $this->conn->lastInsertId();
		return $insertId;
	}
	public function pdo_update_query($postData){
		if(empty($postData)) return false;
		$query = "UPDATE result SET rollno=:rollno, subject=:subject, mark_obtain=:mark_obtain, result=:result, grade=:grade WHERE id=:resultid";
		$postData['Result'] = $postData['Result']=='Pass'?1:0;
    	$data = array(':rollno'=>$postData['Roll_Number'], ':subject'=>$postData['Subject'], ':mark_obtain'=>$postData['Marks_Obtain'], ':result'=>$postData['Result'],':grade'=>$postData['Grade'],'resultid'=>$postData['resultid']);
		$statement = $this->conn->prepare($query);
		$statement->execute($data);
		return $postData['resultid'];
	}
	public function pdo_delete_query($resultid){
		if($resultid=='') return false;
		$statement = $this->conn->prepare("DELETE FROM result where id=:resultid");
		$statement->execute(array(':resultid'=>$resultid));
		return $resultid;
	}
	public function pdo_fetchOne($columns, $where, $where_string, $table){
		$result = array();
		if($columns=='' && $table=='') return false;
		$fetch_record = $this->conn->prepare("SELECT $columns FROM $table $where_string LIMIT 1");
		$fetch_record->execute($where);
		$result = $fetch_record->fetch(PDO::FETCH_ASSOC);
		//return $fetch_record->queryString;
		return $result;
	}
	public function fetch_result_data($type, $resultid = 0){
		$result = array();
		if($type=='single'){
			$fetch_record = $this->conn->prepare("SELECT s.name, s.email, s.mobile, s.dept, r.* FROM result r INNER JOIN student s ON s.rollno=r.rollno WHERE r.id=:resultid");
			$fetch_record->execute(array(':resultid'=>$resultid));
			$result = $fetch_record->fetch(PDO::FETCH_ASSOC);
			//return $fetch_record->queryString;
		}
		elseif($type=='multiple'){
			$fetch_record = $this->conn->prepare("SELECT s.name, s.email, s.mobile, s.dept, r.* FROM result r LEFT JOIN student s ON s.rollno=r.rollno");
			$fetch_record->execute();
			$result = $fetch_record->fetchAll(PDO::FETCH_ASSOC);
			//return $fetch_record->queryString;
		}
		return $result;
	}	

}
$db_obj = new dataBase();


