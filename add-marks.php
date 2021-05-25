<?php  
require_once('dataBase.php');
if(isset($_REQUEST['resultid']) && is_numeric($_REQUEST['resultid']) && $_REQUEST['resultid']>0){
  $results 	= 	$db_obj->fetch_result_data('single', $_REQUEST['resultid']);
}
$err = array();
if(isset($_POST['submit']) && $_POST['submit']=='Submit'){
  foreach($_POST as $key=>$val){
      $_POST[$key] = filter_var(trim($val), FILTER_SANITIZE_STRING);
      if(trim($val) =='' && $key!='landmark'){$err[$key] = 'Plese enter '.$key;}
  }

  if(!filter_var($_POST['Roll_Number'], FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[0-9]+$/")))){$err['Roll_Number'] = 'Please enter digits only';}
  if(!filter_var($_POST['Marks_Obtain'], FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[0-9]+$/")))){$err['Marks_Obtain'] = 'Please enter digits only';}

  if(empty($err)){
    if(isset($_REQUEST['action']) && $_REQUEST['action']=='edit' && isset($_REQUEST['resultid']) && $_REQUEST['resultid']>0){
      $insertId = $db_obj->pdo_update_query($_POST);
    }else{
      $insertId = $db_obj->pdo_insert_query($_POST);
    }
    
    if($insertId>0){unset($_POST); $err['success_msg'] = 'Marks Saved Successfully';}else{$err['success_msg'] ='Please try again';}
  }
}



?>
<html>
  <head>
    <title>Results</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style>.error{color:red;font-size:12px;}</style>
  </head>
  <body>
    <div class="container-fluid">
      <div class="row">
        <div class="col-6 mt-10 p-5">
          <h3> <?php echo isset($_REQUEST['action']) && $_REQUEST['action']=='edit'?'Edit':'Add'; ?> Marks to Student <a href="index.php" class="btn btn-primary ml-5">Back</a></h3>
          <form method="post" class="generate_form" id="new_generated_form">
            <div id="success_msg"><?php echo isset($err['success_msg'])?$err['success_msg']:'';?></div>
            <div  id="new_form_view">
              <div class="form-group row">
                <div class="col-md-6">
                  <label for="Roll_Number">Roll Number</label>
                  <input type="text" class="form-control" id="Roll_Number" name="Roll_Number" placeholder="Roll Number" value="<?php echo isset($_POST['Roll_Number'])?$_POST['Roll_Number']:(isset($results['rollno'])?$results['rollno']:'');?>">
                  <span class="error" id="Roll_Number_error"><?php echo isset($err['Roll_Number'])?$err['Roll_Number']:'';?></span>
                </div>
                <div class="col-md-6">
                  <label for="Student_Name">Student Name</label>
                  <input type="text" class="form-control" id="Student_Name" name="Student_Name" placeholder="Student Name" readonly  value="<?php echo isset($_POST['Student_Name'])?$_POST['Student_Name']:(isset($results['name'])?$results['name']:'');?>">
                  <span class="error" id="Student_Name_error"><?php echo isset($err['Student_Name'])?$err['Student_Name']:'';?></span>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-6">
                  <label for="Email">Email</label>
                  <input type="text" class="form-control" id="Email" name="Email" placeholder="Email" readonly value="<?php echo isset($_POST['Email'])?$_POST['Email']:(isset($results['email'])?$results['email']:'');?>">
                  <span class="error" id="Email_error"><?php echo isset($err['Email'])?$err['Email']:'';?></span>
                </div>
                <div class="col-md-6">
                  <label for="Mobile">Mobile</label>
                  <input type="text" class="form-control" id="Mobile" name="Mobile" placeholder="Mobile" readonly value="<?php echo isset($_POST['Mobile'])?$_POST['Mobile']:(isset($results['mobile'])?$results['mobile']:'');?>">
                  <span class="error" id="Mobile_error"><?php echo isset($err['Mobile'])?$err['Mobile']:'';?></span>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-6">
                  <label for="Department">Department</label>
                  <input type="text" class="form-control" id="Department" name="Department" placeholder="Department" readonly value="<?php echo isset($_POST['Department'])?$_POST['Department']:(isset($results['dept'])?$results['dept']:'');?>">
                  <span class="error" id="Department_error"><?php echo isset($err['Department'])?$err['Department']:'';?></span>
                </div>
                <div class="col-md-6">
                  <label for="Subject">Subject</label>
                  <input type="text" class="form-control" id="Subject" name="Subject" placeholder="Subject"  value="<?php echo isset($_POST['Subject'])?$_POST['Subject']:(isset($results['subject'])?$results['subject']:'');?>">
                  <span class="error" id="Subject_error"><?php echo isset($err['Subject'])?$err['Subject']:'';?></span>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-6">
                  <label for="Marks_Obtain">Marks Obtain</label>
                  <input type="text" class="form-control" id="Marks_Obtain" name="Marks_Obtain" placeholder="Marks Obtain" value="<?php echo isset($_POST['Marks_Obtain'])?$_POST['Marks_Obtain']:(isset($results['mark_obtain'])?$results['mark_obtain']:'');?>">
                  <span class="error" id="Marks_Obtain_error"><?php echo isset($err['Marks_Obtain'])?$err['Marks_Obtain']:'';?></span>
                </div>
                <div class="col-md-6">
                  <label for="Result">Result</label>
                  <input type="text" class="form-control" id="Result" name="Result" placeholder="Result" value="<?php echo isset($_POST['Result'])?$_POST['Result']:(isset($results['result']) && $results['result']==1?'Pass':'Fail');?>">
                  <span class="error" id="Result_error"><?php echo isset($err['Result'])?$err['Result']:'';?></span>
                </div>
              </div>
              <div class="form-group">
                <label for="Grade">Grade</label>
                <input type="text" class="form-control" id="Grade" name="Grade" placeholder="Grade"  value="<?php echo isset($_POST['Grade'])?$_POST['Grade']:(isset($results['grade'])?$results['grade']:'');?>">
                <span class="error" id="Grade_error"><?php echo isset($err['Grade'])?$err['Grade']:'';?></span>
              </div>
              <div class="form-group">
                  <input type="hidden" value="<?php echo (isset($results['id'])?$results['id']:'0'); ?>" name="resultid">
                  <input type="submit" class="btn btn-primary" id="submit_field" name="submit" value="Submit">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/js/bootstrap.bundle.min.js"></script>
    <script src="validations.js"></script>

  </body>
</html>
