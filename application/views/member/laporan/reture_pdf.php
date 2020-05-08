<?php 
	/*require('fpdf.php');*/

   	$pdf = new FPDF();

 	$pdf->AddPage('P');
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(0,10,'DATA RETURE BARANG',0,0,'C');
	
	$pdf->Ln(15);


	$pdf->Ln(10);
	$pdf->SetFont('Arial','B',9);

	$pdf->Ln();
    $pdf->Cell(10,5,'No',0,0,'L',0);
	$pdf->Cell(30,5,'No Faktur',0,0,'L',0);
	$pdf->Cell(30,5,'Total Barang',0,0,'L',0);
	$pdf->Cell(40,5,'Vendor',0,0,'L',0);
	$pdf->Cell(35,5,'Tanggal Pembelian',0,0,'L',0);
	$pdf->Cell(35,5,'Tanggal Reture',0,0,'L',0);
	$pdf->Cell(30,5,'Status',0,0,'L',0);
	$pdf->Ln();
	
	$pdf->Ln(10);
	$pdf->SetFont('Arial','',9);

	$no=0;
	$total_qtynya = 0;
	$status_pembelian = ['0'=>'Belum Terima','1'=>'Selesai'];
	foreach ($listData as $key => $value) {
		$total_qty = $this->db->query("SELECT
                                        sum(reture_detail_qty) as total_qty
                                    FROM
                                        tbl_reture_detail
                                    WHERE
                                        id_reture = '".$value->reture_id."'")->row()->total_qty;
		$total_qtynya += (intval($total_qty));

		$no++;
		$pdf->Cell(10,5,$no,0,0,'L',0);
		$pdf->Cell(30,5,$value->pembelian_faktur_no,0,0,'L',0);
		$pdf->Cell(30,5,$total_qty,0,0,'L',0);
		$pdf->Cell(40,5,$value->vendor_name,0,0,'L',0);
		$pdf->Cell(35,5,date_format(date_create($value->pembelian_date),'Y-m-d'),0,0,'L',0);
		$pdf->Cell(35,5,date_format(date_create($value->reture_date),'Y-m-d'),0,0,'L',0);
		$pdf->Cell(30,5,$status_pembelian[$value->pembelian_status],0,0,'L',0);
		$pdf->Ln();
	}
	$pdf->Ln(10);
	    

    $pdf->SetFont('Arial','B',9);
    $pdf->Ln(5);
    $pdf->Cell(50,5,'Total Barang Direture',0,0,'L',0);
	$pdf->Cell(30,5,': '.$total_qtynya,0,0,'L',0);
	

	
		
	echo $pdf->Output();
?>