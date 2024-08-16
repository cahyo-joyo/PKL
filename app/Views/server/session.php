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
        <h1 style="font-size: 23px;">Data Session</h1>
        <!-- FLASH DATA -->
        <?php if (session()->get('message')) : ?>
            <div class="alert alert-success alert-dismissble fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                Data berhasil dihapus <strong <?= session()->getFlashData('message'); ?>></strong>
            </div>
        <?php endif ?>
        <!-- FLASH DATA -->

        <hr>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <!-- <tt> -->
                    <tr>
                        <th>ERP User ID</th>
                        <th>ERP User Email</th>
                        <th>IP Address</th>
                        <th>Created Date</th>
                        <th>Last Update Date</th>
                        <th>Note</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($session as $s) {
                        // var_dump($user);
                    ?>
                        <tr>
                            <td><?php echo $s['ERP_USER_ID']; ?></td>
                            <td><?php echo $s['ERP_USER_EMAIL']; ?></td>
                            <td><?php echo $s['IP_ADDRESS']; ?></td>
                            <td><?php echo $s['CREATED_DATE']; ?></td>
                            <td><?php echo $s['LAST_UPDATE_DATE']; ?></td>
                            <td><?php echo $s['NOTE']; ?></td>
                            <td><a href="/server/destroy_session/<?= $s['SESSION_ID']; ?>" onclick="return confirm('Apakah Anda yakin?');"><i class="fa fa-trash fa-2x" style="color: red;"></i></a></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
</div>


<?= $this->endSection(); ?>