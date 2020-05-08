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
                <form class="form-horizontal" method="post" action="<?= base_url('admin/result/doEdit/').$this->uri->segment(4);?>">
                    <div class="card-body">
                        <div class="clearfix">
                            <?php echo $this->session->flashdata('msgbox') ?>
                        </div>

                        <h4 class="card-title">Result Edit</h4>

                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Min Height (CM)</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="min_height" value="<?= $detailData->min_height?>" id="fname" placeholder="Enter Hight Min ">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Max Height (CM)</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="max_height" value="<?= $detailData->max_height?>" id="fname" placeholder="Enter Height Max">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Min Weight (KG)</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="min_weight" value="<?= $detailData->min_weight?>" id="fname" placeholder="Enter Weight Min">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Max Weight (KG)</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="max_weight" value="<?= $detailData->max_weight?>" id="fname" placeholder="Enter Weight Max">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Alergies </label>
                            <div class="col-sm-9">
                                <input type="radio" name="alergies" value="1" <?php if ($detailData->alergies == 1){echo "checked";}?>> Seafood &nbsp;&nbsp;&nbsp;
                                <input type="radio" name="alergies" value="2" <?php if ($detailData->alergies == 2){echo "checked";}?>> Egg <br>
                                <input type="radio" name="alergies" value="3" <?php if ($detailData->alergies == 3){echo "checked";}?>> Chicken &nbsp;&nbsp;&nbsp;
                                <input type="radio" name="alergies" value="4" <?php if ($detailData->alergies == 4){echo "checked";}?>> More
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Lose Goals </label>
                            <div class="col-sm-9">
                                <input type="radio" name="goals" value="1" <?php if ($detailData->goals == 1){echo "checked";}?>> Lose 1 Kg / Month
                                <input type="radio" name="goals" value="3" <?php if ($detailData->goals == 3){echo "checked";}?>> Lose 3 Kg / Month
                                <input type="radio" name="goals" value="5" <?php if ($detailData->goals == 5){echo "checked";}?>> Lose 5 Kg / Month
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Description </label>
                            <div class="col-sm-9">
                                <textarea class="ckeditor"name="description" id="ckedtor"> <?= $detailData->description?></textarea>
                            </div>
                        </div>
                        <hr>
                        <h3>Plan Diet <a style="margin-left: 10px;color: white;" class="btn btn-success addPlan">Add</a></h3>
                        <div class="boxPlan">
                            <?php foreach ($plan as $key => $value) { ?>
                                <div class="form-group row paketPlan">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Plan</label>
                                    <div class="col-sm-8">
                                        <input type="hidden" name="planId[]" value="<?= $value->plan_id ?>">
                                        <input type="text" class="form-control" name="planEdit[]" value="<?= $value->plan_name ?>" id="fname" placeholder="Enter Plan">
                                    </div>
                                    <div class="col-sm-1">
                                        <a class="btn btn-danger removePlan" data-id="<?= $value->plan_id ?>" style="color: white;">Remove</a>
                                    </div>
                                </div>
                            <?php } ?>
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
<script type="text/javascript">
    $('.addPlan').click(function(argument) {
        $('.boxPlan').append('<div class="form-group row paketPlan">'+
                                '<label for="fname" class="col-sm-3 text-right control-label col-form-label">Plan</label>'+
                                '<div class="col-sm-8">'+
                                    '<input type="text" class="form-control" name="plan[]" value="" id="fname" placeholder="Enter Plan">'+
                                '</div>'+
                                '<div class="col-sm-1">'+
                                    '<a class="btn btn-danger removePlan" style="color: white;">Remove</a>'+
                                '</div>'+
                            '</div>')
    });
    $('.boxPlan').on('click','.removePlan',function(argument) {
        var indexNya = $('.removePlan').index($(this));
        var dataId = $($('.removePlan')[indexNya]).data('id');
        console.log(dataId);
        if (dataId == undefined) {
            $('.paketPlan')[indexNya].remove();
        }else{
            $.ajax({
                type:'post',
                url: "<?= base_url('admin/result/removePlan/') ?>"+dataId, 
                success: function(result){
                    $('.paketPlan')[indexNya].remove();
                }
            });
        }
        console.log(dataId);
    });
</script>