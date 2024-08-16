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

        <h1>Data Linked User</h1><br>
        <?php if (session()->get('alert')) : ?>
            <div class="alert alert-danger alert-dismissble fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                Data berhasil dihapus <strong <?= session()->getFlashData('alert'); ?>></strong>
            </div>
        <?php endif ?>
        <?php if (session()->get('pesan')) : ?>
            <div class="alert alert-success alert-dismissble fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                Data berhasil diubah <strong <?= session()->getFlashData('pesan'); ?>></strong>
            </div>
        <?php endif ?>

        <a href="/linkeduser/create/<?= $server_id; ?>" class="btn btn-primary">Tambah Data</a>

        <hr>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <th>Linked_Erp_User_Id</th>
                    <th>Erp_User_Id</th>
                    <th>Erp_user_Email</th>
                    <th>Primary_Flag</th>
                    <th>Server_Id</th>
                    <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($erpuser as $user) {
                        // d($user);
                    ?>
                        <tr>
                            <td><?php echo $user['LINKED_ERP_USER_ID']; ?></td>
                            <td><?php echo $user['ERP_USER_ID'] ?></td>
                            <td><?php echo $user['ERP_USER_EMAIL']; ?></td>
                            <td><?php echo $user['PRIMARY_FLAG']; ?></td>
                            <td><?php echo $user['SERVER_ID']; ?></td>
                            <td>

                                <a href="/linkeduser/edit_noemail/<?= $user['SERVER_ID'] . '/' . $user['ERP_USER_ID']; ?>"> <i class="fa fa-edit fa-2x" style="color: orange;"></i></a>
                                <a href="/linkeduser/destroy_noemail/<?= $user['SERVER_ID'] . '/' . $user['ERP_USER_ID']; ?>" onclick="return confirm('Apakah Anda yakin?');"><i class="fa fa-trash fa-2x" style="color: red;"></i></a>
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