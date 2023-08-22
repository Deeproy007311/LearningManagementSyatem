<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Course by Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
    <!-- Header connect -->
    <?php include 'header.php';?>
    <!-- Database Connection -->
    <?php include '../partials/_dbconnect.php';?>
    <?php
        $showAlert = false;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            

            $c_name = $_POST['coursename'];
            $c_desc = $_POST['coursedesc'];

            $sql = "INSERT INTO `courses` (`c_name`, `c_desc`, `timestamp`) VALUES ('$c_name', '$c_desc', current_timestamp())";
            $insert = mysqli_query($conn, $sql);
            $showAlert = true;
            if ($showAlert) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success</strong> Your course has been added
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
            }


        }
?>

    <div class="container">
        <h1>Add Courses here</h1>
        <form action="addcourses.php" method="post">
            <div class="mb-3">
                <label for="coursename" class="form-label">Course Name</label>
                <input type="text" class="form-control" id="coursename" name="coursename" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="coursedesc" class="form-label">Course Description</label>
                <input type="text" class="form-control" id="coursedesc" name="coursedesc">
            </div>
            <button type="submit" class="btn btn-success">Add</button>
        </form>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
</body>

</html>