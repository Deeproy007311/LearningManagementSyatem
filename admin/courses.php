<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Courses</title>
    <!-- Bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <!-- Datatables css -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
</head>

<body>
    <!-- Database Connection -->
    <?php include '../partials/_dbconnect.php' ;?>
    <?php
    $update = false;
    $delete = false;
    //Delete
    if (isset($_GET['delete'])) {
        $sno = $_GET['delete'];
        $sql = "DELETE FROM `courses` WHERE `c_id` = $sno";
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
            $coursename = $_POST['coursename'];
            $coursedesc = $_POST['descriptionEdit'];
            $sql = "UPDATE `courses` SET `c_name` = '$coursename' , `c_desc` = '$coursedesc' WHERE `courses`.`c_id` = $sno";
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
          <h5 class="modal-title" id="editModalLabel">Edit this Note</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="courses.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="snoEdit" id="snoEdit">
            <div class="form-group">
              <label for="coursename">Course Name</label>
              <input type="text" class="form-control" id="coursename" name="coursename" aria-describedby="emailHelp">
            </div>

            <div class="form-group">
              <label for="coursedesc">Course Description</label>
              <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="3"></textarea>
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
  <!-- Heading -->
  <?php include 'header.php';?>
  <?php
    if ($update) {
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Success</strong> Your course has been updated successfuly.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    }
    if ($delete) {
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Success</strong> Your course has been deleted successfuly.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    }
  ?>
    
    <!-- Add courses link -->
    <div class="container-fluid my-3">
        <a href="addcourses.php" class="btn btn-success">Add New Courses</a>
    </div>
    <!-- Table -->
    <div class="container">
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">S.no</th>
                    <th scope="col">Course Name</th>
                    <th scope="col">Course Desciption</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql = "SELECT * FROM `courses`";
                    $result = mysqli_query($conn, $sql);
                    $sno = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $sno+=1;
                        echo '<tr>
                        <th scope="row">'. $sno .'</th>
                        <td>'. $row['c_name'] .'</td>
                        <td>'. $row['c_desc'] .'</td>
                        <td><button type="button" class=" edit btn btn-sm btn-warning" id="'. $row['c_id'] .'">Edit</button> <button type="button" class="delete btn btn-sm btn-danger" id="d'. $row['c_id'] .'">delete</button></td>
                    </tr>';
                    }
                
                ?>
                
            </tbody>
        </table>

    </div>





    <!-- Bootstrap script -->
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
    <script>
        //Edit Js
        edits = document.getElementsByClassName('edit');
        Array.from(edits).forEach((element) => {
        element.addEventListener("click", (e) => {
        console.log("edit");
        tr = e.target.parentNode.parentNode;
        title = tr.getElementsByTagName("td")[0].innerText;
        description = tr.getElementsByTagName("td")[1].innerText;
        console.log(title, description);
        coursename.value = title;
        descriptionEdit.value = description;
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
          window.location = `courses.php?delete=${sno}`;
        } else {
          console.log("No");
        }
      });
    });

    </script>
</body>

</html>