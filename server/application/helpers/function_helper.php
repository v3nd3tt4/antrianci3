<?php

function TanggalIndo($date){
	$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");	
	$tahun = substr($date, 0, 4);
	$bulan = substr($date, 5, 2);
	$tgl   = substr($date, 8, 2);	
	$result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;		
	return($result);
}

function get_kode($panjang){
	$randomkode = array(
	 range(1,9),
	 range('a','z'),
	 range('A','Z')
	);
	$karakter = array();
	foreach($randomkode as $key=>$val){
	 foreach($val as $k=>$v){
				   $karakter[] = $v;
	 }
	}
	$randomkode = null;
	for($i=1; $i<=$panjang; $i++){
	 // mengambil array secara acak
	 $randomkode .= $karakter[rand($i, count($karakter) - 1)];
	}
	return $randomkode;
   }