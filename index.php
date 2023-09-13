<?php
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>codeXLearns</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="userPanelCss/home.css">
    <!-- Font awesome -->
    <script src="https://kit.fontawesome.com/2f671c2a32.js" crossorigin="anonymous"></script>
</head>

<body>
    <!-- Database Connection -->
    <?php include 'partials/_dbconnect.php';?>
    <!-- Header connection -->
    <?php include '_header.php' ?>
    <div class="heading-container d-flex justify-content-center align-items-center">
        <div class="container ">
            <h1 class="">Online Learning Platform</h1>
            <p class="">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi, expedita iusto est quos
                excepturi eius.</p>
            <?php
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                // User is logged in, show "Join for free" and "View More" buttons that redirect to courses.php
                echo '<a href="studentCourses.php" class="button btn text-center">Join for free</a>';
            } else {
                // User is not logged in, show an alert when clicking these buttons
                echo '<a href="#" class="button btn text-center" onclick="showAlert()">Join for free</a>';
            }
            ?>
        </div>
    </div>
    <div class="container my-5">
        <h1 class="text-center ">Top Courses</h1>
        <div class="row course-row">
            <!-- php code -->
            <?php
            $sql = "SELECT * FROM `courses` LIMIT 3";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $course_id = $row['c_id'];
                $course_name = $row['c_name'];
                $course_description = $row['c_desc'];
                echo '<div class="card mx-4 my-4" style="width: 18rem;">
                    <img src="https://source.unsplash.com/400x300/?' . $course_name . ',code" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">' . $course_name . '</h5>
                        <p class="card-text">' . substr($course_description, 0, 40) . '...</p>';
                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                    // User is logged in, show "Enroll" button that redirects to studentCourseDetails.php
                    echo '<a href="studentCourseDetails.php?course_id=' . $course_id . '" class="btn btn-primary">Enroll</a>';
                } else {
                    // User is not logged in, show an alert when clicking the "Enroll" button
                    echo '<a href="#" class="btn btn-primary" onclick="showAlert()">Enroll</a>';
                }
                echo '</div>
                </div>';
            }
            ?>
            <div class="row justify-content-center">
                <div class="col-12 text-center">
                    <?php
                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                        // User is logged in, show "View More" button that redirects to courses.php
                        echo '<a href="studentCourses.php" class="button btn text-center">View More</a>';
                    } else {
                        // User is not logged in, show an alert when clicking the "View More" button
                        echo '<a href="#" class="button btn text-center" onclick="showAlert()">View More</a>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- static information-1 -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <div class="container container-image">
                    <img src="userPanelImages/index1.webp" alt="index1" class="img-fluid">
                </div>
            </div>
            <div class="col-md-6">
                <div class="container container-info my-5">
                    <h1 class="text-contrast ">Learner outcomes on courses you will take</h1>
                    <i class="fa-solid fa-check" style="color: #f2cb07;"></i>
                    <p class="text-contrast font-weight-bold ">Techniques to engage effectively with vulnerable children
                    </p>
                    <i class="fa-solid fa-check" style="color: #f2cb07;"></i>
                    <p class="text-contrast font-weight-bold ">Techniques to engage effectively with vulnerable children
                    </p>
                    <i class="fa-solid fa-check" style="color: #f2cb07;"></i>
                    <p class="text-contrast font-weight-bold ">Techniques to engage effectively with vulnerable children
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts section-bg">
        <div class="container">

            <div class="row counters">

                <div class="col-lg-3 col-6 text-center">
                    <span data-purecounter-start="0" data-purecounter-end="1232" data-purecounter-duration="1"
                        class="purecounter">45</span>
                    <p>Students</p>
                </div>

                <div class="col-lg-3 col-6 text-center">
                    <span data-purecounter-start="0" data-purecounter-end="64" data-purecounter-duration="1"
                        class="purecounter">9</span>
                    <p>Courses</p>
                </div>

                <div class="col-lg-3 col-6 text-center">
                    <span data-purecounter-start="0" data-purecounter-end="42" data-purecounter-duration="1"
                        class="purecounter">6</span>
                    <p>Events</p>
                </div>

                <div class="col-lg-3 col-6 text-center">
                    <span data-purecounter-start="0" data-purecounter-end="15" data-purecounter-duration="1"
                        class="purecounter">30</span>
                    <p>Trainers</p>
                </div>

            </div>

        </div>
    </section><!-- End Counts Section -->
    <!-- ======= Trainers Section ======= -->
    <section id="trainers" class="trainers">
        <div class="container" data-aos="fade-up">

            <div class="row" data-aos="zoom-in" data-aos-delay="100">
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                    <div class="member">
                        <img src="userPanelImages/trainer-1.jpg" class="img-fluid" alt="">
                        <div class="member-content">
                            <h4>Walter White</h4>
                            <span>Web Development</span>
                            <p>
                                Magni qui quod omnis unde et eos fuga et exercitationem. Odio veritatis perspiciatis
                                quaerat qui aut aut aut
                            </p>
                            <div class="social">
                                <a href=""><i class="bi bi-twitter"></i></a>
                                <a href=""><i class="bi bi-facebook"></i></a>
                                <a href=""><i class="bi bi-instagram"></i></a>
                                <a href=""><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                    <div class="member">
                        <img src="userPanelImages/trainer-2.jpg" class="img-fluid" alt="">
                        <div class="member-content">
                            <h4>Sarah Jhinson</h4>
                            <span>Marketing</span>
                            <p>
                                Repellat fugiat adipisci nemo illum nesciunt voluptas repellendus. In architecto rerum
                                rerum temporibus
                            </p>
                            <div class="social">
                                <a href=""><i class="bi bi-twitter"></i></a>
                                <a href=""><i class="bi bi-facebook"></i></a>
                                <a href=""><i class="bi bi-instagram"></i></a>
                                <a href=""><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                    <div class="member">
                        <img src="userPanelImages/trainer-3.jpg" class="img-fluid" alt="">
                        <div class="member-content">
                            <h4>William Anderson</h4>
                            <span>Content</span>
                            <p>
                                Voluptas necessitatibus occaecati quia. Earum totam consequuntur qui porro et laborum
                                toro des clara
                            </p>
                            <div class="social">
                                <a href=""><i class="bi bi-twitter"></i></a>
                                <a href=""><i class="bi bi-facebook"></i></a>
                                <a href=""><i class="bi bi-instagram"></i></a>
                                <a href=""><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section><!-- End Trainers Section -->
    <!-- Footer -->
    <?php include '_footer.php';?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
    <script>
    function showAlert() {
        alert("Please log in to start you learning journey");
    }
    </script>
</body>

</html>