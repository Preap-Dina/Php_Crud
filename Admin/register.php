<?php
    include 'function.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- link boostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- link jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
    <!-- sign up form modal -->
    <form action="" method="post" enctype="multipart/form-data">
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-center w-100" id="add_header">Register Form</h1>
                </div>
                <div class="modal-body">
                    <label for="" class="form-label">Username:</label>
                    <input type="text" name="username" class="form-control">

                    <label for="" class="form-label mt-2">Email:</label>
                    <input type="text" name="email" class="form-control">

                    <label for="" class="form-label mt-2">Password:</label>
                    <input type="password" name="password" class="form-control">

                    <label for="" class="form-label mt-2">Profile:</label>
                    <input type="file" name="profile" class="form-control">

                    <a href="./Login.php" class="d-flex justify-content-center pt-3">Already have an account?</a>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary w-100" name="btn_signup">Sign up</button>
                </div>
                </div>
            </div>
        </div>
    </form>
    
</body>
</html>

<script>
    $(document).ready(function(){
        $('#staticBackdrop').modal('show');
    })
</script>