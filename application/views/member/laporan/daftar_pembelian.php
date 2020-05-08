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
                <li class="active">Data Pembelian</li>
            </ul>
        </div>
        <div class="page-content">
            <div class="page-header">
                <h1>
                    Data Pembelian
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
                                Menampilkan Seluruh Data Pembelian
                            </div>
                            <div class="row">
                                <!-- Column -->
                                <div class="col-sm-6">
                                    <div class="card">
                                        <div class="card-block">
                                            <h4 class="card-title">Total Pengeluaran Uang</h4>
                                            <div class="text-right">
                                            <?php 
                                                $penjumlahan = $listSummary->harga + $listSummary->ppn;
                                                $summary = $penjumlahan - $listSummary->discount;
                                            ?>
                                                <h2 class="font-light m-b-0"><i class="ti-arrow-up text-success"></i>Rp. <?php echo number_format($summary)?></h2>
                                                <span class="text-muted">Totoal Pengeluaran</span>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: 100%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Column -->
                                <!-- Column 
                                <div class="col-sm-6">
                                    <div class="card">
                                        <div class="card-block">
                                            <h4 class="card-title">Weekly Sales</h4>
                                            <div class="text-right">
                                                <h2 class="font-light m-b-0"><i class="ti-arrow-up text-info"></i> $5,000</h2>
                                                <span class="text-muted">Todays Income</span>
                                            </div>
                                            <span class="text-info">30%</span>
                                            <div class="progress">
                                                <div class="progress-bar bg-info" role="progressbar" style="width: 30%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Column -->
                            </div>
                            <div class="row" style="margin: 10px 0px;">
                                <form method="post" action="">
                                    <div class="col-md-3">
                                        <span>Vendor</span>
                                        <select name="laporan_id_vendor" class="form-control">
                                            <option value="">Pilih Vendor</option>
                                            <?php foreach ($vendor_options as $key => $value) {?>
                                            <option value="<?= $value->vendor_id ?>"><?= $value->vendor_name ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
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
                                </form>
                            </div>                   
                            <div>
                                <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Faktur No</th>
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
                                        ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $value->pembelian_faktur_no; ?></td>
                                            <td><?= $value->vendor_name; ?></td>
                                            <td><?= date_format(date_create($value->pembelian_date),'Y-m-d'); ?></td>
                                            <td><?= $status_pembelian[$value->pembelian_status]; ?></td>
                                            <td>
                                                <a href="<?= base_url('admin/pembelian/detail/'.$value->pembelian_id) ?>"><button class="btn btn-primary btn-sm btnEmptySaldo"   style="margin-left:2px"><i class="fa fa-eye" style="font-size: 14px;"></i>&nbsp;&nbsp;<span>Lihat</span></button></a>
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
