<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <!-- <link rel="stylesheet" href="css/restall.css"> -->
</head>

<body>
    <!-- Header connect -->
    <?php include 'header.php';?>
    <!-- Database Connection -->
    <?php include '../partials/_dbconnect.php';?>
    <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['st_submit'])) {
                $student_name = $_POST['student_name'];
                $student_email = $_POST['student_email'];
                $student_password = $_POST['student_password'];
                $student_occupation = $_POST['student_occupation'];

                $sql = "INSERT INTO `students`(`student_name`, `student_email`, `password`, `occupation`) VALUES ('$student_name','$student_email','$student_password','$student_occupation')";
                $insert = mysqli_query($conn, $sql);
                $showAlert = true;
                if ($showAlert) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success</strong> New student has been added.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
            }
        }
    ?>
    <div class="container">
        <h1>Add a new Student</h1>
        <form action="addstudents.php" method="POST">
            <div class="mb-3">
                <label for="student_name" class="form-label">Name</label>
                <input type="text" class="form-control" id="student_name" name="student_name"
                    aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
                <label for="student_email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="student_email" name="student_email" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
                <label for="student_password" class="form-label">Password</label>
                <input type="password" class="form-control" id="student_password" name="student_password" required>
            </div>
            <div class="mb-3">
                <label for="student_occupation" class="form-label">Occupation</label>
                <input type="text" class="form-control" id="student_occupation" name="student_occupation"
                    aria-describedby="emailHelp" required>
            </div>   
            <div class="text-center">
                <button type="submit" class="btn btn-success" id="st_submit" name="st_submit">Submit</button>
                <a href="students.php" class="btn btn-danger">Close</a>
            </div>      
        </form>

    </div>

    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
</body>

</html>