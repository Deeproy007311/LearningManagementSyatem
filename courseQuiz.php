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
    <title>Start Quiz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body style="background-color: #CAEDFF;">
    <!-- Database connection -->
    <?php include 'partials/_dbconnect.php';?>
    <!-- Header connection -->
    <!-- <?php include '_header.php'; ?> -->

    <!-- Center container -->
    <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="container">
            <?php
            if (isset($_GET['course_id'])) {
                $course_id = $_GET['course_id'];
                $sql = "SELECT * FROM `questions` WHERE `course_id`='$course_id'";
                $total_questions = mysqli_num_rows(mysqli_query($conn, $sql));
            }
            ?>
            <h1>Test your coding knowledge</h1>
            <p>This is a multiple-choice quiz to test your coding knowledge.</p>
            <ul>
                <li><strong>Number of questions: </strong><?php echo $total_questions; ?></li>
                <li><strong>Type: </strong>Multiple Choice</li>
                <li><strong>Estimated Time: </strong>5 Min</li>
                <a href="quizQuestion.php?n=1&course_id=<?php echo $course_id; ?>" class="btn btn-success" style="margin-top: 13px;">Start Quiz</a>
            </ul>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
</body>

</html>