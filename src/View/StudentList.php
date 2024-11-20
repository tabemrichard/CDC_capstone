<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student List</title>
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
            <li class="breadcrumb-item active text-light" aria-current="page">Student List</li>
        </ol>
    </nav>
    <button data-bs-target="#EnrollStudent" data-bs-toggle="modal" class="btn btn-outline-light">Enroll New Student</button>
</header>

<section class="p-4">
    <table id="BranchTable" class="table table-hover table-responsive-sm table-striped">
        <thead>
        <tr>
            <th>StudentId</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        include_once '../Controller/studentConroller.php';
        $controller = new \Controller\studentConroller();
      $data =  $controller->displayStudents();

        ?>
        </tbody>
    </table>
</section>

<!-- Modal for add new student -->
<div class="modal fade" id="EnrollStudent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form id="formEnroll" action="../Controller/studentConroller.php" method="post" class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Student Information</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex flex-column gap-2">
                <?php
                  $tody = date('Y-m-d');
                ?>
                <label for="FirstName">
                    StudentId
                    <input  name="StudentId" type="text" class="form-control">
                </label>

                <label for="FirstName">
                      FirstName
                      <input name="FirstName" type="text" class="form-control">
                  </label>

                   <label for="LastName">
                       LastName
                      <input name="LastName" type="text" class="form-control">
                  </label>

                <label for="Age">
                    Age
                      <input name="Age" type="number" min="1" class="form-control">
                  </label>

                <label for="birthday">
                     Birthday
                      <input max="<?=$tody ?>" name="birthday" type="date" class="form-control">
                  </label>

                <select name="Gender" class="form-select" aria-label="Default select example">
                    <option value="''" selected>Gender</option>
                    <option value="Female">Female</option>
                    <option value="Male">Male</option>
                </select>

                <select name="schedule" class="form-select" aria-label="Default select example">
                    <option selected>Select Schedule</option>
                    <option value="morning">morning</option>
                    <option value="afternoon">afternoon</option>
                </select>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button  style="background-color: #004581" type="submit" class="btn text-light">Enroll Now</button>
            </div>
        </form>
    </div>
</div>
<div id="con_modal"></div>
<script>
    let table = new DataTable('#BranchTable',{
        scrollCollapse: true,
        scrollY: '50vh',
        destroy: true,
        paging: true,
        searching: true,
        ordering: true
    });
</script>
<script>

    $(document).ready(function () {
        $(document).on('click', '#btn_update', function (event) {
            $.ajax({
                url: '../Controller/studentConroller.php',
                data: {
                    id: event.target.value,
                    action: 'updateStudent'
                },
                type: 'POST',
                success: function (data, status) {
                    if ($('#UpdateModal').length === 0) {
                        $('body').append(data);
                    } else {
                        $('#UpdateModal').replaceWith(data)
                    }
                    $('#UpdateModal').modal('show')
                }
            });
        });


        $(document).on('submit','#formUpdate',function (e){
            e.preventDefault();
            const formData = new FormData(this)
            formData.append('action','SaveInfo')

            $.ajax({
                url: '../Controller/studentConroller.php',
                type: 'POST',
                contentType: false,
                processData: false,
                data: formData,
                dataType: 'json',
                success: function (data){
                    console.log(data)
                    if (data.success === true){
                        $('#UpdateModal').modal('hide')
                        Swal.fire({
                            text: data.message,
                            icon: "success",
                            confirmButtonColor: '#4361ee',
                            iconColor: '#4361ee'
                        });
                        setTimeout(() => {
                            window.location.reload();
                        }, 2000);
                    }
                }
            })
        })


        $(document).on('click','#archiveBTN',function (e){

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '../Controller/studentConroller.php',
                        type: 'POST',
                        dataType: 'json',
                        data:{
                            id: e.target.value,
                            action: 'archiveStudent'
                        },
                        success: function(data){
                            if (data.success === true){
                                Swal.fire({
                                    text: data.message,
                                    icon: "success",
                                    confirmButtonColor: '#4361ee',
                                    iconColor: '#4361ee'
                                });
                                setTimeout(() => {
                                    window.location.reload();
                                }, 2000);
                            }
                        }
                    })
                }
            });
        })



        $(document).on('submit','#formEnroll',function (event){
            event.preventDefault();
            const formData = new FormData(this)
            formData.append('action','addStudent')

            $.ajax({
                url: '../Controller/studentConroller.php',
                type: 'POST',
                dataType: 'json',
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                    console.log(data)
                    if (data.errors) {  // Check for errors (matching the PHP response)
                        // Loop through the errors and show them one by one
                        $.each(data.errors, function (field, message) {
                            Swal.fire({
                                text: message,  // Display the error message
                                confirmButtonColor: '#4361ee',
                                iconColor: '#ff6347',
                                icon: 'warning',
                                toast: true,
                                target: 'body',
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 2000,  // Auto-close the alert after 2 seconds
                                timerProgressBar: true,  // Show the progress bar for the timer
                            });
                        });
                    }
                    if (data.success === true){
                        Swal.fire({
                            text: data.message,
                            icon: "success",
                            confirmButtonColor: '#4361ee',
                            iconColor: '#4361ee'
                        });
                        setTimeout(() => {
                            window.location.reload();
                        }, 2000);
                    }
                }
            });

        })
    });

</script>
</body>
</html>