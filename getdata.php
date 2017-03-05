<?php 
include 'koneksi.php';

// KB 4916 QD

$db = mssql_select_db("data_bpkb");

$pilihan = $_GET['pilihan'];

// 1. nomor rangka 
// 2. nomor bpkb 
// 3. nomor polisi 


$data = $_GET['data'];


/// buat kondisi dulu 


if($pilihan == 1 ) {

	$where = " where no_rangka = '$data' ";
}

else if($pilihan == 2 ) {

	$where = " where no_bpkb = '$data' ";
}

if($pilihan == 3 ) {

	$where = " where no_pol = '$data' ";
}

$sql =  'select NO_BPKB ,TGL_BPKB,REG_BPKB,PEMILIK1,PEMILIK2,ALAMAT1,ALAMAT2,ALAMAT3,NO_POL ,MODEL,SILINDER,WARNA,NO_RANGKA,NO_MESIN,BLOKIR,TGL_BLOKIR,MUTLD,TGL_MUTLD,HILANG,TGL_HILANG,DUP AS DUPLIKAT,TGL_DUP,DITEMUKAN,TGL_DITEMUKAN,RUSAK,TGL_RUSAK,MUTASI_MASUK AS MUTMASUK,TGL_MUTMASUK,BBN1,TGL_BBN1,TGL_HISTORY,GANTI_NAMA,TGL_GANTINAMA,GANTI_NOPOL,TGL_GANTINOPOL,
PINDAH_ALAMAT,TGL_PINDAHALAMAT,GANTI_WARNA,TGL_GANTIWARNA,GANTI_MESIN,TGL_GANTIMESIN,RUBAH_BENTUK,TGL_RUBAHBENTUK,BUKA_BLOKIR,TGL_BUKABLOKIR from history '; 

$sql .= $where; 

$rs = mssql_query($sql);

$rarray = array();

