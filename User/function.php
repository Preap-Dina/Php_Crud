<!-- jquery link -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- sweetAlert link -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<?php
    include '../connection.php';
    session_start();

    // show product function in user page
    function showProduct(){
        global $connection;
        
        $sql_select = "SELECT * FROM tbl_product ORDER BY product_id DESC";

        $result = $connection->query($sql_select);

        while($row = mysqli_fetch_assoc($result)){
            echo '
                <div class="col-3">
                    <div class="card mt-5 shadow">
                        <img src="../uploads/'.$row['image'].'" class="card-img-top" alt="..." style="height: 15rem;">
                        <div class="card-body">
                            <h5 class="card-title text-primary">'.$row['product_name'].'</h5>
                            <p class="card-text text-danger ">'.'$ '.$row['price'].'</p>
                            <a href="#" class="btn btn-primary">BUY NOW</a>
                        </div>
                    </div>
                </div>
            ';
        }
    };
?>