<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <!-- <link rel="stylesheet" href="css/restall.css"> -->
    <!-- Font Awsome -->
    <script src="https://kit.fontawesome.com/2f671c2a32.js" crossorigin="anonymous"></script>
</head>

<body>
    <!-- Header connect -->
    <?php include 'header.php';?>
    <!-- Database Connection -->
    <?php include '../partials/_dbconnect.php';?>
    <div class="container">
        <h1>Students</h1>
    </div>
    <div class="container mt-5">
        <a href="addstudents.php" class="btn btn-success"><i class="fa-solid fa-plus"></i></a>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">

    </script>
</body>

</html>