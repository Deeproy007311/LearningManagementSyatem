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

$sql="SELECT * FROM `students` WHERE `student_email`='$student_email'";
$result = mysqli_query($conn,$sql);
if(mysqli_num_rows($result) == 1){
  $row = mysqli_fetch_assoc($result);
  $student_id = $row['student_id'];
}
if (isset($_REQUEST['submitFeedbackBtn'])) {
  $f_content = $_REQUEST['f_content'];
  $sql = "INSERT INTO `feedbacks`(`f_content`, `student_id`) VALUES ('$f_content','$student_id')";
  if (mysqli_query($conn,$sql) == true) {
      $msg = '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Success</strong> Your feedback has been submitted successfully
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
  }else {
    $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Error</strong> Try again
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
  }
}
?>
<div class="container-fluid">
    <div class="row flex-nowrap">
        <?php include 'stuInclude/stuHeader.php'; ?>
        <div class="col-sm-6 mt-5">
            <form class="mx-5" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="student_id">Student ID</label>
                    <input class="form-control" type="text" name="student_id" id="student_id" value="<?php if (isset($student_id)) {
            echo $student_id;
          }?>" readonly>
                </div>
                <div class="form-group">
                    <label for="f_content">Write Feedback</label>
                    <textarea class="form-control" name="f_content" id="f_content" row=2 required></textarea>
                </div>
                <button type="submit" class="btn btn-primary" name="submitFeedbackBtn">Update</button>
                <?php if (isset($msg)) {
          echo $msg;
        }?>
            </form>
        </div>
    </div>
</div>