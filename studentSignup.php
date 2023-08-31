<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['submit'])) {
        // Database Connection
        include 'partials/_dbconnect.php';


        $student_name = $_POST['student_name'];
        $student_email = $_POST['student_email'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        $occupation = $_POST['occupation'];

         //check wheather the username is already exists in the database or not
         $existsSql = "SELECT * FROM `students` WHERE `student_email` = '$student_email'";
         $result = mysqli_query($conn, $existsSql);
         $numExistsRows = mysqli_num_rows($result);


         if ($numExistsRows > 0) {
            $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Email already exists.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
         }
         else {
            // Checking the correct password
            if (($password!=$cpassword)) {
                $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> Your password do not match
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
            }
            else {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO `students`(`student_name`, `student_email`, `password`, `occupation`) VALUES ('$student_name','$student_email','$hash','$occupation')";
                mysqli_query($conn, $sql);
                header("Location: studentLogin.php");
            }
         }
    }


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="userPanelCss/index.css">
    <link rel="stylesheet" href="userPanelCss/signup.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

</head>

<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
            <form id="signupForm" class="form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <p class="title">Register </p>
            <p class="message">Signup now and get full access to our app. </p>
            <label>
                <input required="" placeholder="" type="text" name="student_name" class="input" >
                <span>Name</span>
            </label>

            <label>
                <input required="" placeholder="" type="email" name="student_email" class="input" >
                <span>Email</span>
            </label>

            <label>
                <input required="" placeholder="" type="password" name="password" class="input" >
                <span>Password</span>
            </label>
            <label>
                <input required="" placeholder="" type="password" name="cpassword" class="input" >
                <span>Confirm password</span>
            </label>
            <label>
                <input required="" placeholder="" type="text" name="occupation" class="input" >
                <span>Occupation</span>
            </label>
            <button class="submit" name="submit">Submit</button>

            <p class="signin">Already have an acount ? <a href="studentLogin.php">Login</a> </p>
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