if(mssql_num_rows($rs) > 0 )
{
	while($row=mssql_fetch_assoc($rs)) {


	/*

when  bbn1 is not null then 'PENDAFTARAN PERTAMA'
when  mutld is not null then 'MUTASI LUAR DAERAH'
when  blokir is not null then 'BLOKIR'
when  duplikat is not null then 'DUPLIKAT'
when  rusak is not null then 'RUSAK'
when  hilang is not null then 'HILANG'
when  ditemukan is not null then 'DITEMUKAN'
when  buka_blokir is not null then 'BUKA BLOKIR'
when  mutmasuk is not null then 'MUTASI MASUK'
when  ganti_nama is not null then 'GANTI NAMA'
when  ganti_nopol is not null then 'GANTI NOPOL'
when  pindah_alamat is not null then 'PINDAH ALAMAT'
when  ganti_warna is not null then 'GANTI WARNA'
when  ganti_mesin is not null then 'GANTI MESIN' 
when  rubah_bentuk is not null then 'RUBAH BENTUK' 



	*/

		if($row['BBN1'] == true ) $row['STATUS'] = 'PENDAFTARAN PERTAMA';
		else if($row['MUTLD'] == true ) $row['STATUS'] = 'MUTASI LUAR DAERAH';
		else if($row['BLOKIR'] == true ) $row['STATUS'] = 'BLOKIR';
		else if($row['DUPLIKAT'] == true ) $row['STATUS'] = 'DUPLIKAT';
		else if($row['RUSAK'] == true ) $row['STATUS'] = 'RUSAK';
		else if($row['HILANG'] == true ) $row['STATUS'] = 'HILANG';

		else if($row['DITEMUKAN'] == true ) $row['STATUS'] = 'DITEMUKAN';
		else if($row['BUKA_BLOKIR'] == true ) $row['STATUS'] = 'BUKA BLOKIR';
		else if($row['MUTMASUK'] == true ) $row['STATUS'] = 'MUTASI MASUK';
		else if($row['GANTI_NAMA'] == true ) $row['STATUS'] = 'GANTI NAMA';
		else if($row['GANTI_NOPOL'] == true ) $row['STATUS'] = 'GANTI NOPOL';

		else if($row['PINDAH_ALAMAT'] == true ) $row['STATUS'] = 'PINDAH ALAMAT';
		else if($row['GANTI_WARNA'] == true ) $row['STATUS'] = 'GANTI WARNA';
		else if($row['GANTI_MESIN'] == true ) $row['STATUS'] = 'GANTI MESIN';
		else if($row['RUBAH_BENTUK'] == true ) $row['STATUS'] = 'RUBAH BENTUK';
		 


		$rarray[] = $row; 






	}
}
else {

	$sql =  ' select 
	NO_BPKB , TGL_BPKB , REG_BPKB, PENERBIT, KOT_BPKB, PEMILIK1, PEMILIK2, ALAMAT1 , ALAMAT2 , ALAMAT3 , NO_KTP , KOD_WIL , PEKERJAAN , PEMOHON , KOD_PEMILIK  , NO_POL , MERK , TIPE  , JENIS , MODEL , THN_BUAT  , SILINDER , WARNA , NO_RANGKA , NO_MESIN, BBM , SUMBU , RODA , PLAT_TNKB , NO_UJITIPE  , NO_FAKTUR , TGL_FAKTUR , ATPM , NO_PIB , NO_SUT , NO_TPT , NO_FORM_AB , KTR_BEACUKAI  , NO_LELANG , NO_DUM , PERUBAHAN , TGL_RUBAH , JENIS_RUBAH , NO_RUBAH, BLOKIR , TGL_BLOKIR , JENIS_BLOKIR , MUTLD , TGL_MUTLD , HILANG , TGL_HILANG , DUPLIKAT ,NULL  AS TGL_DUPLIKAT, DITEMUKAN , TGL_DITEMUKAN , RUSAK , TGL_RUSAK , MUTMASUK ,NULL AS TGL_MUTMASUK, MATI , R24 , NO_TLP , KODE_DEALER ,NULL AS BBN1,NULL AS TGL_BBN1,NULL AS TGL_HISTORY,NULL AS GANTI_NAMA,NULL AS  TGL_GANTINAMA,NULL AS  GANTI_NOPOL,NULL AS  TGL_GANTINOPOL,NULL AS  PINDAH_ALAMAT,NULL AS  TGL_PINDAHALAMAT,NULL AS  GANTI_WARNA,NULL AS  TGL_GANTIWARNA,NULL AS  GANTI_MESIN,NULL AS  TGL_GANTIMESIN ,NULL AS  RUBAH_BENTUK,NULL AS  TGL_RUBAHBENTUK,NULL AS  BUKA_BLOKIR,NULL AS  TGL_BUKABLOKIR from bpkb ';
	$sql .= $where; 

	echo $sql;

	$rs = mssql_query($sql);
	while($row=mssql_fetch_assoc($rs)) {

		if($row['BBN1'] == true ) $row['STATUS'] = 'PENDAFTARAN PERTAMA';
		else if($row['MUTLD'] == true ) $row['STATUS'] = 'MUTASI LUAR DAERAH';
		else if($row['BLOKIR'] == true ) $row['STATUS'] = 'BLOKIR';
		else if($row['DUPLIKAT'] == true ) $row['STATUS'] = 'DUPLIKAT';
		else if($row['RUSAK'] == true ) $row['STATUS'] = 'RUSAK';
		else if($row['HILANG'] == true ) $row['STATUS'] = 'HILANG';

		else if($row['DITEMUKAN'] == true ) $row['STATUS'] = 'DITEMUKAN';
		else if($row['BUKA_BLOKIR'] == true ) $row['STATUS'] = 'BUKA BLOKIR';
		else if($row['MUTMASUK'] == true ) $row['STATUS'] = 'MUTASI MASUK';
		else if($row['GANTI_NAMA'] == true ) $row['STATUS'] = 'GANTI NAMA';
		else if($row['GANTI_NOPOL'] == true ) $row['STATUS'] = 'GANTI NOPOL';

		else if($row['PINDAH_ALAMAT'] == true ) $row['STATUS'] = 'PINDAH ALAMAT';
		else if($row['GANTI_WARNA'] == true ) $row['STATUS'] = 'GANTI WARNA';
		else if($row['GANTI_MESIN'] == true ) $row['STATUS'] = 'GANTI MESIN';
		else if($row['RUBAH_BENTUK'] == true ) $row['STATUS'] = 'RUBAH BENTUK';

		$rarray[] = $row; 

	}

}
//echo '<pre>'; print_r($rarray); exit;
echo json_encode($rarray);

?>