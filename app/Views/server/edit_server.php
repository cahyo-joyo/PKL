<?= $this->extend('template/template'); ?>

<?= $this->section('content'); ?>

<!-- page content -->
<div class="right_col" role="main">

    <h3 class="bold mb-4">Form Ubah Data Server</h3>
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
    <?php
    $date = date("Y-m-d");
    // $timezone = time() + (60 * 60 * 7);
    $time = date("H:i");
    $datetime = $date . "T" . $time
    ?>
    <form method="put" action="/server/update/<?= $server['SERVER_ID']; ?>">
        <?= csrf_field(); ?>
        <div class="mb-4">
            <label for="database" class="col-sm-2 col-form-label">Nama Database</label>
            <div class="col-sm-10">
                <input type="text" name="database" id="database" class="form-control" required="" autocomplete="off" autofocus="" value="<?= (old('database')) ? old('database') : $server['DATABASE_NAME'] ?>" readonly><br>
            </div>
        </div>
        <div class="mb-4">
            <input type="hidden" name="last_update_date" id="last_update_date" class="form-control" value="<?php echo $datetime; ?>">
        </div>
        <div class="mb-4">
            <label for="perusahaan" class="col-sm-2 col-form-label">Nama Perusahaan</label>
            <div class="col-sm-10">
                <input type="text" name="perusahaan" id="perusahaan" class="form-control" autocomplete="off" value="<?= (old('perusahaan')) ? old('perusahaan') : $server['NAMA_PERUSAHAAN'] ?>"><br>
            </div>
        </div>
        <div class="mb-4">
            <label for="alamat" class="col-sm-2 col-form-label">Alamat Perusahaan</label>
            <div class="col-sm-10">
                <input type="text" name="alamat" id="alamat" class="form-control" autocomplete="off" value="<?= (old('alamat')) ? old('alamat') : $server['ALAMAT_PERUSAHAAN'] ?>"><br>
            </div>
        </div>
        <div class="mb-4">
            <label for="jenis" class="col-sm-2 col-form-label">Jenis Usaha</label>
            <div class="col-sm-10">
                <input type="text" name="jenis" id="jenis" class="form-control" autocomplete="off" value="<?= (old('jenis')) ? old('jenis') : $server['JENIS_USAHA'] ?>"><br>
            </div>
        </div>
        <div class="mb-4">
            <!-- <label for="tanggal" class="col-sm-2 col-form-label">Tanggal Aktif</label> -->
            <div>
                <input type="hidden" name="tanggal" id="tanggal" class="form-control" autocomplete="off" required="" value="<?= (old('tanggal')) ? old('tanggal') : $server['ACTIVE_DATE'] ?>"><br>
            </div>
        </div>
        <div class="mb-4">
            <label for="hostname" class="col-sm-2 col-form-label">Hostname</label>
            <div class="col-sm-10">
                <input type="text" name="hostname" id="hostname" class="form-control" autocomplete="off" value="<?= (old('hostname')) ? old('hostname') : $server['HOSTNAME'] ?>"><br>
            </div>
        </div>
        <div class="mb-4">
            <label for="port" class="col-sm-2 col-form-label">Port</label>
            <div class="col-sm-10">
                <input type="number" name="port" id="port" class="form-control" autocomplete="off" required="" value="<?= (old('port')) ? old('port') : $server['PORT'] ?>"><br>
            </div>
        </div>
        <div class="mb-4">
            <label for="max" class="col-sm-2 col-form-label">Max User</label>
            <div class="col-sm-10">
                <input type="number" name="max" id="max" class="form-control" autocomplete="off" required="" value="<?= (old('max')) ? old('max') : $server['MAX_USER'] ?>"><br>
            </div>
        </div>
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