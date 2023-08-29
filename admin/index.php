<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['submit'])) {
    include '../partials/_dbconnect.php';

    $admin_email = $_POST['email'];
    $admin_pass = $_POST['password'];

    $sql = "SELECT * FROM `admin` WHERE admin_email='$admin_email'";
    $result = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($result);
    
    if ($numRows == 1) {
        $row = mysqli_fetch_assoc($result);
        $hashed_password = $row['admin_password'];
        
        // Compare manually hashed password with user input
        if ($admin_pass === $hashed_password) {
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['sno'] = $row['sno'];
            $_SESSION['admin_email'] = $admin_email;
            
            header("Location: /learningmanagementsystem/admin/dashboard.php");
            exit();
        } else {
            echo "Invalid password"; // Or handle the error
        }
    } else {
        echo "User not found"; // Or handle the error
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login form</title>
    <!-- Custom css file link -->
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <div class="form-container">
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <h3>Admin Login</h3>
            <input type="email" name="email" required placeholder="enter your email">
            <input type="password" name="password" required placeholder="enter your password">
            <input type="submit" name="submit" class="form-btn">
        </form>
    </div>

</body>

</html>