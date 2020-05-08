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
                <li class="active">Data Reture</li>
            </ul>
        </div>
        <div class="page-content">
            <div class="page-header">
                <h1>
                    Data Reture
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
                                Menampilkan Seluruh Data Reture
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
                                        <button type="submit" style="margin-top: 18px;" class="btn btn-sm btn-success pull-left">
                                            <i class="ace-icon fa fa-search"></i>
                                            Cari
                                        </button>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="<?php echo base_url('admin/laporan/reture_pdf') ?>">
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
                                            <th>Reture Ref Faktur No</th>
                                            <th>Total Barang Di-reture</th>
                                            <th>Vendor</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead> 
                                    <tbody>
                                     <?php
                                     $no = 0 ;
                                     $status_pembelian = ['0'=>'Belum Terima','1'=>'Selesai'];
                                     foreach($listData as $value){
                                        $no++;
                                        $total_qty = $this->db->query("SELECT
                                                                        sum(reture_detail_qty) as total_qty
                                                                    FROM
                                                                        tbl_reture_detail
                                                                    WHERE
                                                                        id_reture = '".$value->reture_id."'")->row();
                                        ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $value->pembelian_faktur_no; ?></td>
                                            <td><?= $total_qty->total_qty; ?></td>
                                            <td><?= $value->vendor_name; ?></td>
                                            <td><?= date_format(date_create($value->pembelian_date),'Y-m-d'); ?></td>
                                            <td><?= $status_pembelian[$value->pembelian_status]; ?></td>
                                            <td>
                                                <a href="<?= base_url('admin/reture/detail/'.$value->reture_id) ?>"><button class="btn btn-primary btn-sm btnEmptySaldo"   style="margin-left:2px"><i class="fa fa-eye" style="font-size: 14px;"></i>&nbsp;&nbsp;<span>Lihat</span></button></a>
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
