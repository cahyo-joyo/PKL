<?= $this->extend('template/template2'); ?>

<?= $this->section('content'); ?>

<div class="right_col" role="main">

    <main role="main" class="container-fluid">
        <div class="col-14">
            <h1>Sign Up</h1>
            <?php if (isset($validation)) : ?>
                <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
            <?php endif; ?>
            <form action="/users/store" method="save">
                <div class="mb-3">
                    <label for="InputForName" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" id="InputForName" autocomplete="off" autofocus="" value="<?= old('name'); ?>">
                </div>
                <div class="mb-3">
                    <label for="InputForEmail" class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control" id="InputForEmail" autocomplete="off" value="<?= old('email'); ?>">
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