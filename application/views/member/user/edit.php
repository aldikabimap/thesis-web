<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Form Basic</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Library</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form class="form-horizontal" method="post" action="<?= base_url('admin/user/doEdit/').$this->uri->segment(4);?>">
                    <div class="card-body">
                        <div class="clearfix">
                            <?php echo $this->session->flashdata('msgbox') ?>
                        </div>

                        <h4 class="card-title">User Edit</h4>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="name" id="fname" value="<?= $detailData->name?>" placeholder=" Name Here">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lname" class="col-sm-3 text-right control-label col-form-label">Height</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="height" id="lname" value="<?= $detailData->height?>" placeholder="Height Here">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lname" class="col-sm-3 text-right control-label col-form-label">Weight</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="weight" id="lname" value="<?= $detailData->weight?>" placeholder="Weight Here">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email1" class="col-sm-3 text-right control-label col-form-label">Alergies</label>
                            <div class="col-sm-9">
                                <select name="alergies" class="form-control" required="">
                                    <option value="1" <?= ($detailData->alergies=='1'?'selected':'') ?>> Seafood</option>
                                    <option value="2" <?= ($detailData->alergies=='2'?'selected':'') ?>> Egg</option>
                                    <option value="3" <?= ($detailData->alergies=='3'?'selected':'') ?>> Chicken</option>
                                    <option value="4" <?= ($detailData->alergies=='4'?'selected':'') ?>> More</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lname" class="col-sm-3 text-right control-label col-form-label">Username</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="username" id="lname" value="<?= $detailData->username?>" placeholder="Username Here">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lname" class="col-sm-3 text-right control-label col-form-label">Password <span style="color:red;font-weight:bold">*</span> Fill to change</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" name="password" id="lname" placeholder="Password Here">
                            </div>
                        </div>
                    </div>
                    <div class="border-top">
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
            

        </div>
    
    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Right sidebar -->
    <!-- ============================================================== -->
    <!-- .right-sidebar -->
    <!-- ============================================================== -->
    <!-- End Right sidebar -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->