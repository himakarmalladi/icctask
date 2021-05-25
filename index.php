<?php  
require_once('dataBase.php');
$results 	= 	$db_obj->fetch_result_data('multiple');
if(isset($_REQUEST['action']) && $_REQUEST['action']=='delete' && isset($_REQUEST['resultid']) && $_REQUEST['resultid']>0){
  $deleteid = $db_obj->pdo_delete_query($_REQUEST['resultid']);
  $err['success_msg'] = 'Marks Removed Successfully';
}
?>
<html>
  <head>
    <title>Results</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  </head>
  <body>
  <div class="container  mt-5">
    <div class="row">
    <div id="success_msg"><?php echo isset($err['success_msg'])?$err['success_msg']:'';?></div>
    <a href="add-marks.php" class="btn btn-primary mb-2 btn-sm">Add Marks</a>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">Roll Number</th>
            <th scope="col">Name</th>
            <th scope="col">Email-id</th>
            <th scope="col">Mobile</th>
            <th scope="col">Department</th>
            <th scope="col">Subject</th>
            <th scope="col">Mark Obtain</th>
            <th scope="col">Result</th>
            <th scope="col">Grade</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php if(!empty($results)){ foreach($results as $key => $val){ ?>
          <tr>
            <th scope="row"><?php echo $val['rollno']; ?></th>
            <td><?php echo $val['name']; ?></td>
            <td><?php echo $val['email']; ?></td>
            <td><?php echo $val['mobile']; ?></td>
            <td><?php echo $val['dept']; ?></td>
            <td><?php echo $val['subject']; ?></td>
            <td><?php echo $val['mark_obtain']; ?></td>
            <td><?php echo $val['result']==1?'Pass':'Fail'; ?></td>
            <td><?php echo $val['grade']; ?></td>
            <td><a href="add-marks.php?resultid=<?php echo $val['id'];?>&action=edit" class="btn btn-primary btn-sm mr-2">Edit</a><a href="javascript:;" class="btn btn-danger btn-sm" onclick="return delete_result('<?php echo $val['id'];?>')">Delete</a></td>
          </tr>
          <?php } } else{?>
          <tr>
            <th scope="row" colspan="10">No Records Found, Please add the marks to student <a href="add-marks.php" class="btn btn-primary">Add Marks</a></th>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
  <script>
    function delete_result(val){
      if(confirm('Are you sure to delete this marks')){
          window.location.href="index.php?action=delete&resultid="+val;
      }
    }
  </script>
  </body>
</html>
