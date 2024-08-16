<?= $this->extend('template/template'); ?>

<?= $this->section('content'); ?>

<div class="right_col" role="main">
    <main role="main" class="container-fluid">

        <h1 style="font-style: bold;">Table User</h1>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <th>LINKED_ERP_USER_ID</th>
                    <th>ERP_USER_ID</th>
                    <th>ERP_USER_EMAIL</th>
                    <th>SERVER_ID</th>
                    <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($linked as $user) {
                    ?>
                        <tr>
                            <td><?php echo $user['LINKED_ERP_USER_ID']; ?></td>
                            <td><?php echo $user['ERP_USER_ID']; ?></td>
                            <td><?php echo $user['ERP_USER_EMAIL']; ?></td>
                            <td><?php echo $user['SERVER_ID']; ?></td>
                            <td>
                                <a href="#<?= $user['ERP_USER_ID']; ?>"> <i class="fa fa-edit fa-2x" style="color: orange;"></i></a>
                                <a href="#<?= $user['ERP_USER_ID']; ?>"><i class="fa fa-trash fa-2x" style="color: red;"></i></a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <!-- pagenation -->
        </div>
    </main>
</div>



<?= $this->endSection(); ?>