<?php
class rocknroll extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper("tanggal");
	}


	 

function cek_riwayat(){
	$post = $this->input->post();

	
	$this->db->select("NO_BPKB ,
		format(TGL_BPKB,'dd-MM-yyyy') as TGL_BPKB, 
		REG_BPKB,
		PEMILIK1,
		PEMILIK2,
		ALAMAT1,
		ALAMAT2,
		ALAMAT3,
		NO_POL ,
		MODEL,
		SILINDER,
		WARNA,
		NO_RANGKA,
		NO_MESIN,
		BLOKIR,
		TGL_BLOKIR,
		MUTLD,
		TGL_MUTLD,
		HILANG,
		TGL_HILANG,
		DUP AS DUPLIKAT,
		TGL_DUP,
		DITEMUKAN,
		TGL_DITEMUKAN,
		RUSAK,
		TGL_RUSAK,
		MUTASI_MASUK AS MUTMASUK,
		TGL_MUTMASUK,
		BBN1,
		TGL_BBN1,
		TGL_HISTORY,
		GANTI_NAMA,
		TGL_GANTINAMA,
		GANTI_NOPOL,
		TGL_GANTINOPOL,

		PINDAH_ALAMAT,
		TGL_PINDAHALAMAT,
		GANTI_WARNA,
		TGL_GANTIWARNA,
		GANTI_MESIN,
		TGL_GANTIMESIN,
		RUBAH_BENTUK,
		TGL_RUBAHBENTUK,
		BUKA_BLOKIR,
		TGL_BUKABLOKIR")
	->from('history');

	if($post['pilihan']=="1") { // nomor rangka 

		$this->db->where("no_rangka",$post['query_data']);
	}
	else {
		$this->db->where("no_pol",$post['query_data']);
	}

	$res = $this->db->get();

	 
	$arr_hasil =  array();

	 
	if($res->num_rows() > 0 ) {

		foreach($res->result() as $row):

			$index = strtolower($row->NO_RANGKA.$row->TGL_BPKB.$row->NO_BPKB.$row->NO_POL);
			$index = str_replace(" ", '', $index);
			$index = str_replace("-", '', $index);
			$arr_hasil[$index]=$row;

		endforeach;

	}
	else { // jika tidak ada di tabel history, cari di bpkb.

		//echo "data bpkb ";

		$this->db->select("NO_BPKB ,
		format(TGL_BPKB,'dd-MM-yyyy') as TGL_BPKB, 
		 
		 REG_BPKB,
		 PENERBIT,
		 KOT_BPKB,
		 PEMILIK1,
		 PEMILIK2,
		 ALAMAT1 ,
		 ALAMAT2 ,
		 ALAMAT3 ,
		 NO_KTP ,
		 KOD_WIL ,
		 PEKERJAAN ,
		 PEMOHON ,
		 KOD_PEMILIK  ,
		 NO_POL ,
		 MERK ,
		 TIPE  ,
		 JENIS ,
		 MODEL ,
		 THN_BUAT  ,
		 SILINDER ,
		 WARNA ,
		 NO_RANGKA ,
		 NO_MESIN,
		 BBM ,
		 SUMBU ,
		 RODA ,
		 PLAT_TNKB ,
		 NO_UJITIPE  ,
		 NO_FAKTUR ,
		 TGL_FAKTUR ,
		 ATPM ,
		 NO_PIB ,
		 NO_SUT ,
		 NO_TPT ,
		 NO_FORM_AB ,
		 KTR_BEACUKAI  ,
		 NO_LELANG ,
		 NO_DUM ,
		 PERUBAHAN ,
		 TGL_RUBAH ,
		 JENIS_RUBAH ,
		 NO_RUBAH,
		 BLOKIR ,
		 TGL_BLOKIR ,
		 JENIS_BLOKIR ,
		 MUTLD ,
		 TGL_MUTLD ,
		 HILANG ,
		 TGL_HILANG ,
		 DUPLIKAT ,
		 NULL  AS TGL_DUPLIKAT,
		 DITEMUKAN ,
		 TGL_DITEMUKAN ,
		 RUSAK ,
		 TGL_RUSAK ,
		 MUTMASUK ,
		 NULL AS TGL_MUTMASUK,
		 MATI ,
		 R24 ,
		 NO_TLP ,
		 KODE_DEALER ,
		 NULL AS BBN1,
		NULL AS TGL_BBN1,
		NULL AS TGL_HISTORY,
		NULL AS GANTI_NAMA,
		NULL AS  TGL_GANTINAMA,
		NULL AS  GANTI_NOPOL,
		NULL AS  TGL_GANTINOPOL,
		NULL AS  PINDAH_ALAMAT,
		NULL AS  TGL_PINDAHALAMAT,
		NULL AS  GANTI_WARNA,
		NULL AS  TGL_GANTIWARNA,
		NULL AS  GANTI_MESIN,
		NULL AS  TGL_GANTIMESIN ,
		NULL AS  RUBAH_BENTUK,
		NULL AS  TGL_RUBAHBENTUK,
		NULL AS  BUKA_BLOKIR,
		NULL AS  TGL_BUKABLOKIR")->from('bpkb');
		if($post['pilihan']=="1") { // nomor rangka 

		$this->db->where("no_rangka",$post['query_data']);
		}
		else {
			$this->db->where("no_pol",$post['query_data']);
		}

		$res = $this->db->get();
		foreach($res->result() as $row): 
			$index = strtolower($row->NO_RANGKA.$row->TGL_BPKB.$row->NO_BPKB.$row->NO_POL);
			$index = str_replace(" ", '', $index);
			$index = str_replace("-", '', $index);
			$arr_hasil[$index]=$row;



		endforeach;



	}

	// 
	//show_array($arr_hasil);
	$arr_ret = array();
	foreach($arr_hasil as $index => $row ) : 

		if($row->BBN1 == true ) $row->STATUS = 'PENDAFTARAN PERTAMA';
		else if($row->MUTLD == true ) $row->STATUS = 'MUTASI LUAR DAERAH';
		else if($row->BLOKIR == true ) $row->STATUS = 'BLOKIR';
		else if($row->DUPLIKAT == true ) $row->STATUS = 'DUPLIKAT';
		else if($row->RUSAK == true ) $row->STATUS = 'RUSAK';
		else if($row->HILANG == true ) $row->STATUS = 'HILANG';

		else if($row->DITEMUKAN == true ) $row->STATUS = 'DITEMUKAN';
		else if($row->BUKA_BLOKIR == true ) $row->STATUS = 'BUKA BLOKIR';
		else if($row->MUTMASUK == true ) $row->STATUS = 'MUTASI MASUK';
		else if($row->GANTI_NAMA == true ) $row->STATUS = 'GANTI NAMA';
		else if($row->GANTI_NOPOL == true ) $row->STATUS = 'GANTI NOPOL';

		else if($row->PINDAH_ALAMAT == true ) $row->STATUS = 'PINDAH ALAMAT';
		else if($row->GANTI_WARNA == true ) $row->STATUS = 'GANTI WARNA';
		else if($row->GANTI_MESIN == true ) $row->STATUS = 'GANTI MESIN';
		else if($row->RUBAH_BENTUK == true ) $row->STATUS = 'RUBAH BENTUK';
		$arr_ret[$index] = $row;
	endforeach;


	//show_array($arr_ret);
	if(count($arr_ret) == 0 ) {
		echo "Data tidak ditemukan";

	}
	else { 
	$data['arr'] = $arr_ret;
	$this->load->view("riwayat_table",$data);
	}


}

function cek_bbn1(){
	$post = $this->input->post();
	$tgl_awal = flipdate($post['tgl_awal']);
	$tgl_akhir = flipdate($post['tgl_akhir']);

	$sql = "select jenis, count(*) as jumlah from history 
			where bbn1 is not null  
			 and tgl_bpkb between '$tgl_awal' and '$tgl_akhir'
			group by jenis 
			";

    $res = $this->db->query($sql);

    // echo $this->db->last_query(); exit;
    $data['arr'] = $res;
    $this->load->view("bbn1_table",$data);




}

function baliknama(){
	$post = $this->input->post();
	$tgl_awal = flipdate($post['tgl_awal']);
	$tgl_akhir = flipdate($post['tgl_akhir']);

	$sql = "select jenis, count(*) as jumlah from history 
			where ganti_nama is not null  
			and tgl_gantinama between '$tgl_awal' and '$tgl_akhir'
			group by jenis ";

    $res = $this->db->query($sql);

    // echo $this->db->last_query(); exit;
    $data['arr'] = $res;
    $this->load->view("baliknama_table",$data);




}

function mutasimasuk(){
	$post = $this->input->post();
	$tgl_awal = flipdate($post['tgl_awal']);
	$tgl_akhir = flipdate($post['tgl_akhir']);

	$sql = "select jenis, count(*) as jumlah from history 
			where mutasi_masuk is not null  
			and tgl_mutmasuk between '$tgl_awal' and '$tgl_akhir'

			group by jenis ";

    $res = $this->db->query($sql);

    // echo $this->db->last_query(); exit;
    $data['arr'] = $res;
    $this->load->view("mutasimasuk_table",$data);




}


function mutasikeluar(){
	$post = $this->input->post();
	$tgl_awal = flipdate($post['tgl_awal']);
	$tgl_akhir = flipdate($post['tgl_akhir']);

	$sql = "select jenis, count(*) as jumlah from history 
			where mutld is not null  
			and tgl_mutld between '$tgl_awal' and '$tgl_akhir'

			group by jenis ";

    $res = $this->db->query($sql);

    // echo $this->db->last_query(); exit;
    $data['arr'] = $res;
    $this->load->view("mutasikeluar_table",$data);




}



function perbatasan(){
	$post = $this->input->post();
	$tgl_awal = flipdate($post['tgl_awal']);
	$tgl_akhir = flipdate($post['tgl_akhir']);

	$CI = &get_instance();
 
	$this->db2 = $CI->load->database('oracle', TRUE);

	// $ora = $this->load->database('oracle');

	$sql = "SELECT A.PERBATASAN_ID,A.NO_RANGKA,A.NO_MESIN,A.JML_RODA,A.JML_SUMBU,A.THN_BUAT,A.VOL_SILINDER,A.BB_ID,A.MERK_ID,A.TIPE,A.TIPE2,
          A.JENIS_ID, A.INSERT_DATE, A.INSERT_BY, C.MERK_NAMA, B.BB_NAMA, D.JENIS_NAMA, E.NAMA_PEMILIK, E.ALAMAT_PEMILIK, E.NO_IDENTITAS, 
          E.INSERT_DATE, E.INSERT_BY, E.NOPOL, F.IDENTITAS_SOPIR, F.NAMA_SOPIR, F.ALAMAT_SOPIR, F.INSERT_DATE, F.INSERT_BY, F.NO_TELP,
          G.DATE_IN,H.DATE_OUT, I.WARNA_NAMA
       FROM T_REG_PERBATASAN A
       INNER JOIN M_BAHANBAKAR B ON B.BB_ID=A.BB_ID
       INNER JOIN M_MERK C ON C.MERK_ID=A.MERK_ID
       INNER JOIN M_JENIS D ON D.JENIS_ID=A.JENIS_ID
       INNER JOIN M_WARNA I ON I.WARNA_ID=A.WARNA_ID
       LEFT JOIN T_REG_PERBATASAN_HIST E ON E.PERBATASAN_ID=A.PERBATASAN_ID AND ROWNUM = 1
       LEFT JOIN T_REG_PERBATASAN_SOPIR F ON F.PERBATASAN_ID=A.PERBATASAN_ID AND ROWNUM = 1
       LEFT JOIN T_REG_PERBATASAN_IN G ON G.PERBATASAN_ID=A.PERBATASAN_ID AND ROWNUM = 1
       LEFT JOIN T_REG_PERBATASAN_OUT H ON H.PERBATASAN_ID=A.PERBATASAN_ID AND ROWNUM = 1
      
       WHERE A.INSERT_DATE BETWEEN TO_DATE('$tgl_awal','YYYY-MM-DD') 
       and TO_DATE('$tgl_akhir','YYYY-MM-DD')";

    $res = $this->db2->query($sql);

    // echo $this->db2->last_query(); exit;
    $data['arr'] = $res;
    $this->load->view("perbatasan_table",$data);




}

function login(){
	$CI = &get_instance();
 
	$this->db2 = $CI->load->database('oracle', TRUE);

	$post = $this->input->post();
	extract($post);

	$this->db2->where("EMAIL",$username);
	$this->db2->where("PASS",$password);

	$res  = $this->db2->get("XMBL_LOGIN");

	//echo $this->db2->last_query();

	if($res->num_rows() == 0 )  {
		$ret = array("success"=>false);

	}
	else {
		$data = $res->row_array();
		$ret = array("success"=>true,
					 "username"=>$data['EMAIL'],
					 "password" => $data['PASS'],
					 "level" => $data['USERLEVEL']
					 );
	}

	echo json_encode($ret);

}

function daftar(){

	$CI = &get_instance();
 
	$this->db2 = $CI->load->database('oracle', TRUE);


	$post = $this->input->post();

	// validasi  email dulu 
	$this->db2->where("EMAIL",$post['email']);
	$res = $this->db2->get("XMBL_LOGIN");

	if($res->num_rows() > 0 ) {

		$arr_ret = array("success"=>false,
						 "pesan" => "<h3>Email ini sudah terdaftar</h3> "
			);
		echo json_encode($arr_ret);
		exit;
	}


	// cek passwor sama atau tidak 
// password
// password2
	if($post['password'] <> $post['password2']) {
		$arr_ret = array("success"=>false,
						 "pesan" => "<h3>Password tidak sama </h3>"
			);
		echo json_encode($arr_ret);
		exit;
	}

	// skipp all error, it's time to save it to database .

	$arr_data=array(
			'EMAIL' => $post['email'], 
			'PASS' => $post['password'], 
			'NAMA' =>$post['nama'], 
			'USERLEVEL' => '0'
		);

	$res = $this->db2->insert("XMBL_LOGIN",$arr_data);
	//echo $this->db2->last_query();
	if($res){
		$arr_ret = array("success"=>true,
						 "pesan" => "<h3>Pendaftaran Berhasil disimpan. <br /> <br /> <a   href='#static/login.html' class='insidelink'> Silahkan login </a> </h3> "
			);
		echo json_encode($arr_ret);
		exit;
	}
	else {
		$arr_ret = array("success"=>false,
						 "pesan" => "<h3>Pendaftara Gagal Diproses </h3>"
			);
		echo json_encode($arr_ret);
		exit;
	}


}


}
?>