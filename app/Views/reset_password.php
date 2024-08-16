<?= $this->extend('template/template'); ?>

<?= $this->section('content'); ?>


<div class="right_col" role="main">

    <main role="main" class="container-fluid">

        <div class="col-14">
            <h1>Reset Password</h1>
            <?php if (!empty(session()->getFlashdata('error'))) : ?> <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php echo session()->getFlashdata('error'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
            <form method="post" action="/users/update/<?= $user_id; ?>">

                <div class="mb-3">
                    <input type="hidden" name="user_id" class="form-control" id="InputForName" autocomplete="off" autofocus="" value="<?= $user_id; ?>">
                </div>
                <div class="mb-3">
                    <label for="InputForName" class="form-label">Name</label>
                    <input type="text" name="user_name" class="form-control" id="InputForName" autocomplete="off" autofocus="" value="<?= $user_name; ?>">
                </div>
                <div class="mb-3">
                    <label for="InputForEmail" class="form-label">Email address</label>
                    <input type="email" name="user_email" class="form-control" id="InputForEmail" autocomplete="off" value="<?= $user_email; ?>">
                </div>
                <div class="mb-3">
                    <label for="InputForPassword" class="form-label">Password</label>
                    <input type="password" name="user_password" class="form-control" id="InputForPassword" autocomplete="off">
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </main>
</div>

<?= $this->endSection(); ?>