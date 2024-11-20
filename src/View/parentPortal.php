<?php
session_start();
if (!$_SESSION['StudentId']){
    header('Location: ./Login.php');
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Parent Portal</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../style.css">
    <script src="../../js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <!--    ajax cdn-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!--    icon-->
    <script src="https://kit.fontawesome.com/d4532539ca.js" crossorigin="anonymous"></script>
   <style>
       #hero_section{
           background-position: center;
           background-repeat: no-repeat;
           background-size: cover;
           height: 40vh;
           background-image: linear-gradient(to top, #004581, rgba(16, 12, 12, 0.8)), url('../../Assets/parent_portal.jpg');
       }
     .card  img{
           height: 20vh;
         object-fit: cover;
       }


   </style>
</head>
<body >
<header style="background-color: #004581" class="container-fluid sticky-top">
    <nav class="navbar navbar-expand-md">
        <div class="container-fluid">
            <!-- Logo -->
            <a class="navbar-brand" href="#">
                <img style="width: 50px" class="img-fluid" src="../../Assets/69008b8b-9679-498b-9604-6ec799876f6c-removebg-preview.png" alt="logo">
            </a>

            <!-- Burger Menu Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Collapsible Content -->
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav d-flex gap-3">
                    <li class="nav-item">
                        <a data-bs-toggle="modal" data-bs-target="#ViewAttendance" style="color: #c1d4ec" href="#">
                            Attendance
                        </a>
                    </li>
                    <li class="nav-item">
                        <a style="color: #c1d4ec" href="./requirmentsManagement.php">
                            Requirements
                        </a>
                    </li>

                    <li class="nav-item">
                        <button id="btn_logout" class="btn btn-danger badge">
                            <i class="fa-solid fa-power-off"></i>
                        </button>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
</header>
<section id="hero_section" class="container-fluid d-flex flex-column justify-content-center align-items-centers p-5 sticky-top">
    <h5 class="fw-bold text-light">Hi, <?=ucfirst($_SESSION['Name'])?></h5>
    <h1  class="text-light">WELCOME TO PARENT PORTAL!</h1>
</section>
    <section id="announcement" class="container-fluid  mt-5 p-3">
        <?php
        include_once  '../Controller/announcementController.php';
        $studentId = $_SESSION['StudentId'];
        $announcement = new \Controller\announcementController();
        $announcement->DisplayAnnouncements()
        ?>
    </section>

<!-- Modal -->
<div class="modal fade" id="ViewAttendance" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Attendance For This Week</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Student Id</th>
                        <th scope="col">Student Name</th>
                        <th scope="col">Date</th>
                        <th scope="col">Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                      include_once '../Controller/attendanceConroller.php';
                      $studentId = $_SESSION['StudentId'];
                      $attendance = new \Controller\attendanceConroller();
                      $attendance->displayAttendance($studentId);
                    ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
    <?php
    ?>
</div>

<script>
     $(document).on('click','#btn_logout',function (){

         Swal.fire({
             text: "Are you sure you want to log out?",
             icon: "question",
             showCancelButton: true,
             confirmButtonColor: "#3085d6",
             cancelButtonColor: "#d33",
             confirmButtonText: "Yes"
         }).then((result) => {
             if (result.isConfirmed) {
                 window.location.href = '../Auth/logout.php'
             }
         });

     })
</script>

</body>
</html>