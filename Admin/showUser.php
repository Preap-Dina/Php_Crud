<!-- table user -->

<style>
    .height{
        height: 75px !important;
    }
</style>

<div class="container-fluid px-3">
    <table class="table table-hover border align-middle border-dark table-sm" style="table-layout: fixed; margin-top: 100px;">
        <tr class="table-dark">
            <th class="ps-3 py-2">ID</th>
            <th class="ps-3 py-2">USERNAME</th>
            <th class="ps-3 py-2">EMAIL</th>
            <th class="ps-3 py-2">PASSWORD</th>
            <th class="ps-3 py-2">ROLE</th>
            <th class="ps-3 py-2">PROFILE</th>
            <th class="ps-3 py-2">ACTION</th>
        </tr>
        <?php showUser(); ?>
    </table>
</div>