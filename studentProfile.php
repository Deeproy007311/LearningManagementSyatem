<?php
session_start();
session_regenerate_id(true);
?>
<?php
if (isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == true) {
    $student_email = $_SESSION['student_email'];
}else {
  header("location: index.php");
  exit;
}


?>
    
    <!-- Database Connection -->
    <?php include 'partials/_dbconnect.php'; ?>
    <?php
      $sql = "SELECT * FROM `students` WHERE `student_email`='$student_email'";
      $result = mysqli_query($conn,$sql);
      if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $student_id = $row['student_id'];
        $student_name = $row['student_name'];
        $student_occ = $row['occupation'];
      }

      if (isset($_REQUEST['update_stu_name_btn'])) {
        $student_name = $_REQUEST['student_name'];
        $student_occupation = $_REQUEST['student_occupation'];
        $sql = "UPDATE `students` SET `student_name`='$student_name', `occupation`='$student_occupation' WHERE `student_email`='$student_email'";
        if (mysqli_query($conn,$sql) == true) {
          $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert">Updated Successfully</div>';
        }else {
          $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> can not update</div>';
        }
      }
    
    ?>
    <!-- Student Header -->
    <div class="container-fluid">
      <div class="row flex-nowrap">
      <?php include 'stuInclude/stuHeader.php';?>
    <div class="col-sm-6 mt-5">
      <form class="mx-5" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="student_id">Student ID</label>
          <input class="form-control" type="text" name="student_id" id="student_id" value="<?php if (isset($student_id)) {
            echo $student_id;
          }?>" readonly>
        </div>
        <div class="form-group">
          <label for="student_id">Email</label>
          <input class="form-control" type="text" name="student_email" id="student_email" value="<?php echo $student_email; ?>" readonly>
        </div>
        <div class="form-group">
          <label for="student_name">Name</label>
          <input class="form-control" type="text" name="student_name" id="student_name" value="<?php if (isset($student_name)) {
            echo $student_name;
          } ?>">
        </div>
        <div class="form-group">
          <label for="student_occupation">Occupation</label>
          <input class="form-control" type="text" name="student_occupation" id="student_occupation" value="<?php if (isset($student_occ)) {
            echo $student_occ;
          } ?>">
        </div>
        <button type="submit" class="btn btn-primary" name="update_stu_name_btn">Update</button>
        <?php if (isset($msg)) {
          echo $msg;
        }?>
      </form>
    </div>
    </div>
</div>