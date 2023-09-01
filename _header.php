<nav class="navbar navbar-expand-lg bg-violet">
    <div class="container-fluid">
        <a class="navbar-brand text-white fs-5" href="#">codeXlearns</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active text-white fs-5" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                <?php
                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                    echo '<a class="nav-link text-white fs-5" href="studentCourses.php">Courses</a>';
                } else {
                    echo '<a class="nav-link text-white fs-5" href="#" onclick="showAlert()">Courses</a>';
                }
                ?>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fs-5" href="about.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fs-5" href="studentFeedbacks.php">Feedback</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fs-5" href="contact.php">Contact</a>
                </li>
            </ul>
            <?php
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                echo '<div class="d-flex">';
                echo '<p class="mb-0 me-3" >Welcome ' . $_SESSION['student_email'] . '</p>';
                echo '<a href="studentLogout.php" type="button" class="btn btn-danger mx-2">Logout</a>';
                echo '</div>';
            } else {
                echo '<div class="d-flex">';
                echo '<a href="studentLogin.php" class="btn btn-primary mx-2">Login</a>';
                echo '<a href="studentSignup.php" class="btn btn-primary mx-2">Signup</a>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</nav>
<script>
function showAlert() {
    alert("Please log in to access the courses.");
}
</script>
