<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "learningmanagement_db";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Sorry failed to connect" . mysqli_connect_error());
}
?>
<?php
    
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['loggedin'])) {
    $student_email = $_SESSION['student_email'];
}
if (isset($student_email)) {
    $sql = "SELECT `student_name` FROM `students` WHERE `student_email`='$student_email'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    $student_name = $row['student_name'];
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
    <script src="https://kit.fontawesome.com/2f671c2a32.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
        <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
            <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <span class="fs-5 d-none d-sm-inline"><?php echo $student_name; ?></span>
            </a>
            <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                <li class="nav-item">
                    <a href="studentProfile.php" class="nav-link align-middle px-0">
                    <i class="fa-solid fa-user" style="color: #2270f7;"></i> <span class="ms-1 d-none d-sm-inline">Profile</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="myCourses.php" class="nav-link align-middle px-0">
                    <i class="fa-solid fa-book" style="color: #0a5ae6;"></i> <span class="ms-1 d-none d-sm-inline">My Courses</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="studentFeedbacks.php" class="nav-link align-middle px-0">
                    <i class="fa-solid fa-comment" style="color: #1860dc;"></i> <span class="ms-1 d-none d-sm-inline">Feedback</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="studentChangePass.php" class="nav-link align-middle px-0">
                    <i class="fa-solid fa-lock" style="color: #185ed8;"></i> <span class="ms-1 d-none d-sm-inline">Change Password</span>
                    </a>
                </li>                
            </ul>
            <hr>
            <div class="dropdown pb-4">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                    id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://github.com/mdo.png" alt="hugenerd" width="30" height="30" class="rounded-circle">
                    <span class="d-none d-sm-inline mx-1">More</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                    <li><a class="dropdown-item" href="studentProfile.php">Profile</a></li>
                    <li><a class="dropdown-item" href="StudentCourses.php">All Courses</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="studentLogout.php">Sign out</a></li>
                </ul>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
</body>

</html>