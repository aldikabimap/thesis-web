<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('m_login');
    }

    public function loginWhatsap(){
        $this->load->library('lbresponse',array('wa_number' => '6281386748587','api_key' => 'c1c425c59b91c7fbd5744d84e2f872717cd802aldika'));
        redirect($this->lbresponse->request_login());
    }
	
	public function index()
	{
        if(!empty($this->session->userdata('loginData'))){
            redirect('admin/dashboard');
        }
        $data['project_name'] = "Toko Beauty";
        $data['established'] = "2019";
        $this->load->view('member/Login',$data);
	}
		
	public function doLogin() {
        $dataPost = $this->input->post();
        if ($this->m_login->checkLogin($dataPost['username'], md5($dataPost['password']))) {
            redirect('admin/dashboard');  
        }else{
			$this->session->set_flashdata('GagalLogin', 'Ya');
            redirect('login');
        }
    }

    public function register()
    {
        if(!empty($this->session->userdata('loginData'))){
            redirect('admin/dashboard');
        }
        $data['project_name'] = "Toko Beauty";
        $data['established'] = "2019";
        $this->load->view('member/register',$data);
    }

    function log(){
        $this->session->unset_userdata('loginData');
        redirect('login');
    }
    function updateReminder(){
        $sql='select * from tbl_reminder';
        
        $q = $this->db->query($sql)->result();
        

        foreach($q as $k => $v){
            // echo $v->reminder_tgl."-".$v->reminder_result."<br>";
            $tgl = $v->reminder_tgl;
            $status = $v->reminder_result;
            $id = $v->reminder_id;
            $date1 = strtotime($tgl);
            $datenow = strtotime(date("Y-m-d"));  
            $days = ($datenow - $date1)/60/60/24;
            if($status == 0 && $days >= 31){
                echo $v->reminder_tgl."-".$v->reminder_result."<br>";
                $this->db->where('reminder_id', $id);
                $this->db->update('tbl_reminder', array('reminder_result'=>'1'));
            }
            
        }
        // print_r($reminder->reminder_tgl);
    }
    function checkTelat(){
        $dataCheck = $this->db->query("SELECT target_id, id_reminder, target_tgl,id_user
                                        FROM tbl_target
                                        inner join tbl_reminder on tbl_reminder.reminder_id = tbl_target.id_reminder
                                        WHERE target_id IN (
                                            SELECT MAX(target_id)
                                            FROM tbl_target
                                            GROUP BY id_reminder
                                        ) and reminder_result = '0'")->result();
        foreach ($dataCheck as $key => $value) {
            $date1 = strtotime($value->target_tgl);  
            $date2 = strtotime(date("Y-m-d"));  
              
            $days = ($date2 - $date1)/60/60/24;
            if ($days >= 2) {
                $dataTeman = $this->db->where('id_user',$value->id_user)->from('tbl_booster')->get()->result();
                $dataUser = $this->db->where('user_id',$value->id_user)->from('tbl_user')->get()->row();
                foreach ($dataTeman as $keyt => $valuet) {
                    echo $valuet->booster_phone.' '.$dataUser->name; 
                    $this->kirimWhatsApp2($valuet->booster_phone,$dataUser->name);
                }
            }
        }
    }

    public function kirimWhatsApp($no_telp,$nama_user){
        $userLogin = $this->session->userdata('loginUser');

        $rest = substr($no_telp, 0, 1);
        if ($rest == "0") {
            $no_telp = "62".substr($no_telp, 1);
        }
        // $sebesar = $jumlah;
        // $sebesar = number_format($sebesar,0,',','.');

        // $transaksi_no = $no_transaksi;

        $fieldWa = ["to_number"=>$no_telp,"to_msg"=>"Ayo semangatkan teman kk '".$nama_user."', agar menyelesaikan dietnya","media_url"=>""];

        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "http://apirest.whatsap-api.online/api/gateway/sendmsg",  CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => json_encode($fieldWa),
          CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
            "Erizky-Key: c1c425c59b91c7fbd5744d84e2f872717cd802aldika",
            "Postman-Token: 7e53f159-b144-448a-a225-8fdd0bf60989",
            "cache-control: no-cache"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          // echo "cURL Error #:" . $err;
        } else {
          // echo $response;
        }
        // die;
    }
    
    public function kirimWhatsApp2($no_telp,$nama_user){
        $userLogin = $this->session->userdata('loginUser');

        $rest = substr($no_telp, 0, 1);
        
        if ($rest == "0") {
            $no_telp = "62".substr($no_telp, 1);
        }
        
        $body = "Ayo beri semangat ke ".$nama_user." agar menyelesaikan dietnya!";
        
        //API Url
        $url = 'https://api.chat-api.com/instance124675/sendMessage?token=3vgm04ijj25xy7kh';

        //Initiate cURL.
        $ch = curl_init($url);

        //The JSON data.
        $jsonData = array(
            'phone' => $no_telp,
            'body' =>  $body
        );

         //Encode the array into JSON.
         $jsonDataEncoded = json_encode($jsonData);
                 
         //Tell cURL that we want to send a POST request.
         curl_setopt($ch, CURLOPT_POST, 1);
          
         //Attach our encoded JSON string to the POST fields.
         curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
          
         //Set the content type to application/json
         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 
          
         //Execute the request
        //  $result = curl_exec($ch);

        $response = curl_exec($ch);
        $err = curl_error($ch);

        curl_close($ch);

        if ($err) {
          // echo "cURL Error #:" . $err;
        } else {
          // echo $response;
        }
        // die;
    }
       
}
