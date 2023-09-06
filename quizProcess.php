<?php
session_start();
session_regenerate_id(true);
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php"); // Redirect to the index page
    exit();
}
?>
<!-- Database connection -->
<?php include 'partials/_dbconnect.php';?>
<?php
if (!isset($_SESSION['score'])) {
    $_SESSION['score'] = 0;
}
if ($_POST) {
    $number = $_POST['number'];
    $selected_choice = $_POST['choice'];
    $course_id = $_POST['course_id'];
    
    $query = "SELECT * FROM `option` WHERE `id` = '$selected_choice' AND `is_correct` = 1";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) == 1) {
        $_SESSION['score']++;
    }

    // Get the total number of questions for the course
    $query = "SELECT * FROM `questions` WHERE `course_id` = '$course_id'";
    $total_questions = mysqli_num_rows(mysqli_query($conn, $query));

    $next = $number + 1;

    if ($next > $total_questions) {
        // Redirect to final.php
        header("Location: quizFinal.php");
        exit();
    } else {
        // Redirect to the next question
        header("Location: quizQuestion.php?n=" . $next . "&course_id=" . $course_id);
        exit();
    }
}
?>
