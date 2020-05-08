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
                    <a href="<?= base_url('admin/dashboard') ?>">Beranda</a>
                </li>
                <li class="active">Data Transaksi</li>
            </ul>
        </div>
        <div class="page-content">
            <div class="page-header">
                <h1>
                    Data Transaksi
                </h1>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="clearfix">
                                <?= $this->session->flashdata('msgbox') ?>
                            </div>
                            <div class="table-header">
                                Menampilkan Seluruh Data Transaksi
                            </div>
                            <div class="row" style="margin: 10px 0px;">
                                <form method="post" action="">
                                    <div class="col-md-3">
                                        <span>Dari Tanggal</span>
                                        <input type="date" class="form-control" name="laporan_data_from">
                                    </div>
                                    <div class="col-md-3">
                                        <span>Sampai Tanggal</span>
                                        <input type="date" class="form-control" name="laporan_data_to">
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit" style="margin-top: 18px;" class="btn btn-sm btn-success pull-left" data-dismiss="modal">
                                            <i class="ace-icon fa fa-search"></i>
                                            Cari
                                        </button>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="<?php echo base_url('admin/laporan/filter_transaksi') ?>">
                                            <button type="button" class="btn btn-sm btn-warning pull-right" data-dismiss="modal">
                                              <i class="ace-icon fa fa-download"></i>
                                                Download Laporan PDF
                                            </button>
                                        </a> 
                                    </div>
                                </form>
                            </div>   

                            <div>
                                <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Faktur No</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead> 
                                    <tbody>
                                     <?php
                                     $no = 0 ;
                                     foreach($listData as $value){
                                        $no++;
                                        if ($value->transaksi_status == 0) {
                                            $trans_stat = "New"; 
                                        }else if($value->transaksi_status == 1){
                                            $trans_stat = "Paid";
                                        }else if($value->transaksi_status == 2){
                                            $trans_stat = "Void";
                                        }else{
                                            $trans_stat = "Reture";
                                        }
                                        ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $value->transaksi_faktur_no; ?></td>
                                            <td><?= date_format(date_create($value->transaksi_date),'Y-m-d'); ?></td>
                                            <td><?= $trans_stat; ?></td>
                                            <td>
                                                <a href="<?= base_url('admin/laporan/detail/'.$value->transaksi_id) ?>"><button class="btn btn-primary btn-sm btnEmptySaldo"   style="margin-left:2px"><i class="fa fa-eye" style="font-size: 14px;"></i>&nbsp;&nbsp;<span>Lihat</span></button></a>
                                            </td>

                                        </tr>
                                        <?php 
                                    }
                                    ?>   
                                    </tbody>
                                </table> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
