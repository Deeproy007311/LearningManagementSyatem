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
if (isset($_GET['course_id'])) {
    $course_id = $_GET['course_id'];
    $sql1 = "SELECT * FROM `students` WHERE `student_email`='$student_email'";
    $result1 = mysqli_query($conn,$sql1);
    $sql2 = "SELECT * FROM `courses` WHERE `c_id`='$course_id'";
    $result2 = mysqli_query($conn,$sql2);
    $row = mysqli_fetch_assoc($result2);

    if (isset($_POST['checkoutBtn'])) {
        $stu_email = $_POST['student_email'];
        $course_name = $_POST['course_name'];
        $course_id = $_POST['course_id'];
    
        $sql3 = "INSERT INTO `courseorder`(`student_email`, `course_name`, `course_id`) VALUES ('$stu_email','$course_name','$course_id')";
        $result3 = mysqli_query($conn, $sql3);
    
        if ($result3) {
            $msg = '<div class="alert alert-success alert-dismissible fade show col-sm-6 ml-5 mt-2" role="alert">
            <strong>Success!</strong> Your checkout completed. Now you can start your course
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
            <a href="studentCourseDetails.php?course_id='. $course_id .'" class="btn btn-primary">Start Course</a>';
        } else {
            $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert">Can not checkout</div>';
        }
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="userPanelCss/courseCheckout.css">
</head>

<body>
    <?php include '_header.php'; ?>
    <section class="top-content  d-flex justify-content-center align-items-center">
        <div class="container top-content-info">
            <h1 class="text-center text-white" style="font-size: 61px;">Checkout Your Course</h1>
        </div>
    </section>
    <div class="container my-5">
        <div class="row ">
            <?php
            echo '<div class="col-sm-6 mt-5">
            <div class="card" style="width: 18rem;">
                <img src="https://source.unsplash.com/400x300/?' . $row['c_name'] . ',programming" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">'. $row['c_name'] .'</h5>
                    <p class="card-text">'. substr($row['c_desc'], 0, 40) .'...</p>
                </div>
                <h1>Rs: $0</h1>
            </div>
            </div>';
            ?>

            <!-- form Content -->
            <div class="col-sm-6 mt-5">
            <form class="mx-5" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="student_email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="student_email" name="student_email"
                            value="<?php echo $student_email; ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="course_name" class="form-label">Course Name</label>
                        <input type="text" class="form-control" id="course_name" name="course_name"
                            value="<?php echo $row['c_name']; ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <input type="hidden" id="course_id" name="course_id" value="<?php echo $course_id ?>">
                    </div>

                    <button type="submit" class="btn btn-primary" name="checkoutBtn">Checkout</button>
                    <?php if (isset($msg)) {
                            echo $msg;
                    }?>
            </form>
            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
</body>

</html>