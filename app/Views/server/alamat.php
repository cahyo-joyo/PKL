<?= $this->extend('template/template'); ?>

<?= $this->section('content'); ?>

<div class="right_col" role="main">
    <main role="main" class="container-fluid">
        <form method="post" action="/server/store">
            <?= csrf_field(); ?>
            <div class="row mt">
                <div class="col-lg-12 col-md-12 col-sm-12  nopadding-sm">
                    <div class="showback">
                        <h3 class="head-drop-after"><i class="fa fa-map-marker"></i> Alamat</h3>
                        <p>Digunakan untuk mencatat alamat perusahaan pusat beserta cabang</p>
                        <a href="/persiapan/createalamat" class="btn btn-success">Tambah Data</a>
                        <div class="row drop-after">
                            <div class="col-lg-12 col-md-12 col-sm-12  nopadding-sm">
                                <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>KODE</th>
                                            <th>ALAMAT</th>
                                            <th>TELP</th>
                                            <th>FAX</th>
                                            <th>BISA KIRIM</th>
                                            <th>AKTIF</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($dataalamat as $alamat) { ?>
                                            <tr>
                                                <td><?php echo $alamat['ADDRESS_CODE']; ?></td>
                                                <td><?php echo $alamat['ADDRESS1']; ?></td>
                                                <td><?php echo $alamat['PHONE']; ?></td>
                                                <td><?php echo $alamat['FAX']; ?></td>
                                                <td><?php echo $alamat['SHIP_FLAG']; ?></td>
                                                <td><?php echo $alamat['ACTIVE_FLAG']; ?></td>
                                                <td>
                                                    <center><a href="#"><i class="fa fa-edit fa-2x" style="color: orange;"></i></a></center>
                                                    <center><a href="#" onclick="return confirm('Apakah Anda yakin?');"><i class="fa fa-trash fa-2x" style="color: red;"></i></a></center>
                                                    <!-- <center><a href="#"><i class="fa fa-cogs fa-2x" style="color: brown;"></i></a></center> -->
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <!--/col-lg-6 -->
                        </div><!-- row drop-after -->
                    </div><!-- /showback -->
                </div>
                <!--/col-lg-12 -->
            </div><!-- row mt-->
        </form>
</div>
<?= $this->endSection(); ?>