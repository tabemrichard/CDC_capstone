<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <script src="../../js/bootstrap.bundle.min.js"></script>
    <!--    ajax cdn-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!--    cdn sweet alert-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Register</title>
</head>
<body style="background-color: #004581" class="container-fluid d-flex flex-column justify-content-center align-items-center">
<main style="color: #afd5e3" class="mt-5 d-flex flex-column p-5 gap-2 align-items-center justify-content-center">
    <div class="d-flex flex-column align-items-center justify-content-center">
        <img class="img-fluid col-lg-3 col-md-5 col-sm-1" src="../../Assets/69008b8b-9679-498b-9604-6ec799876f6c-removebg-preview.png" alt="logo">
        <h6>CHILD DEVELOPMENT CENTER MANAGEMENT SYSTEM</h6>
    </div>
    <h5>Create an Account</h5>
    <br>

<form id="RegisterForm" class="d-flex flex-column justify-content-center gap-2  container" action="#" method="post">
    <h5>Parent Information</h5>
        <label for="Name">
            Full Name
            <input name="parentName" type="text" class="form-control" placeholder="Full Name">
        </label>

        <label for="Email">
            Email Address
            <input name="UserName" type="email" class="form-control" placeholder="Email Address">
        </label>

        <label for="Password">
            Password
            <input name="Password" type="password" class="form-control" placeholder="Password">
        </label>
    <br>
    <div>
        <h5>Child Information</h5>
    </div>
        <label for="Name">
            Full Name
            <input name="childName" type="text" class="form-control" placeholder="Full Name">
        </label>
        <label for="studentId">
            Student Id
            <input name="StudentNumber" type="text" class="form-control" placeholder="Student Id">
        </label>
    <button class="btn btn-outline-light" type="submit">Create Account</button>
    <div class="d-flex gap-2">
        <p>already have an account</p>
        <a href="./Login.php">login</a>
    </div>
</form>
</main>
<script>
  $(document).ready(function (){
    $(document).on('submit','#RegisterForm',function (event){
        event.preventDefault()
        const formData = new FormData(this)
        $.ajax({
           url: '../Controller/register.php',
            type: 'post',
            dataType: 'json',
            data: formData,
            processData: false,
            contentType: false,
            success: function (data){
               console.log(data)
                if (data.errors){
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
                }

                if (data.success === true){
                    Swal.fire({
                        text: data.message,  // Display the error message
                        confirmButtonColor: '#4361ee',
                        icon: 'success',
                        toast: true,
                        target: 'body',
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,  // Auto-close the alert after 2 seconds
                        timerProgressBar: true,  // Show the progress bar for the timer
                    });
                    setTimeout(()=>{
                        window.location.href = 'Login.php';
                    },3000)
                }

                if (data.message === 'Invalid Student Number'){
                    Swal.fire({
                        text: data.message,  // Display the error message
                        confirmButtonColor: '#4361ee',
                        iconColor: '#ff6347',
                        icon: 'error',
                        toast: true,
                        target: 'body',
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 1000,  // Auto-close the alert after 2 seconds
                        timerProgressBar: true,  // Show the progress bar for the timer
                    });
                }
                   if (data.message === 'Username already exists'){
                    Swal.fire({
                        text: data.message,  // Display the error messages
                        confirmButtonColor: '#4361ee',
                        iconColor: '#ff6347',
                        icon: 'error',
                        toast: true,
                        target: 'body',
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,  // Auto-close the alert after 2 seconds
                        timerProgressBar: true,  // Show the progress bar for the timer
                    });
                }

            }

        })

    })
  })
</script>
</body>
</html>