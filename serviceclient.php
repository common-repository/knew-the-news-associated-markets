<?php

require_once("httpclient.php");

class serviceclient {
	
	public $httpclient;
	private $base_path = "/";
	private $auth_token;
	
	public function __construct($auth_header = "") 
	{
		$this->httpclient = new httpclient($auth_header);
	}
		
	public function authenticate($username, $password)
	{
		$xml = $this->get("auth.gettoken", array("username" => $username, "password" => $password));
		$xpath = new DOMXpath($xml);
		$this->auth_token = $xpath->query("//response[@success='true']/result")->item(0)->textContent;
		return !empty($this->auth_token);
	}
	
	public function get($methodname, $args = array())
	{	
		$params = array();
		if ($args) {
			foreach($args as $k => $v)
			$params[] = urlencode($k) . "=" . urlencode($v);
		}
		$path = $this->base_path . $methodname . "?auth_token=" . $this->auth_token . "&" . implode("&", $params);
		$content = $this->httpclient->getFromHost($path);
		$doc = new DOMDocument();
		$doc->loadXML($content);
		return $doc;
	}
	
	public function post($methodname, $data = array()) 
	{
		$content = $this->httpclient->postToHost($this->base_path . $methodname . "?auth_token=" . $this->auth_token, $data);
		$doc = new DOMDocument();
		$doc->loadXML($content);
		return $doc;
	}
	
}

?>