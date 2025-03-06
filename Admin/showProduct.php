<!-- table product -->

<style>
    .height{
        height: 750px !important;
    }
</style>

<div class="container-fluid px-3">
    <table class="table table-hover border align-middle border-dark table-sm" style="table-layout: fixed; margin-top: 100px;">
        <tr class="table-dark">
            <th class="ps-3 py-2">ID</th>
            <th class="ps-3 py-2">NAME</th>
            <th class="ps-3 py-2">QTY</th>
            <th class="ps-3 py-2">PRICE</th>
            <th class="ps-3 py-2">IMAGE</th>
            <th class="ps-3 py-2">ACTION</th>
        </tr>
        <?php showProduct(); ?>
    </table>
</div>