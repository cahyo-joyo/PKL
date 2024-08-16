<?= $this->extend('template/template'); ?>

<?= $this->section('content'); ?>

<!-- page content -->
<div class="right_col" role="main">
    <main role="main" class="container-fluid"></main>

    <h3 class="bold mb-3">Form Ubah Data User</h3>
    <?php if (!empty(session()->getFlashdata('error'))) : ?> <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo session()->getFlashdata('error'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>
    <form method="post" action="/linkeduser/update/<?= $LINKED_ERP_USER_ID; ?>">
        <?= csrf_field(); ?>
        <div class="mb-3">
            <input type="hidden" name="linked_erp_user_id" id="linked_erp_user_id" class="form-control" value="<?= $LINKED_ERP_USER_ID; ?>">
        </div>
        <div LINKED="mb-3">
            <input type="hidden" name="server_id" id="server_id" class="form-control=" value="<?= $SERVER_ID; ?>">
        </div>
        <div class="mb-3">
            <input type="hidden" name="erp_user_id" id="erp_user_id" class="form-control" value="<?= $ERP_USER_ID; ?>">
            <input type="hidden" name="redirect_server" value="<?= $redirect_server; ?>">
        </div>
        <label for="email" class="col-sm-2 col-form-label">Email</label>
        <div class="mb-3">
            <input type="email" name="email" id="email" class="form-control" placeholder="Email" required="" autocomplete="off" autofocus="" value="<?= (old('email')) ? old('old_email') : $ERP_USER_EMAIL ?>">
            <input type="hidden" name="old_email" value="<?= $ERP_USER_EMAIL ?>">
        </div>
        <label for="username" class="col-sm-2 col-form-label">Username</label>
        <div class="mb-3">
            <input type="text" name="username" id="username" class="form-control" placeholder="Username" autocomplete="off" required="" value="<?= (old('username')) ? old('old_username') : $ERP_USER_NAME ?>">
            <input type="hidden" name="old_username" value="<?= $ERP_USER_NAME ?>">
        </div>
        <label for="password" class="col-sm-2 col-form-label">Password</label>
        <div class="mb-3">
            <input type="password" name="password" id="password" class="form-control" placeholder="Password" autocomplete="off">
        </div>
        <label class="col-sm-2 col-form-label">Erp Group</label>
        <div class="mb-3">
            <select name="group" id="group" class="form-control">
                <?php foreach ($erp_group as $groups) { ?>
                    <option <?php if ($ERP_GROUP == $groups['ERP_GROUP_ID']) {
                                echo "selected='selected'";
                            } ?>><?= $groups['ERP_GROUP_NAME']; ?></option>
                <?php } ?>
            </select><br>
        </div>
        <div class="mb-4">
            <label for="PRIMARY_FLAG" class="col-sm-2 col-form-label" style="margin-top: 15px;">PRIMARY_FLAG</label>
            <div class="col-sm-10"><br>
                <input type="checkbox" name="flag" value="Y" class="flat" style="margin-top: 40px;" <?= $CHEKED; ?> />
            </div>
        </div><br><br><br><br><br>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<!-- /page content -->

<?= $this->endSection(); ?>