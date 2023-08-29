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
    <title>Admin || Students</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="css/restall.css"> -->
    <!-- Font Awsome -->
    <script src="https://kit.fontawesome.com/2f671c2a32.js" crossorigin="anonymous"></script>
</head>

<body?>
    <!-- Database Connection -->
    <?php include '../partials/_dbconnect.php';?>
    <?php
    $update = false;
    $delete = false;
    //Delete
    if (isset($_GET['delete'])) {
        $sno = $_GET['delete'];
        $sql = "DELETE FROM `students` WHERE `student_id` = $sno";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $delete = true;
        }else{
            echo "We could not updated the record successfuly";
        }

    }
     // Update
     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['snoEdit'])) {
            $sno = $_POST['snoEdit'];
            $student_name = $_POST['student_name'];
            $student_email = $_POST['student_email'];
            $sql = "UPDATE `students` SET `student_name` = '$student_name' , `student_email` = '$student_email' WHERE `students`.`student_id` = $sno";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $update = true;
            }else {
                echo "We could not update the record successfully";
            }
        }
    }    
    
    
    ?>
    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Student</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="students.php" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="snoEdit" id="snoEdit">
                        <div class="form-group">
                            <label for="student_name">Student Name</label>
                            <!-- <input type="text" class="form-control" id="student_name" name="student_name" aria-describedby="emailHelp"> -->
                            <input type="text" class="form-control" id="student_name" name="student_name"
                                aria-describedby="emailHelp">
                        </div>

                        <div class="form-group">
                            <label for="student_email">Student Email</label>
                            <!-- <textarea class="form-control" id="student_email" name="student_email" rows="3"></textarea> -->
                            <textarea class="form-control" id="student_email" name="student_email"
                                rows="3"></textarea>

                        </div>
                    </div>
                    <div class="modal-footer d-block mr-auto">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Header connect -->
    <?php include 'header.php';?>
    <div class="container mt-5">
        <a href="addstudents.php" class="btn btn-success"><i class="fa-solid fa-plus"></i></a>
    </div>
    <div class="container">
        <h1>Students</h1>
    </div>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Student ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
     $sql = "SELECT * FROM `students`";
     $result = mysqli_query($conn, $sql);
     while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>
        <th scope="row">'. $row['student_id'] .'</th>
        <td>'. $row['student_name'] .'</td>
        <td>'. $row['student_email'] .'</td>
        <td><button type="button" class="edit btn btn-sm btn-warning" id="'. $row['student_id'] .'">edit</button> <button type="button" class="delete btn btn-sm btn-danger" id="d'. $row['student_id'] .'">delete</td>
      </tr>';
     }

    ?>
  </tbody>
  </table>
    </div>

   


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

      <script>
        // Edit Js
          edits = document.getElementsByClassName('edit');
          Array.from(edits).forEach((element) => {
          element.addEventListener("click", (e) => {
          console.log("edit");
          tr = e.target.parentNode.parentNode;
          title = tr.getElementsByTagName("td")[0].innerText;
          description = tr.getElementsByTagName("td")[1].innerText;
          console.log(title, description);
          student_name.value = title;
          student_email.value = description;
          snoEdit.value = e.target.id;
          console.log(e.target.id);
          $('#editModal').modal('toggle');
        });
        });

        // Delete js
        deletes = document.getElementsByClassName('delete');
        Array.from(deletes).forEach((element) => {
        element.addEventListener("click", (e) => {
        console.log("edit ",);
        sno = e.target.id.substr(1,);

        if (confirm("Are you sure?")) {
          console.log("yes");
          window.location = `students.php?delete=${sno}`;
        } else {
          console.log("No");
        }
         });
        });
      </script>

    
    </body>

</html>