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
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="userPanelCss/quizQuestion.css">
</head>

<body style="background-color: #CAEDFF;">
    <!-- Database connection -->
    <?php include 'partials/_dbconnect.php';?>
    <?php
      if (isset($_GET['course_id']) && isset($_GET['n'])) {
        // Set question number and course ID
        $number = $_GET['n'];
        $course_id = $_GET['course_id'];

        // Fetch the question based on course ID and question number
        $query = "SELECT * FROM `questions` WHERE `question_number` = '$number' AND `course_id` = '$course_id'";
        $result = mysqli_query($conn, $query);
        $question = mysqli_fetch_assoc($result);

        // Fetch choices based on course ID and question number
        $query = "SELECT * FROM `option` WHERE `question_number` = '$number' AND `course_id`='$course_id'";
        $choices = mysqli_query($conn, $query);

        // Get total questions for the course
        $query = "SELECT * FROM `questions` WHERE `course_id` = '$course_id'";
        $total_questions = mysqli_num_rows(mysqli_query($conn, $query));

        // Calculate next question number
        $next = $number + 1;
      }
    ?>
    <!-- As a heading -->
    <nav class="navbar"style="background-color: #279EFF;">
        <div class="container-fluid">
            <h2 class="text-center">Quiz Questions</h2>
        </div>
    </nav>
    <div class="container main_content my-5">
        <div class="card">
            <h5 class="card-header">Question <?php echo $number; ?> of <?php echo $total_questions; ?></h5>
            <div class="card-body">
                <h5 class="card-title"><?php echo $question['question_text']; ?></h5>
                <form action="quizProcess.php" method="post">
                    <ul class="choices">
                        <?php while ($row = mysqli_fetch_assoc($choices)) { ?>
                        <li><input type="radio" name="choice" id="choice"
                                value="<?php echo $row['id']; ?>"><?php echo $row['coption']; ?></li>
                        <?php } ?>
                    </ul>
                    <input type="hidden" name="number" value="<?php echo $number; ?>">
                    <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
                    <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                </form>


            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
</body>

</html>