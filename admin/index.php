<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="css/dashboard.css">
</head>

<body>
    <!-- Header connect -->
    <?php include 'header.php';?>
    <!-- Database Connection -->
    <?php include '../partials/_dbconnect.php';?>
    <?php
    $query = "SELECT COUNT(*) as count FROM courses";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $rowCount = $row["count"];
    } else {
        $rowCount = 0;
    }
    // Close the connection
    $conn->close();
    ?>
    <div class="container my-4">
        <div class="row">
            <div class="col-md-6">
                <div class="card text-center">
                    <div class="card-header">
                        Courses
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">Total Courses: <?php echo $rowCount; ?></h4>
                        <a href="courses.php" class="btn btn-success">View Courses</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card text-center">
                    <div class="card-header">
                        Students
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">45</h4>
                        <a href="students.php" class="btn btn-success">View Students</a>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
</body>

</html>