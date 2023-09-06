<?php
if (!isset($_SESSION)) {
    session_start();
    session_regenerate_id(true);
    if (!isset($_SESSION['loggedin']) or $_SESSION['loggedin'] != true) {
        header("Location: /learningmanagementsystem/admin/index.php");
        exit;
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
    <!-- Database Connection -->
    <?php include '../partials/_dbconnect.php';?>
    <?php
    if (isset($_POST['submit'])) {
        $question_number = $_POST['question_number'];
        $question_text = $_POST['question_text'];
        $correct_choice = $_POST['correct_choice'];
        $course_id = $_POST['course_id'];

        // Choice Array
        $choice = array();
        $choice[1] = $_POST['choice1'];
        $choice[2] = $_POST['choice2'];
        $choice[3] = $_POST['choice3'];
        $choice[4] = $_POST['choice4'];
        $choice[5] = $_POST['choice5'];

        // First query for questions table
        $query = "INSERT INTO `questions`(`question_number`, `question_text`, `course_id`) VALUES ('$question_number','$question_text','$course_id')";
        $result = mysqli_query($conn, $query);

        // Validate the first query
        if ($result) {
            foreach ($choice as $option => $value){
                if ($value != "") {
                    if ($correct_choice == $option) {
                        $is_correct = 1;
                    }else{
                        $is_correct = 0;
                    }
                    // Second query for option table
                    $query = "INSERT INTO `option`(`question_number`, `is_correct`, `coption`, `course_id`) VALUES ('$question_number','$is_correct','$value','$course_id')";
                    $insert_row = mysqli_query($conn, $query);
                    if ($insert_row) {
                        continue;
                    }else{
                        die("2nd query could not be executed");
                    }
                }
            }
            $msg = "Question has been added";
        }
    }

    
    ?>
    <!-- Header connect -->
    <?php include 'header.php'; ?>
    <?php
    if (isset($msg)) {
        echo $msg;
    }
    ?>
    <div class="container">
        <h1>Add Quiz Question</h1>
        <form action="addQuiz.php" method="POST"> 
        <div class="mb-3">
                <label for="course_id" class="form-label">Course ID</label>
                <input type="number" class="form-control" id="course_id" name="course_id" value = "" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="question_number" class="form-label">Question Number</label>
                <input type="number" class="form-control" id="question_number" name="question_number" value = "" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="question_text" class="form-label">Question Text</label>
                <input type="text" class="form-control" id="question_text" name="question_text">
            </div>
            <div class="mb-3">
                <label for="choice1" class="form-label">choice 1:</label>
                <input type="text" class="form-control" id="choice1" name="choice1">
            </div>
            <div class="mb-3">
                <label for="choice2" class="form-label">choice 2:</label>
                <input type="text" class="form-control" id="choice2" name="choice2">
            </div>
            <div class="mb-3">
                <label for="choice3" class="form-label">choice 3:</label>
                <input type="text" class="form-control" id="choice3" name="choice3">
            </div>
            <div class="mb-3">
                <label for="choice4" class="form-label">choice 4:</label>
                <input type="text" class="form-control" id="choice4" name="choice4">
            </div>
            <div class="mb-3">
                <label for="choice5" class="form-label">choice 5:</label>
                <input type="text" class="form-control" id="choice5" name="choice5">
            </div>
            <div class="mb-3">
                <label for="correct_choice" class="form-label">Correct Option: </label>
                <input type="number" class="form-control" id="correct_choice" name="correct_choice">
            </div>
            
            <input type="submit" value="submit" name="submit" class="btn btn-success">
        </form>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
</body>

</html>