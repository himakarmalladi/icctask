<?php
require_once('dataBase.php');
class ajaxRequest{
	public function fetch_student_details($rollNumber){
		global $db_obj;
		$columns 		= 	'*';
		$table			=	'student';
		$where			=	array(':rollNumber'=>$rollNumber);
		$where_string	=	" WHERE rollno=:rollNumber";
		$user_details 	= 	$db_obj->pdo_fetchOne($columns, $where, $where_string, $table, $type='single');
		if(!empty($user_details)){
			return array('status'=>200,'message'=>'Data fetched','data'=>$user_details);exit;
		}else{
			return array('status'=>201,'message'=>'User data not found');exit;
		}
	}
}
$page_class = new ajaxRequest();

if(isset($_POST['action']) && $_POST['action']=='get_student_data'){
	if(isset($_POST['rollNumber']) && is_numeric($_POST['rollNumber']) && $_POST['rollNumber']>0){
		$data = $page_class->fetch_student_details($_POST['rollNumber']);
		echo json_encode($data);exit;
	}
	echo json_encode(array('status'=>500,'message'=>'No records found with given roll Number'));exit;
}
else{
	echo json_encode(array('status'=>500,'message'=>'Invalid Request'));exit;
}