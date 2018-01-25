<?php 

namespace App\Helper;

class Translator{

	protected $language;
	protected $apikey;
	protected $appid;
	protected $domain;
	protected $api_url;
	public function __construct(){
		$this->language = 	'assamese'; // assamese //hindi
		$this->apikey    =  "qtahG7bDh1DKzUZGoI0geRU6o6gPCeEjgRMf";
		$this->appid     =  "rev.web.kibakibi";
		$this->domain    =  "e-commerce";
		$this->api_url   =  "http://demo.reverieinc.com/parabola/localizeObject";
	}

	public function translate($dataArr = [],$language = null){

		if(!isset($language)){
			$language = $this->language;
		}

		$dataSet 		= '';
		$preseperater 	= '';

		foreach($dataArr as $arrVal){
			$dataSet 	.= $preseperater.'{"attr":"'.$arrVal['productid'].'","value":"'.$arrVal['productname'].'"}';
			$preseperater = ',';
		}

		$data = '{ "apikey":"'.$this->apikey.'", "appid":"'.$this->appid.'", "domain":"'.$this->domain.'", "localization":false, "tlang" : ["'.$language.'"], "locnum":true, "data":[['.$dataSet.']] }'; //{"attr": "23","value": "Prashant"},{"attr": "23","value": "Prashant"}

		$url = $this->api_url;

		$headers = array(
			'Content-Type: application/json; charset=UTF-8',
			'Accept : application/json');

		$curl = curl_init();

		curl_setopt($curl, CURLOPT_URL, $url);

		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');

		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

		curl_setopt($curl, CURLOPT_ENCODING ,"");

		$response = json_decode(curl_exec($curl));

		curl_close($curl);

		return $response;
	}
}