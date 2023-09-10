<?php
if (!isset($_SESSION)) {
  session_start();
  session_regenerate_id(true);
}


include 'partials/_dbconnect.php';


if (isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == true) {
    $student_email = $_SESSION['student_email'];
}else {
  header("Location: index.php");
  exit;
}
if (isset($_REQUEST['studentPassUpdateBtn'])) {
  $sql="SELECT * FROM `students` WHERE `student_email`='$student_email'"; 
  $result = mysqli_query($conn,$sql);
  if (mysqli_num_rows($result) == 1) {
    $studentNewPass = $_REQUEST['studentNewPass'];
    $hash = password_hash($studentNewPass, PASSWORD_DEFAULT);
    $sql = "UPDATE `students` SET `password`='$hash' WHERE `student_email`='$student_email'";
    if (mysqli_query($conn,$sql) == true) {
        $msg= '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success</strong> Your password has been changed successfully
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }else {
      $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Error</strong> Can not update password! Try again.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
  }
}
?>
<div class="container-fluid">
    <div class="row flex-nowrap">
    <?php include 'stuInclude/stuHeader.php'; ?>
        <div class="col-sm-9 col-md-10">
            <div class="row">
                <div class="col-sm-6">
                    <form action="" class="mt-5 mx-5" method="post">
                        <div class="form-group">
                            <label for="inputemail">Email</label>
                            <input class="form-control" type="email" name="" id="student_email"
                                value="<?php echo $student_email; ?>" readonly>
                        </div>
                        <div class="form-group my-3">
                            <label for="studentNewPass">New Password</label>
                            <input type="password" name="studentNewPass" id="studentNewPass" class="form-control">
                        </div>
                        <input type="submit" class="btn btn-primary my-2" name="studentPassUpdateBtn"
                            value="Update">
                        <input type="reset" value="Reset" class="btn btn-secondary my-2">
                        <?php if (isset($msg)) {
          echo $msg;
        }?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>