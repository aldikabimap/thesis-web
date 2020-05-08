<?php 
	/*require('fpdf.php');*/

   	$pdf = new FPDF();

 	$pdf->AddPage('P');
	$pdf->SetFont('Arial','B',12);
	if($id_kategori == "harian"){
		$pdf->Cell(0,10,'DATA TRANSAKSI TANGGAL '.$date,0,0,'C');
	}else{
		if($bulan == 1){
			$bulan = "Januari";
		}else if($bulan == 2){
			$bulan = "Februari";
		}else if($bulan == 3){
			$bulan = "Maret";
		}else if($bulan == 4){
			$bulan = "April";
		}else if($bulan == 5){
			$bulan = "Mei";
		}else if($bulan == 6){
			$bulan = "Juni";
		}else if($bulan == 7){
			$bulan = "Juli";
		}else if($bulan == 8){
			$bulan = "Agustus";
		}else if($bulan == 9){
			$bulan = "September";
		}else if($bulan == 10){
			$bulan = "Oktober";
		}else if($bulan == 11){
			$bulan = "November";
		}else if($bulan == 12){
			$bulan = "Desember";
		}
		$pdf->Cell(0,10,'DATA TRANSAKSI BULAN '.strtoupper($bulan),0,0,'C');
	}
	
	$pdf->Ln(15);


	$pdf->Ln(10);
	$pdf->SetFont('Arial','',9);


    if($id_kategori == "harian"){
	    foreach ($listData as $key => $value) {
	    	if ($value->transaksi_status == 0) {
		        $trans_stat = "New"; 
		    }else if($value->transaksi_status == 1){
		        $trans_stat = "Paid";
		    }else if($value->transaksi_status == 2){
		        $trans_stat = "Void";
		    }else{
		        $trans_stat = "Reture";
		    }

	    	$pdf->Cell(30,5,'Nomor Faktur',0,0,'L',0);
			$pdf->Cell(30,5,': '.$value->transaksi_faktur_no,0,0,'L',0);
	    	$pdf->Ln();
	    	$pdf->Cell(30,5,'Status',0,0,'L',0);
			$pdf->Cell(30,5,': '.$trans_stat,0,0,'L',0);
	    	$pdf->Ln();
	    	$pdf->Cell(30,5,'Discount',0,0,'L',0);
			$pdf->Cell(30,5,': '.$value->transaksi_discount." %",0,0,'L',0);
	    	$pdf->Ln();
		    $pdf->Cell(10,5,'#',0,0,'L',0);
			$pdf->Cell(60,5,'Nama Barang',0,0,'L',0);
			$pdf->Cell(30,5,'Harga Barang',0,0,'L',0);
			$pdf->Cell(30,5,'Qty Barang',0,0,'L',0);
			$pdf->Ln();

			$detailItemData = $this->m_transaksi->getTransaksiBarangDetail($value->transaksi_id);
			$no=0;
			foreach ($detailItemData as $key_item => $value_item) {
				$no++;
				$pdf->Cell(10,5,$no,0,0,'L',0);
				$pdf->Cell(60,5,$value_item->barang_name,0,0,'L',0);
				$pdf->Cell(30,5,"Rp.".number_format((intval($value_item->transaksi_detail_harga_jual))),0,0,'L',0);
				$pdf->Cell(30,5,$value_item->transaksi_detail_qty,0,0,'C',0);
				$pdf->Ln();
			}
			$pdf->Ln(10);
	    }
	}else{
		$total_barang_terjual = 0;
		$total_grand_harga = 0;
		foreach ($listData as $key => $value) {
	    	if ($value->transaksi_status == 0) {
		        $trans_stat = "New"; 
		    }else if($value->transaksi_status == 1){
		        $trans_stat = "Paid";
		    }else if($value->transaksi_status == 2){
		        $trans_stat = "Void";
		    }else{
		        $trans_stat = "Reture";
		    }

		    $detailItemData = $this->m_transaksi->getTransaksiBarangDetail($value->transaksi_id);
			
			$total_qty = 0;
			$total_harga = 0;
			foreach ($detailItemData as $key_item => $value_item) {
				$total_qty 		+= $value_item->transaksi_detail_qty;
				$total_harga    += (intval($value_item->transaksi_detail_harga_jual));
			}

	    	$pdf->Cell(30,5,'Nomor Faktur',0,0,'L',0);
			$pdf->Cell(30,5,': '.$value->transaksi_faktur_no,0,0,'L',0);
	    	$pdf->Ln();
	    	$pdf->Cell(30,5,'Status',0,0,'L',0);
			$pdf->Cell(30,5,': '.$trans_stat,0,0,'L',0);
	    	$pdf->Ln();
	    	$pdf->Cell(30,5,'Discount',0,0,'L',0);
			$pdf->Cell(30,5,': '.$value->transaksi_discount." %",0,0,'L',0);
	    	$pdf->Ln();
	    	$pdf->Cell(30,5,'Total Barang',0,0,'L',0);
			$pdf->Cell(30,5,': '.$total_qty,0,0,'L',0);
	    	$pdf->Ln();
	    	$pdf->Cell(30,5,'Total Harga Barang',0,0,'L',0);
			$pdf->Cell(30,5,': Rp. '.number_format($total_harga),0,0,'L',0);
	    	$pdf->Ln(10);

	    	$total_barang_terjual += $total_qty;
			$total_grand_harga += $total_harga;
	    }

	    $pdf->SetFont('Arial','B',9);
	    $pdf->Ln(5);
	    $pdf->Cell(50,5,'Total Barang Terjual',0,0,'L',0);
		$pdf->Cell(30,5,': '.$total_barang_terjual,0,0,'L',0);
    	$pdf->Ln();
    	$pdf->Cell(50,5,'Total Harga',0,0,'L',0);
		$pdf->Cell(30,5,': Rp. '.number_format($total_grand_harga),0,0,'L',0);
    	$pdf->Ln();
	}

	
		
	echo $pdf->Output();
?>