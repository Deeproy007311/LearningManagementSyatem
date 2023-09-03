<?php
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>codeXLearns</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="userPanelCss/index.css">
    <link rel="stylesheet" href="userPanelCss/unpkg.com_swiper@8.1.6_swiper-bundle.min.css">
    <link rel="stylesheet" href="userPanelCss/home.css">
    <!-- Font awsome -->
    <script src="https://kit.fontawesome.com/2f671c2a32.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Include jQuery library -->
    <script>
    function checkLogin() {
        $.ajax({
            type: "POST",
            url: "check_login.php", // Create a new PHP file for checking login status
            dataType: "json",
            success: function(response) {
                if (response.loggedin) {
                    window.location.href = "studentCourses.php"; // Redirect if logged in
                } else {
                    alert("Please log in to join for free.");
                }
            }
        });
    }
    </script>
</head>

<body>
    <!-- Header connection -->
    <?php include '_header.php' ?>
    <!-- Database Connection -->
    <?php include 'partials/_dbconnect.php';?>
    <div class="container heading-container">
        <h1 class="text-white">Online Learning Platform</h1>
        <p class="text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi, expedita iusto est quos
            excepturi eius.</p>
        <!-- <a href="studentCourses.php" class="button btn text-center">Join for free</a> -->
        <a href="#" class="button btn text-center" onclick="checkLogin()">Join for free</a>

    </div>
    <div class="container my-5">
        <h1 class="text-center text-white">Top Courses</h1>
        <div class="row course-row">
            <!-- php code -->
            <?php
                $sql = "SELECT * FROM `courses` LIMIT 3";
                $result = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_assoc($result)){
                    $course_id = $row['c_id'];
                    $course_name = $row['c_name'];
                    $course_description = $row['c_desc'];
                    echo '<div class="card mx-4 my-4" style="width: 18rem;">
                    <img src="https://source.unsplash.com/400x300/?'. $course_name .',code" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">'. $course_name .'</h5>
                        <p class="card-text">'. substr($course_description, 0, 40) .'...</p>
                        <a href="#" class="btn btn-primary">Start Course</a>
                    </div>
                </div>';
                }
            ?>
            <div class="row justify-content-center">
                <div class="col-12 text-center">
                    <a href="studentCourses.php" class="button btn text-center" onclick="checkLogin()">View More</a>
                </div>
            </div>
        </div>
    </div>
    <!-- static information-1 -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <div class="container container-image">
                    <img src="userPanelImages/index1.webp" alt="index1" class="img-fluid">
                </div>
            </div>
            <div class="col-md-6">
                <div class="container container-info my-5">
                    <h1 class="text-contrast text-white">Learner outcomes on courses you will take</h1>
                    <i class="fa-solid fa-check" style="color: #f2cb07;"></i>
                    <p class="text-contrast font-weight-bold text-white">Techniques to engage effectively with vulnerable children</p>
                    <i class="fa-solid fa-check" style="color: #f2cb07;"></i>
                    <p class="text-contrast font-weight-bold text-white">Techniques to engage effectively with vulnerable children</p>
                    <i class="fa-solid fa-check" style="color: #f2cb07;"></i>
                    <p class="text-contrast font-weight-bold text-white">Techniques to engage effectively with vulnerable children</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Feedback -->






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
</body>

</html>