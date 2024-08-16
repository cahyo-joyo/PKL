<?= $this->extend('template/template'); ?>

<?= $this->section('content'); ?>

<!-- page content -->
<div class="right_col" role="main">
    <!-- <p>Welcome admin</p> -->

    <h3 class="bold mb-4">Form Tambah Database</h3>
    <?php if (!empty(session()->getFlashdata('error'))) : ?> <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo session()->getFlashdata('error'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <!-- untuk upload file.sql -->
    <style type="text/css">
        .btn {
            margin-left: 225px;
        }

        .btn2 {
            float: right;
        }
    </style>
    <form method="post" action="/server/store_db">
        <?= csrf_field(); ?>
        <div class="mb-4">
            <label class="control-label col-sm-2 col-md-2">Database</label>
            <div class="col-md-10 col-sm-10 ">
                <select name="database" class="form-control">
                    <?php foreach ($server as $servers) { ?>
                        <option><?= $servers['DATABASE_NAME']; ?></option>
                    <?php } ?>


                </select>
            </div>
        </div><br><br><br>
        <div class="btn">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        <div class="btn2">
            <a href="/server" class="btn btn-outline-dark"> Kembali ke halaman sebelumnya</a>
        </div>
    </form>
</div>
<!-- /page content -->

<?= $this->endSection(); ?>