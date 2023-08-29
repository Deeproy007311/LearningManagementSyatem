<?php
if (!isset($_SESSION)) {
    session_start();
    session_regenerate_id(true);
    if (!isset($_SESSION['loggedin']) or $_SESSION['loggedin']!=true) {
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
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
    <!-- Header connect -->
    <?php include 'header.php';?>
    <!-- Database Connection -->
    <?php include '../partials/_dbconnect.php';?>
    <?php
    $adminEmail = $_SESSION['admin_email'];
    if (isset($_REQUEST['update'])) {
        $sql="SELECT * FROM `admin` WHERE `admin_email`='$adminEmail'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 1) {
            $adminPass = $_REQUEST['newpass'];
            $sql="UPDATE `admin` SET `admin_password`='$adminPass'";
            if (mysqli_query($conn,$sql) == true) {
                $passmsg = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Admin password has been changed.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
            }else {
                $passmsg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Sorry!</strong> Unable to change password.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
            }
        }
    }
    ?>
    <div class="container">
        <h1>Admin Change password</h1>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $adminEmail ?>" aria-describedby="emailHelp" readonly>
            </div>
            <div class="mb-3">
                <label for="newpass" class="form-label">New Password</label>
                <input type="password" class="form-control" id="newpass" name="newpass" required>
            </div>
            <input type="submit"  name="update" class="btn btn-warning" >
            <input type="reset" class="btn btn-danger" value="reset">
            <?php
            if (isset($passmsg)) {
                echo $passmsg;
            }
            ?>
        </form>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
</body>

</html>