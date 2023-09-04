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
    <title>Admin || Add Lessons</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
    <!-- Header connect -->
    <?php include 'header.php'; ?>
    <!-- Database Connection -->
    <?php include '../partials/_dbconnect.php'; ?>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['lessonSubmitBtn'])) {
        // Entering values to variables
        $lesson_name = $_POST['lesson_name'];
        $lesson_desc = $_POST['lesson_desc'];
        $c_id = $_POST['c_id'];
        $c_name = $_POST['c_name'];
        $lesson_link = $_FILES['lesson_link']['name'];
        $lesson_link_temp = $_FILES['lesson_link']['tmp_name'];
        $relative_link_directory = 'lessonvid/' . $lesson_link; // Store without the base URL
        $link_directory = '../' . $relative_link_directory; // Actual server directory
        move_uploaded_file($lesson_link_temp, $link_directory);
        $sql = "INSERT INTO `lessons`(`lesson_name`, `lesson_desc`, `lesson_link`, `course_id`, `course_name`) VALUES ('$lesson_name','$lesson_desc','$relative_link_directory','$c_id','$c_name')";
        if (mysqli_query($conn, $sql) == true) {
            // Confirming that my form is submitted perfectly
            $msg = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success</strong> New lesson has been added.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        } else {
            // If there is some problem with my form
            $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error</strong> Form cannot be submitted.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        }
    }
    ?>
    <?php
    if (isset($msg)) {
        echo $msg;
    }
    ?>
    <div class="container">
        <h2>Add New Lessons</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="course_id" class="form-label">Course ID</label>
                <input type="text" class="form-control" id="c_id" name="c_id" value="<?php if (isset($_SESSION['c_id'])) {
                    echo $_SESSION['c_id'];
                } ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="course_name" class="form-label">Course Name</label>
                <input type="text" class="form-control" id="c_name" name="c_name" value="<?php
                if (isset($_SESSION['c_name'])) {
                    echo $_SESSION['c_name'];
                }
                ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="lesson_name" class="form-label">Lesson Name</label>
                <input type="text" class="form-control" id="lesson_name" name="lesson_name"
                    aria-describedby="emailHelp">
            </div>
            <div class="form-floating">
                <textarea class="form-control" placeholder="Leave a comment here" id="lesson_desc"
                    name="lesson_desc"></textarea>
                <label for="lesson_desc">Lesson Description</label>
            </div>
            <div class="form-floating my-4">
                <input type="file" name="lesson_link" id="lesson_link" class="form-control">
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-success" id="lessonSubmitBtn"
                    name="lessonSubmitBtn">Submit</button>
                <a href="lessons.php" class="btn btn-danger">Close</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
</body>

</html>
