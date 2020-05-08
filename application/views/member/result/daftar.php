<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Tables</h4>
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
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="clearfix">
                        <?php echo $this->session->flashdata('msgbox') ?>
                    </div>
                    <div class="table-responsive">
                        <div>
                            <a href="<?php echo base_url('admin/result/add/') ?>"><button class="btn btn-primary btn-sm btnEmptySaldo"   style="margin-left:2px"><span>Add Data</span></button></a>
                        </div>
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Min Height</th>
                                    <th>Max Height</th>
                                    <th>Min Weight</th>
                                    <th>Max Weight</th>
                                    <th>Alergies</th>
                                    <th>Lose Goals</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $no = 0;
                                foreach ($listData as $value){
                                    if ($value->alergies == 1){
                                        $alergies = "Seafood";
                                    } elseif ($value->alergies == 2){
                                        $alergies = "Egg";
                                    } elseif ($value->alergies == 3){
                                        $alergies = "Chicken";
                                    } elseif ($value->alergies == 4){
                                        $alergies = "More";
                                    }

                                    if ($value->goals == 1){
                                        $goals = "Lose 1 Kg / Mont";
                                    } else if ($value->goals == 2){
                                        $goals = "Lose 2 Kg / Mont";
                                    } else if ($value->goals == 3){
                                        $goals = "Lose 3 Kg / Mont";
                                    } 
                                $no++
                                ?>
                                <tr>
                                    <td><?= $no?></td>
                                    <td><?= $value->min_height?> Cm</td>
                                    <td><?= $value->max_height?> Cm</td>
                                    <td><?= $value->min_weight?> Kg</td>
                                    <td><?= $value->max_weight?> Kg</td>
                                    <td><?= $alergies?></td>
                                    <td><?= $goals?></td>
                                    <td><?= $value->description?></td>
                                    <td>
                                        <a href="<?php echo base_url('admin/result/edit/'.$value->result_id) ?>"><button class="btn btn-primary btn-sm btnEmptySaldo"   style="margin-left:2px"><i class="fa fa-edit" style="font-size: 14px;"></i>&nbsp;&nbsp;<span>View/Edit</span></button></a>
                                        <a href="<?php echo base_url('admin/result/doDelete/'.$value->result_id) ?>"><button class="btn btn-danger btn-sm"   style="margin-left:2px" onclick="return confirm('Anda yakin ingin menghapus data ini ? ')"><i class="fa fa-trash" style="font-size: 14px;"></i>&nbsp;&nbsp;<span>Delete</span></button></a>
                                    </td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
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