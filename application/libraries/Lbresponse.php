<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Lbresponse {
	private $api_key = "";
	private $wa_number = "";
	private $gateway_url = "http://apirest.whatsap-api.online/api/gateway/";

    function __construct($params){
        $this->CI =& get_instance();
        $this->api_key = $params['api_key'];
        $this->wa_number = $params['wa_number'];
    }

    
    function sendwa($data){
   //  	$sendArray = array(
			// "to_number" => $data->from_number,
			// "to_msg"    => $data->message,
   //  	);

    	$sendArray = $data;
    	$send = json_encode($sendArray);
    	$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL            => $this->gateway_url."sendmsg",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING       => "",
			CURLOPT_MAXREDIRS      => 10,
			CURLOPT_TIMEOUT        => 30,
			CURLOPT_CUSTOMREQUEST  => "POST",
			CURLOPT_POSTFIELDS     => json_encode($sendArray),
			CURLOPT_HTTPHEADER     => array(
				"cache-control: no-cache",
				"content-type: application/json",
				"Erizky-Key: ".$this->api_key 
			),
		));

		$response = curl_exec($curl);		
		$err      = curl_error($curl);
		curl_close($curl);
		if ($err) {
			// $this->CI->db->update("inbox_outbox",array("status" => 3), array("id" => $data->id));
			return false;
		} else {
			$response = json_decode($response);			
			if ($response->status == "OK") {
				return true;
			}else{
				return false;		
			}
		}
    }

    function get_status(){
    	$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => $this->gateway_url."status_login",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
		    "Content-Type: application/json",
		    "Erizky-Key: ".$this->api_key,
		    "Postman-Token: 57931f50-469f-43df-baba-cdde3428b468",
		    "cache-control: no-cache"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  return false;
		} else {
			// return $response." ".$this->api_key;
  			$response = json_decode($response);			
			if ($response->status == "OK") {
				return $response;			
			}else{
				return false;		
			}
  		}
    }

    function update_profile($data){
    	//contoh array 
    	// {"wa_number":"6289668274305","pic_email":""}
    	$sendArray = $data;

    	$send = json_encode($sendArray);
    	$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL            => $this->gateway_url."update_profile",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING       => "",
			CURLOPT_MAXREDIRS      => 10,
			CURLOPT_TIMEOUT        => 30,
			CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST  => "POST",
			CURLOPT_POSTFIELDS     => $send,
			CURLOPT_HTTPHEADER     => array(
				"cache-control: no-cache",
				"content-type: application/json",
				"erizky-key: ".$this->api_key
			),
		));

		$response = curl_exec($curl);		
		$err      = curl_error($curl);
		curl_close($curl);
		if ($err) {
			// $this->CI->db->update("inbox_outbox",array("status" => 3), array("id" => $data->id));
			return false;
		} else {
			$response = json_decode($response);			
			if ($response->status == "OK") {
				return true;
			}else{
				return false;		
			}
		}
    }

    function request_login(){
    	$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => $this->gateway_url."request_login?nowa=".$this->wa_number,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
		    "Content-Type: application/json",
		    "Erizky-Key: ".$this->api_key,
		    "Postman-Token: 98ee9aef-6606-4730-b397-29553f925966",
		    "cache-control: no-cache"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);
		
		if ($err) {
		  return false;
  		} else {
		  	$response = json_decode($response);			
			if ($response->status == "OK") {
				return $response->url_login;
			}else{
				return false;		
			}
		}

    }

    
	function replaceMessage($searchArray, $replaceArray, $text){
		$message    = str_replace($searchArray, $replaceArray, $text);
		return $message;
	}

	function bulan_indonsia($bulan){
		if($bulan < 10){
			$bulan = "0".$bulan;
		}

		if ($bulan == "01") {
			$return = "JANUARI";
		}elseif($bulan == "02"){
			$return = "FEBRUARI";
		}elseif($bulan == "03"){
			$return = "MARET";
		}elseif($bulan == "04"){
			$return = "APRIL";
		}elseif($bulan == "05"){
			$return = "MEI";
		}elseif($bulan == "06"){
			$return = "JUNI";
		}elseif($bulan == "07"){
			$return = "JULI";
		}elseif($bulan == "08"){
			$return = "AGUSTUS";
		}elseif($bulan == "09"){
			$return = "SEPTEMBER";
		}elseif($bulan == "10"){
			$return = "OKTOBER";
		}elseif($bulan == "11"){
			$return = "NOVEMBER";
		}elseif($bulan == "12"){
			$return = "DESEMBER";
		}
		return $return;
	}
}