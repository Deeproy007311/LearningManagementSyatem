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
    <link rel="stylesheet" href="userPanelCss/courseDetails.css">
</head>

<body>
    <!-- Header connection -->
    <?php include '_header.php' ?>
    <!-- Top Content -->
    <section class="top-content  d-flex justify-content-center align-items-center">
        <div class="container top-content-info">
            <h1 class="text-center text-white">Course Details</h1>
        </div>
    </section>
    <!-- Course Information -->
    <div class="container my-5">
        <div class="row">
            <div class="col-md-8">
                <h3>Course Name: Python</h3>
                <p>Description: Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti, nisi.</p>
            </div>
            <div class="col-md-4 text-right">
                <a href="#" class="btn btn-primary">Start Course</a>
            </div>
        </div>
    </div>
    <!-- Lessons Table -->
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Lesson ID</th>
                    <th scope="col" class="text-center">Lesson Name</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td class="text-center">Python Introduction</td>
                </tr>
                <tr>
                    <th scope="row">1</th>
                    <td class="text-center">Python Introduction</td>
                </tr>
                <tr>
                    <th scope="row">1</th>
                    <td class="text-center">Python Introduction</td>
                </tr>
                <tr>
                    <th scope="row">1</th>
                    <td class="text-center">Python Introduction</td>
                </tr>
                
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
</body>

</html>