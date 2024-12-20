<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Annoucement List</title>
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
            <li class="breadcrumb-item active text-light" aria-current="page">Announcement</li>
        </ol>
    </nav>
    <button  data-bs-toggle="modal" data-bs-target="#createAnnouncementModal" class="btn btn-outline-light">Create Announcement</button>
</header>

<section class="p-4">
    <table id="BranchTable" class="table table-hover table-responsive-sm table-striped">
        <thead>
        <tr>
            <th>Picture</th>
            <th>Title</th>
            <th>Create At</th>
            <th>Description</th>
             <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        include_once '../Controller/announcementController.php';
        $test = new \Controller\announcementController();
        $test->displayAnnouncementList();
        ?>
        </tbody>
    </table
</section>

<div class="modal fade" id="createAnnouncementModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <form enctype="multipart/form-data" id="createFormAnnouncement" action="../Controller/announcementController.php" method="post" class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-muted" id="exampleModalLabel">Create Announcement</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-floating mb-3">
                    <input name="Title" type="text" class="form-control" id="floatingInput" placeholder="Title">
                    <label for="floatingInput">Title</label>
                </div>

                <div class="form-floating">
                    <textarea name="Description" class="form-control" placeholder="Description" id="floatingTextarea2" style="height: 100px"></textarea>
                    <label for="floatingTextarea2">Description</label>
                </div>

                <label class="p-5 bg-opacity-75 bg-secondary d-flex justify-content-center align-items-center rounded-3 mt-2" for="Upload">
                    <i class="fa-solid text-light fs-1 fa-file-arrow-up"></i>
                    <input style="display: none" id="Upload" name="imageUpload" class="form-control" accept="image/jpeg,image/png" type="file">
                </label>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </form>
    </div>
</div>
<script>
    let table = new DataTable('#BranchTable',{
        scrollCollapse: true,
        scrollY: '80vh',
        destroy: true,
        paging: true,
        searching: true,
    });

    $(document).ready(function (){


        $(document).on('submit','#createFormAnnouncement',function (event){
            event.preventDefault();
            const formData = new FormData(this)
            formData.append('action','createAnnouncement')

            $.ajax({
                url: '../Controller/announcementController.php',
                type: 'POST',
                contentType: false,
                processData: false,
                data: formData,
                dataType: 'json',
                success: function (data){
                    if (data.errors){
                        Swal.fire({
                            text: data.errors.error,  // Display the error message
                            confirmButtonColor: '#4361ee',
                            icon: 'warning',
                            toast: true,
                            target: 'body',
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 2000,  // Auto-close the alert after 2 seconds
                            timerProgressBar: true,  // Show the progress bar for the timer
                        });
                    }

                    if (data.success === true){
                        Swal.fire({
                            text: data.message,  // Display the error message
                            confirmButtonColor: '#4361ee',
                            icon: 'success',
                            target: 'body',
                            showConfirmButton: true,
                        });
                        setTimeout(() => {window.location.reload()},2000)
                    }

                }
            })
        })

        $(document).on('click', '#btn_update', function (event) {
            $.ajax({
                url: '../Controller/announcementController.php',
                data: {
                    id: event.target.value,
                    action: 'updateStudent'
                },
                type: 'POST',
                success: function (data) {
                    if ($('#AnnouncementModalUpdate').length === 0) {
                        $('body').append(data);
                    } else {
                        $('#AnnouncementModalUpdate').replaceWith(data)
                    }
                    $('#AnnouncementModalUpdate').modal('show')
                }
            });
        });


        $(document).on('submit','#UpdateForm',function (event){
            event.preventDefault();

            const formData = new FormData(this)
            formData.append('action','saveAnncement')

            $.ajax({
                url: '../Controller/announcementController.php',
                type: 'post',
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function (res){
                    if (res.success == true){
                        Swal.fire({
                            icon: "success",
                            text: res.message,
                            showConfirmButton: false,
                            timer: 2000
                        });
                        setTimeout(() =>{window.location.reload()},2000)
                    }
                }
            })

        })


        $(document).on('click','#btn_archive',function (e){

            Swal.fire({
                title: "Are you sure?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Archive it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    // ajax
                    $.ajax({
                        url: '../Controller/announcementController.php',
                        type: 'post',
                        dataType: 'json',
                        data:{
                            id: e.target.value,
                            action: 'archive'
                        },
                        success: function (res){
                            if (res.success == true){
                                Swal.fire({
                                    icon: "success",
                                    text: res.message,
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                                setTimeout(() =>{window.location.reload()},2000)
                            }
                        }
                    })
                }
            });


        })
    })

</script>
<script>

</script>
</body>
</html>
