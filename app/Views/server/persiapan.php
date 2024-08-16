<?= $this->extend('template/template'); ?>

<?= $this->section('content'); ?>


<div class="right_col" role="main">
    <?php //dd($server['SERVER_ID']); 
    ?>
    <main role="main" class="container-fluid">
        <?php
        $date = date("Y-m-d");
        // $timezone = time() + (60 * 60 * 7);
        $time = date("H:i");
        $datetime = $date . "T" . $time
        ?>
        <?php if (!empty(session()->getFlashdata('error'))) : ?> <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo session()->getFlashdata('error'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <form id="form_head" method="store" action="/persiapan/store">

            <div class="row mt">
                <div class="col-lg-12 col-md-12 col-sm-12  nopadding-sm">
                    <div class="showback">
                        <h3><i class="fa fa-cogs"></i> Persiapan Singkat</h3>
                        <div class="row drop-after">
                            <div class="col-lg-12 col-md-12 col-sm-12  nopadding-sm">
                                <h5>Seluruh informasi yang berhubungan dengan perusahaan untuk keperluan laporan</h5>
                            </div>
                            <br><br><br>
                            <div class="col-lg-12 col-md-12 col-sm-12  nopadding-sm">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>Save</button>
                            </div>
                        </div>
                    </div><!-- /showback -->
                </div>
            </div><br><br>

            <div class="row ">

                <div class="col-lg-12 col-md-12 col-sm-12  nopadding-sm">
                    <div class="showback">
                        <div class="form-horizontal " method="post">
                            <div class="">


                                <div class="form-body">


                                    <div class="">
                                        <section>
                                            <div class="wizard">
                                                <div class="wizard-inner">
                                                    <div class="connecting-line"></div>
                                                    <ul class="nav nav-tabs" role="tablist">

                                                        <li role="presentation" class="active">
                                                            <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1">
                                                                <span class="round-tab">
                                                                    <i class="glyphicon glyphicon-folder-open"></i>
                                                                </span>
                                                            </a>
                                                        </li>

                                                        <li role="presentation" class="disabled">
                                                            <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">
                                                                <span class="round-tab">
                                                                    <i class="glyphicon glyphicon-pencil"></i>
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li role="presentation" class="disabled">
                                                            <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
                                                                <span class="round-tab">
                                                                    <i class="glyphicon glyphicon-ok"></i>
                                                                </span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-content">
                                                    <!-- TAB 1 TAB 1 TAB 1 TAB 1 TAB 1 TAB 1 TAB 1 TAB 1 TAB 1 -->
                                                    <div class="tab-pane active" role="tabpanel" id="step1">
                                                        <h3>Tanggal mulai jalan program</h3>
                                                        <p>Untuk menentukan periode awal akuntansi, setelah tekan OK, tanggal TIDAK DAPAT diubah lagi</p>
                                                        <div class="mb-4">
                                                            <input type="datetime-local" name="start_date" id="start_date" value="<?php echo $datetime; ?>" class="form-control" autocomplete="off" required="">
                                                        </div>

                                                        <ul class="list-inline pull-right"><br>
                                                            <li><button type="button" class="btn btn-primary next-step">Next</button></li>
                                                        </ul>
                                                    </div>
                                                    <!-- TAB 1 TAB 1 TAB 1 TAB 1 TAB 1 TAB 1 TAB 1 TAB 1 TAB 1 -->


                                                    <div class="tab-pane" role="tabpanel" id="step2">
                                                        <h3>Informasi perusahaan</h3>


                                                        <div class="form-group">
                                                            <div class="col-sm-7">
                                                                <input type="hidden" id="server_id" name="server_id" class="form-control" placeholder="" value="<?= $server['SERVER_ID']; ?>">
                                                                <span class="help-block"></span>
                                                            </div><br>
                                                        </div><br>


                                                        <div class="form-group">
                                                            <label class="col-sm-3 col-sm-3 control-label">NAMA PERUSAHAAN</label>
                                                            <div class="col-sm-7">
                                                                <input type="text" id="name" name="name" class="form-control" placeholder="" required="" value="<?php if (!empty($head->NAME)) {
                                                                                                                                                                    echo $head->NAME;
                                                                                                                                                                } ?>">
                                                                <span class="help-block"></span>
                                                            </div><br>
                                                        </div><br>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 col-sm-3 control-label">EMAIL</label>
                                                            <div class="col-sm-7">
                                                                <input type="email" id="email" name="email" class="form-control" placeholder="" required="" value="<?php if (!empty($head->EMAIL)) {
                                                                                                                                                                        echo $head->EMAIL;
                                                                                                                                                                    } ?>">
                                                                <span class="help-block"></span>
                                                            </div><br>
                                                        </div><br>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 col-sm-3 control-label">LOGO FILENAME</label>
                                                            <div class="col-sm-7">
                                                                <input type="text" id="logo" name="logo" class="form-control" placeholder="" value="<?php if (!empty($head->LOGO_FILENAME)) {
                                                                                                                                                        echo $head->LOGO_FILENAME;
                                                                                                                                                    } ?>">
                                                            </div><br>
                                                        </div><br>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 col-sm-3 control-label">ALAMAT</label>
                                                            <div class="col-sm-7">
                                                                <select name="address_code" class="form-control">
                                                                    <?php foreach ($address as $alamat) { ?>
                                                                        <option><?= $alamat['ADDRESS_CODE']; ?></option>
                                                                </select>
                                                            </div><br>
                                                            <div class="col-sm-1">
                                                                <a class="btn btn-sm btn-primary" target='_blank' href="/persiapan/"><i class="glyphicon glyphicon-plus"></i></a>
                                                            </div>
                                                        </div><br>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 col-sm-3 control-label"></label>
                                                            <div class="col-sm-7">
                                                                <input type="tetx" id="address1" name="address1" class="form-control" placeholder="" value="<?= $alamat['ADDRESS1']; ?>">
                                                            </div><br><br><br>
                                                        </div>
                                                    <?php } ?>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 col-sm-3 control-label">NPWP</label>
                                                        <div class="col-sm-7">
                                                            <input type="number" id="npwp" name="npwp" class="form-control" placeholder="">
                                                        </div><br><br>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 col-sm-3 control-label">NO SERI FAKTUR PAJAK</label>
                                                        <div class="col-sm-7">
                                                            <input type="number" id="no_pajak" name="no_pajak" class="form-control" placeholder="">
                                                        </div><br><br>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 col-sm-3 control-label">NO PENGUKUHAN PKP</label>
                                                        <div class="col-sm-7">
                                                            <input type="number" id="no_pkp" name="no_pkp" class="form-control" placeholder="">
                                                        </div><br><br>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 col-sm-3 control-label">TGL PENGUKUHAN PKP</label>
                                                        <div class="col-sm-7">
                                                            <input type="datetime-local" id="date_pkp" value="<?php echo $datetime; ?>" class="form-control" autocomplete="off" required="" placeholder="">
                                                        </div><br>
                                                    </div><br>

                                                    <ul class="list-inline pull-right">
                                                        <li class="d-inline"><button type="button" class="btn btn-outline-secondary prev-step">Previous</button></li>
                                                        <li class="d-inline"><button type="button" class="btn btn-primary next-step">Next</button></li>
                                                    </ul>
                                                    </div>
                                                    <div class="tab-pane" role="tabpanel" id="complete">
                                                        <h3>Complete</h3>
                                                        <p>You have successfully completed all steps.
                                                            <br>Bisa melakukan transaksi apapun.
                                                            <br>dan untuk customer diharapkan mengisi
                                                            <br>1. Item : Sebagai master barang atau jasa yang digunakan dalam usaha.
                                                            DAftar barang dapat di import dari microsoft excel, sehingga jika pindah dari program lama bisa lebih cepat.
                                                            <br>2. Customer : Menu ini berisikan list dari nama dan data lengkap customer.
                                                            <br>3. Supplier : Berisikan tentang nama dan data lengkap supplier.
                                                        </p></br></br></br></br></br>
                                                        <ul class="list-inline pull-right">
                                                            <li><button type="button" class="btn btn-outline-secondary prev-step">Previous</button></li>
                                                        </ul>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>

                                            </div>
                                        </section>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- /showback -->

            <div class="">

            </div>
        </form>
</div>
<div>
</div>

<?= $this->endSection(); ?>