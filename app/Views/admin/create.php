<?= $this->extend('template/template'); ?>

<?= $this->section('content'); ?>

<!-- page content -->
<div class="right_col" role="main">
    <!-- <p>Welcome admin</p> -->

    <h3 class="bold mb-3"><?= $title; ?></h3>

    <!-- untuk upload file.sql -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="mb-3">
            <input type="text" name="username" id="InputForUsername" class="form-control" placeholder="Username" aria-label="Username" required="" autofocus="">
        </div>
        <div class="mb-3">
            <input type="email" name="email" id="InputForEmail" class="form-control" placeholder="Email" aria-describedby="emailHelp" required="">
        </div>
        <div class="mb-3">
            <input type="password" name="password" id="InputForPassword" class="form-control" placeholder="Password" required="">
        </div>
        <div class="mb-3">
            <input type="password" name="confpassword" id="InputForConfPassword" class="form-control" placeholder="Konfirmasi Password" required="">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<!-- /page content -->

<?= $this->endSection(); ?>