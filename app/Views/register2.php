<?= $this->extend('template/template'); ?>

<?= $this->section('content'); ?>

<div class="right_col" role="main">

    <main role="main" class="container-fluid">
        <div class="col-14">
            <h1>Sign Up</h1>
            <?php if (!empty(session()->getFlashdata('error'))) : ?> <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php echo session()->getFlashdata('error'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
            <form action="/users/store2" method="save">
                <div class="mb-3">
                    <label for="InputForName" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" id="InputForName" value="<?= set_value('name') ?>" autocomplete="off" autofocus="" value="<?= old('name'); ?>">
                </div>
                <div class="mb-3">
                    <label for="InputForEmail" class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control" id="InputForEmail" value="<?= set_value('email') ?>" autocomplete="off" value="<?= old('email'); ?>">
                </div>
                <div class="mb-3">
                    <label for="InputForPassword" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="InputForPassword" autocomplete="off" value="<?= old('password'); ?>">
                </div>
                <div class="mb-3">
                    <label for="InputForConfPassword" class="form-label">Confirm Password</label>
                    <input type="password" name="confpassword" class="form-control" id="InputForConfPassword" autocomplete="off" value="<?= old('confpassword'); ?>">
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
            </form>
        </div>
    </main>
</div>

<?= $this->endSection(); ?>