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
    <!-- Datatables css -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
</head>

<body>
    <!-- Database Connection -->
    <?php include '../partials/_dbconnect.php';?>
    <?php include 'header.php'; ?>
    <div class="container">
        <a href="addQuiz.php" class="btn btn-success">add quiz</a>
        <h1>All quize questions</h1>
    </div>
    <!-- <div class="container">
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">Course ID</th>
                    <th scope="col">Question</th>
                    <th scope="col">Ans1</th>
                    <th scope="col">Ans2</th>
                    <th scope="col">Ans3</th>
                    <th scope="col">Ans4</th>
                    <th scope="col">Ans</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM `qizzes`";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>
                    <th scope="row">'. $row['course_id'] .'</th>
                    <td>'. $row['question'] .'</td>
                    <td>'. $row['ans1'] .'</td>
                    <td>'. $row['ans2'] .'</td>
                    <td>'. $row['ans3'] .'</td>
                    <td>'. $row['ans4'] .'</td>
                    <td>'. $row['ans'] .'</td>
                    <td>  <button type="button" class=" edit btn btn-sm btn-warning">Edit</button> <button type="button" class="delete btn btn-sm btn-danger">delete</button></td>
                </tr>';
                }
                ?>
            </tbody>
        </table>
    </div> -->












    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <!-- Datatables script -->
    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
    let table = new DataTable('#myTable');
    </script>

</body>

</html>