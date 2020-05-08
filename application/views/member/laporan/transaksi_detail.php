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
                <li class="active">Laporan Transaksi</li>
            </ul>
        </div>
        <div class="page-content">
            <div class="page-header">
                <h1>
                    Form Transaksi Detail
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                    </small>
                </h1>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <form class="form-horizontal" method="post"  enctype="multipart/form-data" action="<?php echo base_url().'admin/barang/doEdit/'.$this->uri->segment(4)?>" role="form"> 
                       <?php 
                       $dataOld = $this->session->flashdata('oldPost'); 
                       echo $this->session->flashdata('msgbox');?>
						<div class="form-group">        
                          <div class="col-sm-2" style="border-bottom: 2px solid #6EBACC;">
                            Harap isi isian di bawah ini:
                          </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Faktur No</label>
                            <div class="col-sm-9">
                                <input type="text" id="form-field-1" disabled name="transaksi_faktur_no" value="<?= $detailData->transaksi_faktur_no;?>" placeholder="Isi No Faktur" class="col-xs-10 col-sm-5"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tanggal</label>
                            <div class="col-sm-9">
                                <input type="date" id="form-field-1" disabled name="transaksi_date" value="<?= $detailData->transaksi_date;?>" placeholder="Isi No Faktur" class="col-xs-10 col-sm-5"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Discount</label>
                            <div class="col-sm-9">
                                <input type="text" id="form-field-1" name="transaksi_discount" value="<?= $detailData->transaksi_discount;?>" placeholder="Isi No Faktur" class="col-xs-10 col-sm-5" disabled />
                            </div>
                        </div>
                        <hr>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col">Harga Barang</th>
                                    <th scope="col">Qty Barang</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $no=1;
                            foreach ($detailItemData as $key => $value) {?>
                                <tr>
                                    <th scope="row"><?= $no; ?></th>
                                    <td><?= $value->barang_name ?></td>
                                    <td><?= (intval($value->transaksi_detail_harga_jual)) ?></td>
                                    <td><?= $value->transaksi_detail_qty ?></td>
                                </tr>
                            <?php 
                            $no++;
                            } ?>
                            </tbody>
                        </table>
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                                <a class="btn" href="<?= base_url('admin/laporan/transaksi') ?>">
                                    <i class="ace-icon fa fa-undo bigger-110"></i>
                                    Back
                                </a>
                            </div>
                        </div>
                        <div class="hr hr-24"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>