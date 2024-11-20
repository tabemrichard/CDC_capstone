<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Attendance</title>
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
</head>
<body >
<header style="background-color: #004581" class="container-fluid d-flex justify-content-between align-items-center p-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-light" href="./dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item active text-light" aria-current="page">Attendance</li>
        </ol>
    </nav>
</header>

<section class="p-4">
    <div class="col-lg-2">
        <select id="selectSchedule" class="form-select" aria-label="Default select example">
            <option selected>Select Schedule</option>
            <option value="afternoon">afternoon</option>
            <option value="morning">morning</option>
        </select>
    </div>
<br>

    <form id="formAttendance" method="POST" action="../Controller/attendanceConroller.php">
        <table id="BranchTable" class="table table-hover table-responsive-sm table-striped">
            <thead>
            <tr>
                <th>StudentId</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody id="tbody">

            </tbody>
        </table>

        <button type="submit" class="btn btn-primary mt-3">Submit Attendance</button>
    </form>
</section>

<!-- Modal for add new student -->
<div class="modal fade" id="EnrollStudent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form id="formEnroll" action="../Controller/studentConroller.php" method="post" class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Attendance</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex flex-column gap-2">

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button  style="background-color: #004581" type="submit" class="btn text-light">Enroll Now</button>
                </div>
        </form>
    </div>
</div>
<div id="con_modal">

</div>

<script>
    let table = new DataTable('#BranchTable',{
        scrollCollapse: true,
        scrollY: '80vh',
        destroy: true,
        paging: true,
        searching: true,
    });
</script>
<script>
    $(document).ready(function () {
        $(document).on('submit', '#formAttendance', function (event) {
            event.preventDefault(); // Prevent the default form submission

            const formData = new FormData(this); // Create FormData object
            formData.append('action','Attendance')
            $.ajax({
                url: '../Controller/attendanceConroller.php', // Adjust the URL to your controller
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false, // Prevent jQuery from processing data
                dataType: 'json',
                success: function (response) {
                   response.forEach((message) =>{
                       if (message.status === 'success'){
                           Swal.fire({
                               text: message.message,  // Display the error message
                               confirmButtonColor: '#4361ee',
                               icon: 'success',
                               toast: true,
                               target: 'body',
                               position: 'top-end',
                               showConfirmButton: false,
                               timer: 2000,  // Auto-close the alert after 2 seconds
                               timerProgressBar: true,  // Show the progress bar for the timer
                           });
                       }

                   })
                }
            });
        });

            $(document).on('change', '#selectSchedule', function (e) {
                $.ajax({
                    url:'../Controller/attendanceConroller.php',
                    type: 'POST',
                    data: {
                        schedule: e.target.value,
                        action: 'scheduleDis'
                    },
                    success: function (data, status) {
                        $('#tbody').html(data);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.error('AJAX Error: ', textStatus, errorThrown);
                        alert('There was an error processing your request. Please try again.');
                    }
                });
            });
    });

</script>
</body>
</html>