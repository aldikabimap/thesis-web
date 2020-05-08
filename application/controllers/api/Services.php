<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Services extends CI_Controller {
	private $signature; 
	function __construct() {
		parent::__construct ();
		
		$uri = $this->uri->segment(1);
		date_default_timezone_set('Asia/Jakarta');
		$this->load->helper ( array (
				'url',
				'form',
				'language' 
		) );
		$this->load->model ( array (
									'm_api',
									'm_login',
									'm_user',
									'm_lose',
									'm_alergi',
									'm_result'
									) 
							);
	}
	
	function index() {
		header ( "location: " . base_url () );
		die ();
	}
		
	function login(){
		$dataArray = array ( 
				'pic' => 'Api' 
		);
	
		$param = array(
				'username' =>  $this->input->post('username'),
				'password' =>  $this->input->post('password'),
				
		);
		$check_require = $this->m_api->requireValidation( $param );
		if ($check_require ['status'] == true) {

			$data = $this->m_login->checkLoginApi($param['username'], md5($param['password']));

			if($data){
				$dataArray ['results']['status_request'] = "OK";
				$dataArray ['results']['msg'] = "Login Success";
				$dataArray ['results']['profile'] = (array) $data;
				$this->m_api->sendOutput( $dataArray, 200 );
			}else{
				$dataArray ['results']['status_request'] = "NOT_OK";
				$dataArray ['results']['msg'] = "Username atau password salah";
				$dataArray ['results']['profile'] = array();
				$this->m_api->sendOutput( $dataArray, 200 ); 
			}
		} else {
			$this->m_api->sendOutput ( $dataArray, 402 ); 
		}
	}

	function register(){
		$dataArray = array ( 
				'pic' => 'Api' 
		);
	
		$param = array(
				'name' =>  $this->input->post('username'),
				'height' =>  $this->input->post('password'),
				'weight' =>  $this->input->post('username'),
				'alergies' =>  $this->input->post('alergies'),
				'motivation' =>  $this->input->post('motivation'),
				'username' =>  $this->input->post('username'),
				'password' =>  $this->input->post('password'),
				
		);
		$check_require = $this->m_api->requireValidation( $param );
		if ($check_require ['status'] == true) {

			$check = $this->m_login->checkUsername($param['username']);
			if ($check){

				$dataArray ['results']['status_request'] = "NOT_OK";
				$dataArray ['results']['msg'] = "Mohon Maaf Username Sudah Terpakai";
				$dataArray ['results']['profile'] = array();
				$this->m_api->sendOutput( $dataArray, 200 ); 
			}else{
				$insertData = array(
					'name' =>  $this->input->post('name'),
					'height' =>  $this->input->post('height'),
					'weight' =>  $this->input->post('weight'),
					'alergies' =>  $this->input->post('alergies'),
					'motivation' =>  $param['motivation'],
					"username"	=> $param['username'],
					"password"	=> md5($param['password'])
				);

				$insert = $this->db->insert("tbl_user",$insertData);

				if($insert){
					$dataArray ['results']['status_request'] = "OK";
					$dataArray ['results']['msg'] = "Register Success";
					$dataArray ['results']['profile'] = (array) $insert;
					$this->m_api->sendOutput( $dataArray, 200 );
				}else{
					$dataArray ['results']['status_request'] = "NOT_OK";
					$dataArray ['results']['msg'] = "Register Failed";
					$dataArray ['results']['profile'] = array();
					$this->m_api->sendOutput( $dataArray, 200 ); 
				}

				
			}
		} else {
			$this->m_api->sendOutput ( $dataArray, 402 ); 
		}
	}

	function getProfile(){
		$dataArray = array ( 
				'pic' => 'Api' 
		);
		$param = array(
			"user_id"	=> $this->input->post("user_id"),
		);
		
		$check_require = $this->m_api->requireValidation( $param );
		if ($check_require ['status'] == true) {
			// mengambil data di table user berdasarkan id
			$data = $this->m_user->getUserDetail($param['user_id']);
			
			if($data){
				$dataArray ['results']['status_request'] = "OK";
				$dataArray ['results']['msg'] = "Data Available";
				$dataArray ['results']['data'] = (array)$data;
				$this->m_api->sendOutput( $dataArray, 200 );
			}else{
				$dataArray ['results']['status_request'] = "NOT_OK";
				$dataArray ['results']['msg']  ="Data Not Available";
				$dataArray ['results']['data'] = array();
				$this->m_api->sendOutput( $dataArray, 200 ); 
			}
		} else {
			$this->m_api->sendOutput ( $dataArray, 402 ); 
		}
	}

	function updateProfile(){
		$dataArray = array ( 
				'pic' => 'Api' 
		);
		$param = array(
				'name' =>  $this->input->post('name'),
				'height' =>  $this->input->post('height'),
				'weight' =>  $this->input->post('weight'),
				'alergies' =>  $this->input->post('alergies'),
				'motivation' =>  $this->input->post('motivation'),
				'username' 	=>  $this->input->post('username'),
				'user_id' 	=>  $this->input->post('user_id'),
		);
		
		$check_require = $this->m_api->requireValidation( $param );
		if ($check_require ['status'] == true) {
				// mengubah username dan password
				$dataArray = array(
					'name' =>  $param['name'],
					'height' =>  $param['height'],
					'weight' =>  $param['weight'],
					'alergies' =>  $param['alergies'],
					'motivation' =>  $param['motivation'],
					'username'	 	=> $param['username'],
				);
				if (!empty($this->input->post('password'))) {
					$dataArray['password'] = md5($this->input->post('password'));
				}
				$update = $this->db->update("tbl_user",$dataArray,array("user_id" => $param['user_id']));
			if($update){
				$data = $this->m_user->getUserDetail($param['user_id']);
				$dataArray ['results']['status_request'] = "OK";
				$dataArray ['results']['msg'] = "Update Success";
				$dataArray ['results']['profile'] = (array) $data;
				$this->m_api->sendOutput( $dataArray, 200 );  
			}else {
				$dataArray ['results']['status_request'] = "NOT_OK";
				$dataArray ['results']['msg'] = "Update Failed, username sudah terpakai";
				$dataArray ['results']['profile'] = array();
				$this->m_api->sendOutput( $dataArray, 200 ); 
			}
		} else {
			$this->m_api->sendOutput ( $dataArray, 402 ); 
		}
	}

	function doAddDataUser(){
		$dataArray = array ( 
				'pic' => 'Api' 
		);
	
		$param = array(
				'name' =>  $this->input->post('name'),
				'height' =>  $this->input->post('height'),
				'weight' =>  $this->input->post('weight'),
				'alergies' =>  $this->input->post('alergies'),
				
		);
		$check_require = $this->m_api->requireValidation( $param );
		if ($check_require ['status'] == true) {

			
				$insertData = array(
					"name"		=> $param['name'],
					"height"	=> $param['height'],
					"weight"	=> $param['weight'],
					"alergies"	=> $param['alergies'],
				);

				$insert = $this->db->insert("tbl_user",$insertData);

				if($insert){
					$dataArray ['results']['status_request'] = "OK";
					$dataArray ['results']['msg'] = "Add Data Success";
					$dataArray ['results']['profile'] = (array) $insert;
					$this->m_api->sendOutput( $dataArray, 200 );
				}else{
					$dataArray ['results']['status_request'] = "NOT_OK";
					$dataArray ['results']['msg'] = "Add Data Failed";
					$dataArray ['results']['profile'] = array();
					$this->m_api->sendOutput( $dataArray, 200 ); 
				}

				
		} else {
			$this->m_api->sendOutput ( $dataArray, 402 ); 
		}
	}

	function doAddWeightGoals(){
		$dataArray = array ( 
				'pic' => 'Api' 
		);
	
		$param = array(
				'weight_goals' =>  $this->input->post('weight_goals'),
				'description' =>  $this->input->post('description'),
				'id_user'		=> $this->input->post('id_user')
				
		);
		$check_require = $this->m_api->requireValidation( $param );
		if ($check_require ['status'] == true) {

			
			$insertData = array(
				"weight_goals"		=> $param['weight_goals'],
				"description"	=> $param['description'],
				"id_user"	=> $param['id_user'],
			);

			$insert = $this->db->insert("tbl_weight_goals",$insertData);

			if($insert){
				$dataArray ['results']['status_request'] = "OK";
				$dataArray ['results']['msg'] = "Add Data Success";
				$dataArray ['results']['profile'] = (array) $insert;
				$this->m_api->sendOutput( $dataArray, 200 );
			}else{
				$dataArray ['results']['status_request'] = "NOT_OK";
				$dataArray ['results']['msg'] = "Add Data Failed";
				$dataArray ['results']['profile'] = array();
				$this->m_api->sendOutput( $dataArray, 200 ); 
			}
		} else {
			$this->m_api->sendOutput ( $dataArray, 402 ); 
		}
	}

	function updateTarget()
	{
		$dataArray = array ( 
				'pic' => 'Api' 
		);
		$post = $this->input->post();
		$param = array(
				'id_reminder'	=> $post['id_reminder'],
		);
		$check_require = $this->m_api->requireValidation( $param );
		if ($check_require ['status'] == true) {
			$dataTarget = $this->db->delete('tbl_target',['target_tgl'=>date('Y-m-d'),'id_reminder'=>$post['id_reminder']]);
			if (!empty($post['target'])) {
				foreach ($post['target'] as $key => $value) {
					 $this->db->insert('tbl_target',['target_tgl'=>date('Y-m-d'),
																'id_plan'=>$value['id_plan'],
																'id_reminder'=>$value['id_reminder']]);
				}
			}
			if($dataTarget){
				$dataArray ['results']['status_request'] = "OK";
				$dataArray ['results']['msg'] = "Success Update Target";
				$dataArray ['results']['data'] = (array) $dataTarget;
				$this->m_api->sendOutput( $dataArray, 200 );
			}else{
				$dataArray ['results']['status_request'] = "NOT_OK";
				$dataArray ['results']['msg'] = "Failed Update Target";
				$dataArray ['results']['data'] = array();
				$this->m_api->sendOutput( $dataArray, 200 ); 
			}
		} else {
			$this->m_api->sendOutput ( $dataArray, 402 ); 
		}
	}

	function getDetailDate()
	{
		$dataArray = array ( 
				'pic' => 'Api' 
		);
		$post = $this->input->post();
		$param = array(
				'id_user'		=> $post['id_user'],
				'date'		=> $post['date']
		);
		$check_require = $this->m_api->requireValidation( $param );
		if ($check_require ['status'] == true) {
			$check_plan = $this->db->where(['id_user'=>$post['id_user'],'reminder_result'=>'0'])->get('tbl_reminder')->row();
			if ($check_plan) {
				$dataPlan = $this->db->where('id_result',$check_plan->id_result)->get('tbl_plan')->result_array();
				foreach ($dataPlan as $key => $value) {
					$check_done = $this->db->where(['id_plan'=>$value['plan_id'],'id_reminder'=>$check_plan->reminder_id,'target_tgl'=>$post['date']])->get('tbl_target')->row();
					if ($check_done) {
						$dataPlan[$key]['checked'] = true;
					}else{
						$dataPlan[$key]['checked'] = false;
					}
				}
			}
			if($dataPlan){
				$dataArray ['results']['status_request'] = "OK";
				$dataArray ['results']['msg'] = "Data Available";
				$dataArray ['results']['data'] = (array) $dataPlan;
				$this->m_api->sendOutput( $dataArray, 200 );
			}else{
				$dataArray ['results']['status_request'] = "NOT_OK";
				$dataArray ['results']['msg'] = "Data Not Available";
				$dataArray ['results']['data'] = array();
				$this->m_api->sendOutput( $dataArray, 200 ); 
			}
		} else {
			$this->m_api->sendOutput ( $dataArray, 402 ); 
		}
	}

	function checkPlan()
	{
		$dataArray = array ( 
				'pic' => 'Api' 
		);
		$post = $this->input->post();
		$param = array(
				'id_user'		=> $post['id_user']
		);
		$check_require = $this->m_api->requireValidation( $param );
		if ($check_require ['status'] == true) {
			$check_plan = $this->db->where(['id_user'=>$post['id_user'],'reminder_result'=>'0'])->get('tbl_reminder')->row();
			if ($check_plan) {
				$date_start = $check_plan->reminder_tgl;
				$target = $this->db->where('id_result',$check_plan->id_result)->get('tbl_plan')->num_rows();
			}else{
				$date_start = date('Y-m-d');
				$target = 0;
			}
			// 0 = setdiet belum berjalan mulai besok, 1 = setdiet sedang berjalan, 2 = set diet expired
			$checkDate = 1;
			$today = date('Y-m-d');
			$day = null;
			$date = [];
			for ($i=1; $i <= 30; $i++) {
				$tanggal = date('Y-m-d', strtotime($date_start. ' + '.$i.' days'));
				if ($check_plan) {
					if (strtotime($tanggal)>strtotime($date_start) && $i ==1) {
						$checkDate = 0;
					}else if (strtotime($tanggal)<strtotime($date_start) && $i ==30) {
						$checkDate = 2;
					}
					$done = $this->db->where(['id_reminder'=>$check_plan->reminder_id,
											'target_tgl'=>$tanggal])->get('tbl_target')->num_rows();

					if ($today == $tanggal) {
						$day = $i-1;
					}
				}else{
					$done = 0;
				}
				$date[] =  ['date'=>$tanggal,'target'=>$target,'done'=>$done];
			}
			$data = ['have_plan'=>($check_plan?'1':'0'),
					'status_plan'=>$checkDate,
					'id_reminder'=>(!empty($check_plan->reminder_id)?$check_plan->reminder_id:''),
					'id_user'=>(!empty($check_plan->id_user)?$check_plan->id_user:''),
					'day' => $day,
					'date'=>$date];
			if ($checkDate == 2) {
				$this->db->update('tbl_reminder',['reminder_result'=>1],['reminder_id'=>$check_plan->reminder_id]);
			}
			if($data){
				$dataArray ['results']['status_request'] = "OK";
				$dataArray ['results']['msg'] = "Data Available";
				$dataArray ['results']['data'] = (array) $data;
				$this->m_api->sendOutput( $dataArray, 200 );
			}else{
				$dataArray ['results']['status_request'] = "NOT_OK";
				$dataArray ['results']['msg'] = "Data Not Available";
				$dataArray ['results']['data'] = array();
				$this->m_api->sendOutput( $dataArray, 200 ); 
			}
		} else {
			$this->m_api->sendOutput ( $dataArray, 402 ); 
		}
	}

	function resultWeightGoals(){
		$dataArray = array ( 
				'pic' => 'Api' 
		);
		$post = $this->input->post();
		$param = array(
				'height'		=> $post['height'],
				'weight'		=> $post['weight'],
				'alergies'		=> $post['alergies'],
				'lose_goals' 	=> $post['lose_goals'],
				'id_user'		=> $post['id_user']
		);
		$check_require = $this->m_api->requireValidation( $param );
		if ($check_require ['status'] == true) {

			$data  = $this->m_result->getResultWhere($param);
			$check = $this->db->where(['id_user'=>$post['id_user'],'reminder_result'=>'0'])->get('tbl_reminder')->row();
			if (!empty($data)) {
				if ($check) {
					$data->have_plan = 1;
				}else{
					$data->have_plan = 0;
				}
				$dataPlan = $this->db->where('id_result',$data->result_id)->get('tbl_plan')->result();
			}

			if($data){
				$dataArray ['results']['status_request'] = "OK";
				$dataArray ['results']['msg'] = "Data Plan Available";
				$dataArray ['results']['data'] = (array) $data;
				$dataArray ['results']['data_plan'] = $dataPlan;
				$this->m_api->sendOutput( $dataArray, 200 );
			}else{
				$dataArray ['results']['status_request'] = "NOT_OK";
				$dataArray ['results']['msg'] = "Data Plan Not Available";
				$dataArray ['results']['data'] = array();
				$this->m_api->sendOutput( $dataArray, 200 ); 
			}
		} else {
			$this->m_api->sendOutput ( $dataArray, 402 ); 
		}
	}

	function setDiet(){
		$dataArray = array ( 
				'pic' => 'Api' 
		);
		$post = $this->input->post();
		$param = array(
				'id_user'		=> $post['id_user'],
				'id_result'		=> $post['id_result'],
		);
		$check_require = $this->m_api->requireValidation( $param );
		if ($check_require ['status'] == true) {

			$data  = $this->db->insert('tbl_reminder',['id_user'=>$post['id_user'],
														'reminder_tgl'=>date('Y-m-d'),
														'id_result'=>$post['id_result'],
														'reminder_result'=>'0']);
			if($data){
				$dataArray ['results']['status_request'] = "OK";
				$dataArray ['results']['msg'] = "Set Diet Success";
				$dataArray ['results']['data'] = [];
				$this->m_api->sendOutput( $dataArray, 200 );
			}else{
				$dataArray ['results']['status_request'] = "NOT_OK";
				$dataArray ['results']['msg'] = "Set Diet Failed";
				$dataArray ['results']['data'] = array();
				$this->m_api->sendOutput( $dataArray, 200 ); 
			}
		} else {
			$this->m_api->sendOutput ( $dataArray, 402 ); 
		}
	}

	function listDataResult(){
		$dataArray = array ( 
				'pic' => 'Api' 
		);
		$param = array(
			"user_id"	=> "user_id",
		);
		
		$check_require = $this->m_api->requireValidation( $param );
		if ($check_require ['status'] == true) {
			// mengambil data di table user berdasarkan id
			$data = $this->m_result->getResult();
			
			if($data){
				$dataArray ['results']['status_request'] = "OK";
				$dataArray ['results']['msg'] = "Data Available";
				$dataArray ['results']['data'] = (array)$data;
				$this->m_api->sendOutput( $dataArray, 200 );
			}else{
				$dataArray ['results']['status_request'] = "NOT_OK";
				$dataArray ['results']['msg']  ="Data Not Available";
				$dataArray ['results']['data'] = array();
				$this->m_api->sendOutput( $dataArray, 200 ); 
			}
		} else {
			$this->m_api->sendOutput ( $dataArray, 402 ); 
		}
	}


	function bmi(){
		$dataArray = array ( 
			'pic' => 'Rudi' 
		);

		$post = $this->input->post();

		$username = mt_rand(100000, 999999);
		$param = array(
			"weight"	=> $post['weight'],
			"height"	=> $post['height'],
		);
		
		$check_require = $this->m_api->requireValidation( $param );
		if ($check_require ['status'] == true) {
			
			$bmi = $param['weight'] / pow(($post['height']/100),2);

			if($bmi < 18.5 ){
				$keterangan = "Berat badan kurang";
			}else if($bmi >= 18.5 AND $bmi <= 22.9){
				$keterangan = "Berat badan normal";
			}else if($bmi >= 23 AND $bmi <= 29.9){
				$keterangan = "Berat badan berlebih (kecenderungan obesitas)";
			}else{
				$keterangan = "Obesitas";
			}

			if($keterangan){
				$dataArray ['results']['status_request'] = "OK";
				$dataArray ['results']['msg'] 	= "Success";
				$dataArray ['results']['data'] 	= array("BMI" => $bmi, "keterangan" => $keterangan);
				$this->m_api->sendOutput( $dataArray, 200 );
			}else{
				$dataArray ['results']['status_request'] = "NOT_OK";
				$dataArray ['results']['msg'] 	= "Failed";
				$dataArray ['results']['data'] 	= array("BMI" => 0, "keterangan" => "");
				$this->m_api->sendOutput( $dataArray, 200 ); 
			}
		} else {
			$this->m_api->sendOutput ( $dataArray, 402 ); 
		}
	}

	function bmr(){
		$dataArray = array ( 
			'pic' => 'Rudi' 
		);

		$post = $this->input->post();

		$username = mt_rand(100000, 999999);
		$param = array(
			"gender"	=> $post['gender'],
			"weight"	=> $post['weight'],
			"height"	=> $post['height'],
			"usia"		=> $post['usia'],
		);
		
		$check_require = $this->m_api->requireValidation( $param );
		if ($check_require ['status'] == true) {
			
			if($param['gender'] == "L"){
				$bmr = 66 + (13.7 * $param['weight']) + (5 * $param['height']) - (6.8 * $param['usia']);
			}else{
				$bmr = 655 + (9.6 * $param['weight']) + (1.8 * $param['height']) - (4.7 * $param['usia']);
			}
			
			$bmr = $bmr*1.2;
			
			$dataArray ['results']['status_request'] = "OK";
			$dataArray ['results']['msg'] 	= "Success";
			$dataArray ['results']['data'] 	= array("BMR" => $bmr, "keterangan" => "Ini adalah jumlah kalori MINIMAL setiap hari, supaya tubuh organ tubuh Anda bisa berfungsi.");
			$this->m_api->sendOutput( $dataArray, 200 );
			
		} else {
			$this->m_api->sendOutput ( $dataArray, 402 ); 
		}
	}

	function listBooster(){
		$dataArray = array ( 
				'pic' => 'Floyd' 
		);
	
		$param = array(
				'id_user' => $this->input->post("id_user")
		);
		
		$check_require = $this->m_api->requireValidation( $param );
		if ($check_require ['status'] == true) {
			$data = $this->db->query("select * from tbl_booster where id_user = '".$param['id_user']."'")->result();

			if($data){
				$dataArray ['results']['status_request'] = "OK";
				$dataArray ['results']['msg'] = "Success";
				$dataArray ['results']['data'] = (array) $data;
				$this->m_api->sendOutput( $dataArray, 200 );
			}else{
				$dataArray ['results']['status_request'] = "NOT_OK";
				$dataArray ['results']['msg'] = "Failed";
				$dataArray ['results']['data'] = array();
				$this->m_api->sendOutput( $dataArray, 200 ); 
			}
		} else {
			$this->m_api->sendOutput ( $dataArray, 402 ); 
		}
	}

	function hapusBooster(){
		$dataArray = array ( 
				'pic' => 'Floyd' 
		);
	
		$param = array(
				'booster_id' => $this->input->post("booster_id")
		);
		
		$check_require = $this->m_api->requireValidation( $param );
		if ($check_require ['status'] == true) {
			$delete = $this->db->delete("tbl_booster", array("booster_id" => $param['booster_id']));

			if($delete){
				$dataArray ['results']['status_request'] = "OK";
				$dataArray ['results']['msg'] = "Success";
				$this->m_api->sendOutput( $dataArray, 200 );
			}else{
				$dataArray ['results']['status_request'] = "NOT_OK";
				$dataArray ['results']['msg'] = "Failed";
				$this->m_api->sendOutput( $dataArray, 200 ); 
			}
		} else {
			$this->m_api->sendOutput ( $dataArray, 402 ); 
		}
	}

	function updateBooster(){
		$dataArray = array ( 
				'pic' => 'Floyd' 
		);
	
		$param = array(
			'booster_id' => $this->input->post("booster_id"),
			'booster_name' => $this->input->post("booster_name"),
			'booster_phone' => $this->input->post("booster_phone"),
		);
		
		$check_require = $this->m_api->requireValidation( $param );
		if ($check_require ['status'] == true) {

			$data = $this->db->update("tbl_booster", $param, array("booster_id" => $param['booster_id']));

			if($data){
				$dataArray ['results']['status_request'] = "OK";
				$dataArray ['results']['msg'] = "Success";
				$this->m_api->sendOutput( $dataArray, 200 );
			}else{
				$dataArray ['results']['status_request'] = "NOT_OK";
				$dataArray ['results']['msg'] = "Failed";
				$this->m_api->sendOutput( $dataArray, 200 ); 
			}
		} else {
			$this->m_api->sendOutput ( $dataArray, 402 ); 
		}
	}
	
	function tambahBooster(){
		$dataArray = array ( 
				'pic' => 'Floyd' 
		);
	
		$param = array(
			'booster_name' => $this->input->post("booster_name"),
			'booster_phone' => $this->input->post("booster_phone"),
			'id_user' => $this->input->post("id_user"),
		);
		
		$check_require = $this->m_api->requireValidation( $param );
		if ($check_require ['status'] == true) {

			$data = $this->db->insert("tbl_booster", $param);

			if($data){
				$dataArray ['results']['status_request'] = "OK";
				$dataArray ['results']['msg'] = "Success";
				$this->m_api->sendOutput( $dataArray, 200 );
			}else{
				$dataArray ['results']['status_request'] = "NOT_OK";
				$dataArray ['results']['msg'] = "Failed";
				$this->m_api->sendOutput( $dataArray, 200 ); 
			}
		} else {
			$this->m_api->sendOutput ( $dataArray, 402 ); 
		}
	}
	
	function testAPI(){
	    echo "hahah";
	}
	
}