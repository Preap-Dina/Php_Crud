<!-- jquery link -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- sweetAlert link -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<?php
    include '../connection.php';
    session_start();

    // ==================== Product infor Section ====================
    // add Product function
    function addProduct(){
        global $connection;
        if(isset($_POST['btn_confirm_add'])){
            $name = $_POST['name'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];
            $image = $_FILES['image']['name'];

            if(!empty($name) && !empty($price) && !empty($qty) && !empty($image)){
                $file = time().'-'.$image;
                $path = '../uploads/'.$file;
                move_uploaded_file($_FILES['image']['tmp_name'], $path);
            }

            $sql_insert = "INSERT INTO tbl_product (product_name, qty, price, image) 
                            VALUES ('$name', '$qty', '$price', '$file')";

            $result = $connection->query($sql_insert);

            if($result){
                echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "Done",
                                text: "You added new product",
                                icon: "success",
                                button: "confirm",
                            });
                        });
                    </script>
                ';
            }
        }
    };
    addProduct();


    // show product function
    function showProduct(){
        global $connection;
        
        $sql_select = "SELECT * FROM tbl_product ORDER BY product_id DESC";

        $result = $connection->query($sql_select);

        while($row = mysqli_fetch_assoc($result)){
            echo '
                <tr>
                    <td class="ps-3 height">'.$row['product_id'].'</td>
                    <td class="ps-3 height">'.$row['product_name'].'</td>
                    <td class="ps-3 height">'.$row['qty'].'</td>
                    <td class="ps-3 height">'.$row['price'].'</td>
                    <td class="ps-3 height"><img src="../uploads/'.$row['image'].'" alt="'.$row['image'].'" class="h-100 w-50"></td>
                    <td class="ps-3 height">
                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#staticBackdrop" id="btn_update">Edit</button>
                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdropRemove" id="btn_remove">Remove</button>
                    </td>
                </tr>
            ';
        }
    };


    // remove product function
    function removeProduct(){
        global $connection;
        if(isset($_POST['btn_confirm_remove'])){
            $id = $_POST['hidden_id'];

            $sql_delete = "DELETE FROM tbl_product WHERE product_id = '$id'";

            $result = $connection->query($sql_delete);

            if($result){
                echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "Done",
                                text: "You removed a product",
                                icon: "success",
                                button: "confirm",
                            });
                        });
                    </script>
                ';
            }
        }
    };
    removeProduct();


    // update product function
    function updateProduct(){
        global $connection;
        date_default_timezone_set('Asia/Phnom_Penh');
        if(isset($_POST['btn_confirm_update'])){
            $id = $_POST['id'];
            $name = $_POST['name'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];
            $new_image = $_FILES['image']['name'];
            $old_image = $_POST['hidden_image'];

            $updated_at = date('ymdhis');

            if(empty($new_image)){
                $file = $old_image;
            }else{
                $file = time().'-'.$new_image;
                $path = '../uploads/'.$file;
                move_uploaded_file($_FILES['image']['tmp_name'], $path);
            }

            $sql_update = "UPDATE tbl_product 
                           SET product_name='$name', qty='$qty', price='$price', image='$file', updated_at='$updated_at' WHERE product_id='$id'";

            $result = $connection->query($sql_update);

            if($result){
                echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "Done",
                                text: "You updated this product",
                                icon: "success",
                                button: "confirm",
                            });
                        });
                    </script>
                ';
            }
        }
    };
    updateProduct();


    // ==================== Authentication Section ====================
    // register function
    function signUp(){
        global $connection;
        if(isset($_POST['btn_signup'])){
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $profile = $_FILES['profile']['name'];

            if(!empty($username) && !empty($email) && !empty($password) && !empty($profile)){
                $file = time().'-'.$profile;
                $path = '../uploads/'.$file;
                move_uploaded_file($_FILES['profile']['tmp_name'], $path);
            }

            if(empty($username) || empty($email) || empty($password) || empty($profile)){
                echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "Error",
                                text: "Please fill all fields",
                                icon: "error",
                                button: "confirm",
                            });
                        });
                    </script>
                ';
            }else{
                $sql_insert = "INSERT INTO tbl_user (username, email, password, profile) 
                               VALUES ('$username', '$email', '$password', '$file')";

                $result = $connection->query($sql_insert);
                header('Location: Login.php');
            }
        }
    };
    signUp();


    // login function
    function Login(){
        global $connection;
        if(isset($_POST['btn_login'])){
            $username_email = $_POST['username_email'];
            $password = $_POST['password'];

            $getUser = "SELECT username, role FROM tbl_user WHERE (username='$username_email' OR email='$username_email') AND password='$password'";
            $result = $connection->query($getUser);
            while($row = mysqli_fetch_assoc($result)){
                $_SESSION['user'] = $row['username'];
                $_SESSION['role'] = $row['role'];

                if($_SESSION['role'] == 'admin'){
                    echo '
                        <script>
                            window.location.href = "dashboard.php";
                        </script>    
                    ';
                }else if($_SESSION['role'] == 'user'){
                    echo '
                        <script>
                            window.location.href = "../User/index.php";
                        </script>    
                    ';
                }else{
                    echo '
                        <script>
                            Swal.fire({
                                title: "Error!",
                                text: "Invalid username or password!",
                                icon: "error"
                            });
                        </script>
                    ';
                }

            }
        }
    };
    Login();



    // ==================== User information Section ====================
    // show user function
    function showUser(){
        global $connection;
        
        $sql_select = "SELECT * FROM tbl_user ORDER BY user_id DESC";

        $result = $connection->query($sql_select);

        while($row = mysqli_fetch_assoc($result)){
            echo '
                <tr>
                    <td class="ps-3 height">'.$row['user_id'].'</td>
                    <td class="ps-3 height">'.$row['username'].'</td>
                    <td class="ps-3 height">'.$row['email'].'</td>
                    <td class="ps-3 height">'.$row['password'].'</td>
                    <td class="ps-3 height">'.$row['role'].'</td>
                    <td class="ps-3 height"><img src="../uploads/'.$row['profile'].'" alt="'.$row['profile'].'" class="h-100 w-50"></td>
                    <td class="ps-3 height">
                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#staticBackdrop" id="btn_update">Edit</button>
                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdropRemove" id="btn_remove">Remove</button>
                    </td>
                </tr>
            ';
        }
    };
?>