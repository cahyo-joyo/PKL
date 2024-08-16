<?= $this->extend('template/template'); ?>

<?= $this->section('content'); ?>

<!-- page content -->
<div class="right_col" role="main">
    <!-- <p>Welcome admin</p> -->

    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <h3 class="bold mb-4">Form Tambah Data User</h3>
    <?php if (!empty(session()->getFlashdata('error'))) : ?> <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo session()->getFlashdata('error'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <!-- untuk upload file.sql -->
    <style type="text/css">
        .btn {
            margin: 30px 10px 10px 450px;
        }
    </style>
    <form method="store" action="/linkeduser/store">
        <?= csrf_field(); ?>
        <div class="mb-4">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="email" name="email" id="email" class="form-control" autocomplete="off" required="" autofocus="" value="<?= old('email'); ?>"><br>
            </div>
        </div>
        <div class="mb-4">
            <label for="username" class="col-sm-2 col-form-label">Username</label>
            <div class="col-sm-10">
                <input type="text" name="username" id="username" class="form-control" autocomplete="off" required="" value="<?= old('username'); ?>"><br>
            </div>
        </div>
        <div class="mb-4">
            <label for="password" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
                <input type="password" name="password" id="password" class="form-control" autocomplete="off" required="" value="<?= old('password'); ?>"><br>
            </div>
        </div>

        <div class="mb-4">
            <label class="control-label col-sm-2 col-md-2">Database</label>
            <div class="col-md-10 col-sm-10 ">
                <select name="SERVER_ID" id="SERVER_ID" class="form-control">
                    <?php foreach ($servers as $server) { ?>
                        <option <?php if ($server_id == $server['SERVER_ID']) {
                                    echo "selected='selected'";
                                } ?>><?= $server['DATABASE_NAME']; ?></option>
                    <?php } ?>
                </select><br>
            </div>
        </div>

        <div class="mb-4">
            <label class="control-label col-sm-2 col-md-2">Erp Group</label>
            <div class="col-md-10 col-sm-10 ">
                <select name="ERP_GROUP" id="ERP_GROUP" class="form-control">
                    <option value="">pilih</option>
                </select><br>
            </div>
        </div>

        <div class="mb-4">
            <label for="PRIMARY_FLAG" class="col-sm-2 col-form-label" style="margin-top: 15px;">PRIMARY_FLAG</label>
            <div class="col-sm-10"><br>
                <input type="checkbox" name="flag" value="Y" class="flat" style="margin-top: 40px;" />
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<!-- /page content -->

<!-- Load library/plugin jquery nya -->
<script src="<?php echo base_url("js/jquery.min.js"); ?>" type="text/javascript"></script>
<script>
    $(document).ready(function() { // Ketika halaman sudah siap (sudah selesai di load)

        $("#SERVER_ID").change(function() { // Ketika user mengganti atau memilih data provinsi
            $("#ERP_GROUP").hide(); // Sembunyikan dulu combobox kota nya

            $.ajax({
                type: "POST", // Method pengiriman data bisa dengan GET atau POST
                url: "<?php echo base_url('linkeduser/get_erp_group'); ?>", // Isi dengan url/path file php yang dituju
                data: {
                    id_server: $("#SERVER_ID").val()
                }, // data yang akan dikirim ke file yang dituju
                dataType: "json",
                beforeSend: function(e) {
                    if (e && e.overrideMimeType) {
                        e.overrideMimeType("application/json;charset=UTF-8");
                    }
                },
                success: function(response) { // Ketika proses pengiriman berhasil

                    // set isi dari combobox kota
                    // lalu munculkan kembali combobox kotanya
                    $("#ERP_GROUP").html(response.group_name).show();
                },
                error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
                }
            });
        });
    });
</script>


<?= $this->endSection(); ?>