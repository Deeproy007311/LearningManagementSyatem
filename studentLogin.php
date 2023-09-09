<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['submit'])) {
        // Database Connection
        include 'partials/_dbconnect.php';

        $student_email = $_POST['student_email'];
        $student_password = $_POST['password'];

        $sql = "SELECT * FROM `students` WHERE `student_email` = '$student_email'";
        $result = mysqli_query($conn, $sql);
        $numRows = mysqli_num_rows($result);
        if ($numRows == 1) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($student_password, $row['password'])) {
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['id'] = $row['student_id'];
                $_SESSION['student_email'] = $student_email;
                header("Location: index.php");
                exit();
            }else {
                $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> Invalid Password.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
            }
        }else {
            $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> User Not Found.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="userPanelCss/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

</head>

<body style="background-color: #CAEDFF;">
    <div class="container d-flex justify-content-center align-items-center vh-100">
            <form id="loginform" class="form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <p class="title">Login</p>
            <p class="message">Login now and get full access to our app. </p>

            <label>
                <input required="" placeholder="" type="email" name="student_email" class="input" >
                <span>Email</span>
            </label>

            <label>
                <input required="" placeholder="" type="password" name="password" class="input" >
                <span>Password</span>
            </label>
            <button class="submit" name="submit">Submit</button>

            <p class="signin">Don't have an acount ? <a href="studentSignup.php">Signup</a> </p>
        <?php
            if (isset($msg)) {
                echo $msg;
            }
            ?>
        </form>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
</script>

</html>