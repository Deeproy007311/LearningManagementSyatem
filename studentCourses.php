<?php
session_start();
session_regenerate_id(true);
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php"); // Redirect to the index page
    exit();
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Courses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="userPanelCss/courses.css">
    <!-- Font awesome -->
    <script src="https://kit.fontawesome.com/2f671c2a32.js" crossorigin="anonymous"></script>
</head>

<body>
    <!-- Database connection -->
    <?php include 'partials/_dbconnect.php';?>
    <!-- Header connection -->
    <?php include '_header.php' ?>
    <!-- Top Content -->
    <section class="top-content  d-flex justify-content-center align-items-center">
        <div class="container top-content-info">
            <h1 class="text-center text-white">All Courses</h1>
        </div>
    </section>
    <div class="container my-5">
        <div class="row course-row">
            <?php
            $sql = "SELECT * FROM `courses`";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
              $course_id = $row['c_id'];
              $course_name = $row['c_name'];
              $course_description = $row['c_desc'];

              echo '<div class="card mx-4 my-4" style="width: 18rem;">
              <img src="https://source.unsplash.com/400x300/?' . $course_name . ',code" class="card-img-top" alt="...">
              <div class="card-body">
                  <h5 class="card-title">'. $course_name .'</h5>
                  <p class="card-text">' . substr($course_description, 0, 40) . '...</p>
                  <a href="studentCourseDetails.php?course_id='. $course_id .'" class="btn btn-primary">Enroll</a>
              </div>
              </div>';
            }
          ?>
        </div>
    </div>
    <!-- ======= Footer ======= -->
    <?php include '_footer.php';?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
</body>

</html>