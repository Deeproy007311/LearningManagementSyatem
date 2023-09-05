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
    <title>Watch Course</title>
    <!-- Bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
    <!-- Database connection -->
    <?php include 'partials/_dbconnect.php';?>

    <div class="container-fluid p-2" style="background-color: #337CCF;">
        <h3>Welcome to CodexLearns</h3>
        <a href="studentCourses.php" class="btn btn-danger">Courses</a>
        
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3 border-right">
                <h4 class="text-center">Lessons</h4>
                <ul id="playlist" class="nav flex-column">
                    <?php
                    if (isset($_GET['course_id'])) {
                        $course_id = $_GET['course_id'];
                        $sql = "SELECT * FROM `lessons` WHERE `course_id` = '$course_id'";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                // Construct the full video URL
                                $videoURL = "http://localhost/learningmanagementsystem/" . $row['lesson_link'];
                                echo '<li class="nav-item border-bottom py-2" data-movieurl="'. $videoURL .'" style="cursor:pointer;">'. $row['lesson_name'] .'</li>';
                            }
                        }
                    }
                    ?>
                    <a href="studentQuiz.php?course_id=<?php echo $course_id; ?>" class="btn btn-success">Start Quiz</a>
                </ul>
            </div>
            <div class="col-sm-8">
                <video id="videoarea" src="" class="mt-5 w-75 ml-2" controls></video>
            </div>
        </div>
        
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script>
    $(document).ready(function() {
        $(function() {
            $("#playlist li").on("click", function() {
                var videoPath = $(this).data("movieurl");
                $("#videoarea").attr("src", videoPath);
                $("#videoarea")[0].load(); // Load the video
                $("#videoarea")[0].play(); // Play the video
            });

            // Load and play the first video by default
            var firstVideoPath = $("#playlist li").eq(0).data("movieurl");
            $("#videoarea").attr("src", firstVideoPath);
            $("#videoarea")[0].load();
            $("#videoarea")[0].play();
        });
    });
    </script>
</body>
</html>
