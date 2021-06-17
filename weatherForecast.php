<?php
class weather {

    //https://github.com/TomLany/NOAA-Weather-Grabber darmowy skrypt z pogodą
 
	private $params = array();
	private $file;
	private $xml;
	private $unit;
 
	private $info = array(
		'title'=>'title',
		'units'=>'yweather:units',
		'wind'=>'yweather:wind',
		'atmosphere'=>'yweather:atmosphere',
		'astronomy'=>'yweather:astronomy',
		'conditions'=>'item/yweather:condition',
		'time'=>'item/title',
		'forecast'=>'item/yweather:forecast'
	);
 
	private $values = array();
 
	public function __construct() {
	}
 
	public function set__($var,$val) {
		$this->{$var} = $val;
	}
	public function get__($var) {
		return $this->{$var};
	}
 

		// Ponbranie i przeróbka pliku, uniezależnia od url file access disabled

	public function get_xml() {
		$f = @fsockopen('xml.weather.yahoo.com', 80, $errno,$errstr,30);
		$output = array();
		if($f) {
			$dane = '';
			$out = "GET /forecastrss?p=$this->city&u=$this->unit HTTP/1.1r\n";
			$out .= "Host: $this->linkr\n";
			$out .= "Connection: Closer\nr\n";
			fwrite($f,$out);
			while(!feof($f)) {
				$dane .= fgets($f,128);
			}
			fclose($f);
		}
		//pozbycie się nagłówków HTTP z odpwiedzi serwera 
		preg_match('#<?xml(.*)</rss>#is',$dane,$output);
		$this->file = $output[0];
	}
 
	public function set_params() {
		$this->xml = simplexml_load_string($this->file);
		foreach($this->info as $key=>$val) {
			$this->params[$key] = $this->xml->xpath('//channel/'.$val);
		}
	}
 
	public function set_values() {
		foreach($this->params as $key=>$val) {
			if($key != 'forecast') {
				if(array_key_exists('@attributes',$val[0])) {
					foreach($val[0]->attributes() as $bkey=>$bval) {
						$this->values[$key][$bkey] = (string)$bval;
					}
				} else {
					$this->values[$key] = (string)$val[0];
				}
			}
		}
		$this->set_forecast();
	}
 
 

		// Pogoda na pozniejsze godziny aktualnego dnia i na nastepny dzien

	private function set_forecast() {
		foreach($this->params['forecast'][0]->attributes() as $key=>$val) {
			$this->values['forecast']['today'][$key] = (string)$val;
		}
		foreach($this->params['forecast'][1]->attributes() as $key=>$val) {
			$this->values['forecast']['tomorrow'][$key] = (string)$val;
		}
	}
}
?>