<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs" id="breadcrumbs">
            <script type="text/javascript">
                try {
                    ace.settings.check('breadcrumbs', 'fixed')
                } catch (e) {
                }
            </script>
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="<?php echo base_url('admin/dashboard'); ?>">Beranda</a>
                </li>
                <li>
                    <a href="<?php echo base_url('admin/barang') ?>">Laporan</a>
                </li>
                <li class="active">Data Transaksi</li>
            </ul>
        </div>
        <div class="page-content">
            <div class="page-header">
                <h1>
                    Form Data Transaksi
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                    </small>
                </h1>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url().'admin/laporan/laporan_transaksi_pdf'?>" role="form"> 
                       <?php 
                       $dataOld = $this->session->flashdata('oldPost'); 
                       echo $this->session->flashdata('msgbox');?>
						<div class="form-group">        
                          <div class="col-sm-2" style="border-bottom: 2px solid #6EBACC;">
                            Harap isi isian di bawah ini:
                          </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Pilih Periode</label>
                            <div class="col-sm-9">
                                <select name="id_kategori" id="myDropDown" onchange="showDiv(this)" class="col-xs-10 col-sm-5" required>
                                    <option value="">Pilih</option>
                                    <option value="harian">Harian</option>
                                    <option value="bulanan">Bulanan</option>
                                </select>
                            </div>
                        </div>
                        <script>
                            function showDiv(elem){
                               if(elem.value == "harian"){
                                    document.getElementById('tanggal').style.display = "block";
                                    document.getElementById('bulan').style.display = "none";
                                }else{
                                    document.getElementById('tanggal').style.display = "none";
                                    document.getElementById('bulan').style.display = "block";
                                }
                            }
                        </script>
                        <div id="tanggal" style="display:none;">
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tanggal</label>
                                <div class="col-sm-9">
                                    <input type="date" id="form-field-1" name="tanggal" value="" placeholder="Isi Password" class="col-xs-10 col-sm-5" />
                                </div>
                            </div>
                        </div>
                        <div id="bulan" style="display:none;">
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Bulan</label>
                                <div class="col-sm-9">
                                    <select name="bulan" class="col-xs-10 col-sm-5" required>
                                        <option value="1">Januari</option>
                                        <option value="2">Februari</option>
                                        <option value="3">Maret</option>
                                        <option value="4">April</option>
                                        <option value="5">Mei</option>
                                        <option value="6">Juni</option>
                                        <option value="7">Juli</option>
                                        <option value="8">Agustus</option>
                                        <option value="9">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                                <button class="btn btn-info" type="submit">
                                    <i class="ace-icon fa fa-check bigger-110"></i>
                                    Simpan
                                </button>

                                &nbsp; &nbsp; &nbsp;
                                <button class="btn" type="reset">
                                    <i class="ace-icon fa fa-undo bigger-110"></i>
                                    Reset
                                </button>
                            </div>
                        </div>

                        <div class="hr hr-24"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>