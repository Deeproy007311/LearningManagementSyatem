<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Lessons</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
      <!-- Font Awsome -->
    <script src="https://kit.fontawesome.com/2f671c2a32.js" crossorigin="anonymous"></script>
</head>

<body>
    <!-- Database Connection -->
    <?php include '../partials/_dbconnect.php';?>
    <?php
    // Delete query
    if (isset($_GET['delete'])) {
      $sno = $_GET['delete'];
      $sql = "DELETE FROM `lessons` WHERE `lesson_id` = $sno";
      $result = mysqli_query($conn, $sql);
      if ($result) {
        $delete = true;
      }else{
        $deleteMsg = "We could delete the record successfully";
      }

    }
    // Update query
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['snoEdit'])) {
            $sno = $_POST['snoEdit'];
            $lessonname = $_POST['lessonname'];
            $lessonlink = $_POST['lessionlink'];
            $sql = "UPDATE `lessons` SET `lesson_name` = '$lessonname' , `lesson_link` = '$lessonlink' WHERE `lessons`.`lesson_id` = $sno";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $update = true;
            }else {
                $updateMsg =  "We could not update the record successfully";
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
          <h5 class="modal-title" id="editModalLabel">Edit this Lesson</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="lessons.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="snoEdit" id="snoEdit">
            <div class="form-group">
              <label for="lessonname">Lesson Name</label>
              <input type="text" class="form-control" id="lessonname" name="lessonname" aria-describedby="emailHelp">
            </div>

            <div class="form-group">
              <label for="lessonlink">Lesson Link</label>
              <textarea class="form-control" id="lessionlink" name="lessionlink" rows="3"></textarea>
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
    <!-- Main Content -->
    <div class="container">
        <h2>Lessons</h2>
        <form action="" class="mt-3 form-inline d-print-none">
            <div class="form-group mr-3">
                <label for="checkid">Enter Course ID: </label>
                <input type="text" name="checkid" id="checkid" class="form-control ml-3">
            </div>
            <button type="submit" class="btn btn-success mt-3">Search</button>
        </form>
        <?php
            $sql = "SELECT `c_id` FROM courses";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                if (isset($_REQUEST['checkid']) && $_REQUEST['checkid'] == $row['c_id']) {
                    $sql = "SELECT * FROM `courses` WHERE `c_id` = {$_REQUEST['checkid']}";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    if (($row['c_id']) == $_REQUEST['checkid']) {
                        $_SESSION['c_id'] = $row['c_id'];
                        $_SESSION['c_name'] = $row['c_name'];
        ?>
                        <h3 class="mt-5 bg-dark text-white p-2">
                            Course ID: <?php if (isset($row['c_id'])) { echo $row['c_id']; }?>
                            Course Name: <?php if (isset($row['c_name'])) { echo $row['c_name']; }?>
                        </h3>
                    <?php

                        $sql = "SELECT * FROM `lessons` WHERE `course_id` = {$_REQUEST['checkid']}";
                        $result = mysqli_query($conn, $sql);
                        echo '<table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Lesson ID</th>
                            <th scope="col">Lesson Name</th>
                            <th scope="col">Lesson Link</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>';
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>
                            <th scope="row">'. $row['lesson_id'] .'</th>
                            <td>'. $row['lesson_name'] .'</td>
                            <td>'. $row['lesson_link'] .'</td>
                            <td><button type="button" class="edit btn btn-warning" id="'. $row['lesson_id'] .'">Edit</button> <button type="button" class="delete btn btn-danger" id="d'. $row['lesson_id'] .'">Delete</button></td>
                          </tr>';
                        }
                          
                        echo '</tbody>
                      </table>';
                    } 
                }
            }
            ?>
    </div>

    <?php
        if (isset($_SESSION['c_id'])) {
            echo '<div class="container my-5">
            <a href="addlessons.php" class="btn btn-success box"><i class="fa-solid fa-plus"></i></a>
        </div>';
        }
    
    ?>
    

    
        <!-- Bootstrap script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script>
        //Edit Js
        edits = document.getElementsByClassName('edit');
        Array.from(edits).forEach((element) => {
        element.addEventListener("click", (e) => {
        console.log("edit");
        tr = e.target.parentNode.parentNode;
        lessonname = tr.getElementsByTagName("td")[0].innerText;
        lessonlink = tr.getElementsByTagName("td")[1].innerText;

        // Get the input fields by their IDs
        var lessonnameInput = document.getElementById("lessonname");
        var lessonlinkInput = document.getElementById("lessionlink");

        // Set the values of the input fields
        lessonnameInput.value = lessonname;
        lessonlinkInput.value = lessonlink;

        snoEdit.value = e.target.id;
        console.log(e.target.id);
        $('#editModal').modal('toggle');
    });
  });
  // Delete Js
    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ",);
        sno = e.target.id.substr(1,);

        if (confirm("Are you sure?")) {
          console.log("yes");
          window.location = `lessons.php?delete=${sno}`;
        } else {
          console.log("No");
        }
      });
    });


    </script>
</body>

</html>