<?= $this->extend('template/template'); ?>

<?= $this->section('content'); ?>

<!-- page content -->
<style type="text/css">
    thead,
    td.center {
        text-align: center;
    }
</style>
<div class="right_col" role="main">
    <main role="main" class="container-fluid">

        <!-- FLASHDATA -->
        <?php if (session()->get('message')) : ?>
            <div class="alert alert-success alert-dismissble fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                Data berhasil dihapus <strong <?= session()->getFlashData('message'); ?>></strong>
            </div>
        <?php endif ?>
        <?php if (session()->get('pesan')) : ?>
            <div class="alert alert-success alert-dismissble fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                Data berhasil ditambah <strong <?= session()->getFlashData('pesan'); ?>></strong>
            </div>
        <?php endif ?>
        <?php if (session()->get('msg')) : ?>
            <div class="alert alert-success alert-dismissble fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                Data berhasil diubah <strong <?= session()->getFlashData('msg'); ?>></strong>
            </div>
        <?php endif ?>
        <!-- FLASHDATA -->


        <h1 style="font-size: 23px;">Hasil Pencarian Data Server</h1><br>
        <!-- SEARCH -->
        <form action="/server/hasil_pencarian" method="GET">
            <div class="page-title">
                <div class="title_right" style="float: right;">
                    <div class="col-md-15 col-sm-15  form-group row pull-right top_search">
                        <div class="input-group" style="float: right;">
                            <input type="text" name="cari" class="form-control" placeholder="Search for..." autocomplete="off">
                            <span class="input-group-btn">
                                <button class="btn btn-secondary" type="submit" value="cari">Go!</button>
                            </span>
                        </div>
                    </div>
                </div>
                <a href="/server/create" class="btn btn-primary">Tambah Data + Database</a>
                <a href="/server/create_nodb" class="btn btn-primary">Tambah Data No Database</a>
                <a href="/server/create_db" class="btn btn-primary">Tambah Database</a>
            </div>
        </form><br>
        <!-- SEARCH -->

        <hr style="margin-top: -10px;">
        <div class="table-responsive">
            <table class="table table-bordered" width="600px">
                <thead>
                    <!-- <tt> -->
                    <tr>
                        <th width="100px">Nama Database</th>
                        <th width="100px">Nama Perusahaan</th>
                        <th width="50px">Alamat Perusahaan</th>
                        <th width="50px">Jenis Usaha</th>
                        <th width="50px">Tanggal Aktif</th>
                        <th width="50px">Hostname</th>
                        <th width="25px">Port</th>
                        <th width="25px">Max User</th>
                        <th width="150px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($server as $s) {
                        // var_dump($user);
                    ?>
                        <tr>
                            <td><?php echo $s['DATABASE_NAME']; ?></td>
                            <td><?php echo $s['NAMA_PERUSAHAAN']; ?></td>
                            <td><?php echo $s['ALAMAT_PERUSAHAAN']; ?></td>
                            <td><?php echo $s['JENIS_USAHA']; ?></td>
                            <td><?php echo $s['ACTIVE_DATE']; ?></td>
                            <td><?php echo $s['HOSTNAME']; ?></td>
                            <td class="center"><?php echo $s['PORT']; ?></td>
                            <td class="center"><?php echo $s['MAX_USER']; ?></td>
                            <td>
                                <center><a href="/server/edit/<?= $s['SERVER_ID']; ?>"><i class="fa fa-edit fa-2x" style="color: orange;"></i></a>
                                    <a href="/server/destroy/<?= $s['SERVER_ID']; ?>" onclick="return confirm('Apakah Anda yakin?');"><i class="fa fa-trash fa-2x" style="color: red;"></i></a>
                                    <a href="/server/persiapan/<?= $s['SERVER_ID']; ?>"><i class="fa fa-cogs fa-2x" style="color: brown;"></i></a>
                                </center>
                                <center><a href="/showserver/<?= $s['SERVER_ID']; ?>"><i class="fa fa-users fa-2x" style="color:blue;"></i></a>
                                    <a href="/server/session/<?= $s['SERVER_ID']; ?>"><i class="fa fa-history fa-2x" style="color: green;"></i></a>
                                </center>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <?= $pager->links('server', 'server_pagination') ?>
        </div>
    </main>
</div>


<?= $this->endSection(); ?>