<?= $this->extend('template/template'); ?>

<?= $this->section('content'); ?>

<!-- page content -->
<style type="text/css">
    thead,
    tr {
        text-align: center;
    }
</style>
<div class="right_col" role="main">

    <main role="main" class="container-fluid">

        <!-- FLASDATA -->
        <?php if (session()->get('message')) : ?>
            <div class="alert alert-success alert-dismissble fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                Data berhasil dihapus <strong <?= session()->getFlashData('message'); ?>></strong>
            </div>
        <?php endif ?>
        <!-- FLASDATA -->



        <h1 style="font-size: 23px;">Hasil Pencarian Data Linked User </h1><br>
        <!-- SEARCH -->
        <form action="/linkeduser/hasilpencarian" method="GET">
            <div class="page-title">
                <div class="title_right" style="float: right;" style="margin-top: 30px;">
                    <div class="col-md-15 col-sm-15  form-group row pull-right top_search">
                        <div class="input-group" style="float: right;">
                            <input type="text" name="cari" class="form-control" placeholder="Search for..." autocomplete="off">
                            <span class="input-group-btn">
                                <button class="btn btn-secondary" type="submit" value="cari">Go!</button>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- <a href="/linkeduser/create" class="btn btn-primary">Tambah Data</a> -->
            </div>
        </form>
        <div class="clearfix"></div>
        <!-- SEARCH -->


        <hr>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <th>Linked_Erp_User_Id</th>
                    <th>Erp_User_Id</th>
                    <th>Erp_user_Email</th>
                    <th>Server_Id</th>
                    <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($datalinkeduser as $user) {
                    ?>
                        <tr>
                            <td><?php echo $user['LINKED_ERP_USER_ID']; ?></td>
                            <td><?php echo $user['ERP_USER_ID']; ?></td>
                            <td><?php echo $user['ERP_USER_EMAIL']; ?></td>
                            <td><?php echo $user['SERVER_ID']; ?></td>
                            <td>
                                <a href="/linkeduser/edit/<?= $user['LINKED_ERP_USER_ID']; ?>"> <i class="fa fa-edit fa-2x" style="color: orange;"></i></a>
                                <a href="/linkeduser/destroy/<?= $user['LINKED_ERP_USER_ID']; ?>"><i class="fa fa-trash fa-2x" style="color: red;"></i></a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <?= $pager->links('linked_erp_user', 'users_pagination') ?>
        </div>
    </main>
</div>

<!-- /content 2 -->
<?= $this->endSection(); ?>