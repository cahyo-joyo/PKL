<?= $this->extend('template/template'); ?>
<?= $this->section('content'); ?>

<!-- page content -->
<div class="right_col" role="main">

    <h3 class="bold">Import Database</h3><br>
    <?php if (session()->getFlashdata('pesan')) :  ?>
        <div class="alert alert-info" role="alert">
            <?= session()->getFlashdata('pesan'); ?>
        </div>
    <?php endif; ?>
    <!-- untuk upload file.sql -->
    <form action="/dbimport/coba" method="post" enctype="multipart/form-data">

        <div class="input-group mb-3">
            <div class="mb-3">
                <label for="upload" class="form-label">Masukkan File Database</label>
                <input class="input-group-text" type="file" name="upload">
            </div>
        </div>
        <button type=" submit" class="btn btn-primary" name="kirim">Import</button>
    </form>
</div>

<!-- /page content -->
<?= $this->endSection(); ?>