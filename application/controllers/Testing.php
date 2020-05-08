<?php
class Testing extends CI_Controller {

        public function index($username,$targetphone){
                // username
                $name = $username;
                
                // target phone
                $phone = $targetphone;
                
                // message content
                $body = "Ayo beri semangat ke ".$username." agar menyelesaikan dietnya!";
                
                //API Url
                $url = 'https://api.chat-api.com/instance124675/sendMessage?token=3vgm04ijj25xy7kh';
                 
                //Initiate cURL.
                $ch = curl_init($url);
                
                //The JSON data.
                $jsonData = array(
                    'phone' => $phone,
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
                $result = curl_exec($ch);
        }
}