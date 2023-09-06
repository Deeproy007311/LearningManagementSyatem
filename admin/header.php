<?php
if (isset($_SESSION['loggedin']) and $_SESSION['loggedin'] == true) {
  $loggedin = true;
}
else{
  $loggedin = false;
}

if ($loggedin) {
  echo '<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">E-Learning Admin Area</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="dashboard.php">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="courses.php">Courses</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="lessons.php">Lessons</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="students.php">Students</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="feedback.php">Feedback</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="adminchangepass.php">change Password</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="quiz.php">Add Quiz</a>
        </li>
         
      </ul>
      <form class="d-flex">
      <a href="adminlogout.php" class="btn btn-danger">Logout</a>
      </form>
      
      </div>
    </div>
  </nav>';
}

     

?>
