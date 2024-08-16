<?= $this->extend('template/template'); ?>

<?= $this->section('content'); ?>

<div class="right_col" role="main">
    <main role="main" class="container_fluid"></main>
    <h1 style="text-align: center;"> FORM TAMBAH DATA ALAMAT </h1>
    <form method="post" action="/persiapan/storealamat">
        <?= csrf_field(); ?>
        <div class="mb-4">
            <label for="database" class="col-sm-2 col-form-label">Code</label>
            <div class="col-sm-10">
                <input type="text" name="code" id="code" class="form-control" autocomplete="off" required="" autofocus=""><br>
            </div>
        </div>
        <div class="mb-4">
            <label for="perusahaan" class="col-sm-2 col-form-label">Alamat</label>
            <div class="col-sm-10">
                <input type="text" name="alamat" id="alamat" class="form-control" autocomplete="off" required=""><br>
            </div>
        </div>
        <div class="mb-4">
            <label for="alamat" class="col-sm-2 col-form-label">Kota</label>
            <div class="col-sm-10">
                <input type="text" name="kota" id="kota" class="form-control" autocomplete="off" required=""><br>
            </div>
        </div>
        <div class="mb-4">
            <label for="jenis" class="col-sm-2 col-form-label">Provinsi</label>
            <div class="col-sm-10">
                <input type="text" name="provinsi" id="provinsi" class="form-control" autocomplete="off" required=""><br>
            </div>
        </div>
        <div class="mb-4">
            <label for="tanggal" class="col-sm-2 col-form-label">Negara</label>
            <div class="col-sm-10">
                <input type="text" name="provinsi" id="provinsi" class="form-control" autocomplete="off" required=""><br>
            </div>
        </div>
        <div class="mb-4">
            <label for="hostname" class="col-sm-2 col-form-label">Phone</label>
            <div class="col-sm-10">
                <input type="number" name="phone" id="phone" class="form-control" autocomplete="off" required=""><br>
            </div>
        </div>
        <div class="mb-4">
            <label for="port" class="col-sm-2 col-form-label">Fax</label>
            <div class="col-sm-10">
                <input type="number" name="fax" id="fax" class="form-control" autocomplete="off" required=""><br>
            </div>
        </div>
        <div class="btn">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>


</div>

<?= $this->endSection(); ?>