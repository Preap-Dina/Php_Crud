<?php
    include 'function.php';

    session_start();
    if($_SESSION['role'] == 'user'){
        header('location: login.php');
    }   

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <!-- link bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <style>
        body::-webkit-scrollbar{
            display: none;
        }
        .border-btn{
            border: none !important;
        }
    </style>
</head>
<body>
    <!-- navbar -->
    <nav class="navbar py-3 shadow-sm fixed-top" style="background-color: #e3f2fd;">
        <div class="container-fluid px-3">
            <div class="d-flex border-none">
                <a class="navbar-brand me-2">Navbar</a>
                <nav class="nav nav-tabs border-none border-btn">
                    <button data-bs-toggle="tab" data-bs-target="#showProduct" class="btn btn-outline-primary me-2 active">Product</button>
                    <button data-bs-toggle="tab" data-bs-target="#showUser" class="btn btn-outline-primary">User</button>
                </nav>
            </div>
            <form class="d-flex m-0" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-primary  " type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop" id="btn_add">Add</button>
            </form>
        </div>
    </nav>

    <!-- add and update modal -->
    <form action="" method="post" enctype="multipart/form-data">
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="add_header">Add Product</h1>
                    <h1 class="modal-title fs-5" id="update_header">Update Product</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">

                    <label for="" class="form-label">Name:</label>
                    <input type="text" name="name" id="name" class="form-control">

                    <div class="d-flex justify-content-between mt-2">
                        <div class="w-50 me-2">
                            <label for="" class="form-label">Price:</label>
                            <input type="number" name="price" id="price" class="form-control">
                        </div>
                        <div class="w-50">
                            <label for="" class="form-label">Qty:</label>
                            <input type="number" name="qty" id="qty" class="form-control">
                        </div>
                    </div>

                    <label for="" class="form-label mt-2">Image:</label>
                    <input type="file" name="image" id="" class="form-control">
                    <input type="hidden" name="hidden_image" id="hidden_image">
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="btn_confirm_add" id="btn_confirm_add">Add</button>
                    <button type="submit" class="btn btn-warning" name="btn_confirm_update" id="btn_confirm_update">Update</button>
                </div>
                </div>
            </div>
        </div>
    </form>

    <!-- tab content -->
    <div class="tab-content">
        <div class="tab-pane show active" id="showProduct">
            <!-- show product -->
            <?php
                include 'showProduct.php';
            ?>

        </div>
        <div class="tab-pane show" id="showUser">
            <!-- show user -->
            <?php
                include 'showUser.php';
            ?>
        </div>
    </div>

    <!-- remove modal -->
    <form action="" method="post">
        <div class="modal fade" id="staticBackdropRemove" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Remove Product</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure to remove this product?</p>
                    <input type="hidden" name="hidden_id" id="hidden_id">
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="btn_confirm_remove">Remove</button>
                </div>
                </div>
            </div>
        </div>
    </form>

</body>
</html>

<script>
    $(document).ready(function(){
        // remove modal
        $('body').on('click', '#btn_remove', function(){
            let id = $(this).parents('tr').find('td').eq(0).text();
            $('#hidden_id').val(id);
        });

        // update modal
        $('body').on('click', '#btn_update', function(){
            $('#update_header').show();
            $('#add_header').hide();

            $('#btn_confirm_update').show();
            $('#btn_confirm_add').hide();

            let id = $(this).parents('tr').find('td').eq(0).text();
            let name = $(this).parents('tr').find('td').eq(1).text();
            let qty = $(this).parents('tr').find('td').eq(2).text();
            let price = $(this).parents('tr').find('td').eq(3).text();
            let image = $(this).parents('tr').find('td:eq(4) img').attr('alt');

            $('#id').val(id);
            $('#name').val(name);
            $('#qty').val(qty);
            $('#price').val(price);
            $('#hidden_image').val(image);   
        });

        // add modal
        $('#btn_add').on('click', function(){
            $('#add_header').show();
            $('#update_header').hide();

            $('#btn_confirm_add').show();
            $('#btn_confirm_update').hide();
        });
    })
</script>