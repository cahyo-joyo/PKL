<?= $this->extend('template/template'); ?>

<?= $this->section('content'); ?>

<!-- page content -->
<div class="right_col" role="main">

    <main role="main" class="container-fluid">

        <h1 style="font-size: 23px;">Data Admin</h1><br>
        <?php if (session()->get('message')) : ?>
            <div class="alert alert-success alert-dismissble fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                Data berhasil dihapus <strong <?= session()->getFlashData('message'); ?>></strong>
            </div>
        <?php endif ?>
        <a href="/users/store_admin" class="btn btn-primary">Tambah Data</a>
        <hr>
        <table class="table table-bordered">
            <!-- <tt> -->
            <th>User_id</th>
            <th>User_Name</th>
            <th>User_Email</th>
            <th>Aksi</th>
            </tr>

            <?php
            foreach ($dataadmin as $d) {
                // var_dump($user);
            ?>
                <tr>
                    <td><?php echo $d['user_id'] ?></td>
                    <td><?php echo $d['user_name']; ?></td>
                    <td><?php echo $d['user_email']; ?></td>

                    <td>
                        <a href="/users/edit/<?= $d['user_id']; ?>"><i class="fa fa-unlock fa-2x" style="color: orange;"></i></a>
                        <a href="/users/destroy/<?= $d['user_id']; ?>" onclick="return confirm('Apakah Anda yakin?');"><i class="fa fa-trash fa-2x" style="color: red;"></i></a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
    </main>
</div>

<!-- /content 2 -->
<?= $this->endSection(); ?>