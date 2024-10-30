<?php


class httpclient
{

	public $port = 80;
	public $host = "www.knewthenews.com";
	public $auth_header = "";
	
	
	public $debug = false;
	
	public function __construct($auth_header = "")
	{
		if (!empty($auth_header))
			$this->auth_header = $auth_header;
	}
	
		
	public function getFromHost($path)
	{
	
		$fp = fsockopen($this->host, $this->port, $errno, $errstr);
	
	    $this->puts($fp, "GET http://" . $this->host . "/svc/ext" . $path . " HTTP/1.0\n");
	    $this->puts($fp, "Host: " . $this->host . "\n");
		
		$this->putHeaders($fp);
	
	    $this->puts($fp, "\n");
	
		if ($this->debug)
			return;
		
		$lines = array();
	
		$res = $this->readResponse($fp);
		
	    fclose($fp);
	
		return $res;
		
	}
	
	public function postToHost($path, $data)
	{
	    $fp = fsockopen($this->host, $this->port, $errno, $errstr);
	    
	    $this->puts($fp, "POST /svc/ext" . $path . " HTTP/1.0\n");
	    $this->puts($fp, "Host: " . $this->host . "\n");
	 	
		$this->putHeaders($fp);
	    
		if ($this->debug)
			return;
		
		$bo = "-----------------------------305242850528394";
	 
		$this->puts($fp, "Content-type: multipart/form-data; boundary=$bo\n");
	
		$content = "";
	
		$data = $this->getdatalines($data);
	    foreach ($data as $key => $val) {
	        $content .= sprintf("--%s\nContent-Disposition: form-data; name=\"%s\"\n\n%s\n", $bo, $key, $val);
	    }
		
	    $length = strlen($content) + strlen($bo) + 3;
		
	    $this->puts($fp, "Content-length: $length \n");
	    $this->puts($fp, "\n");
	 
	    $this->puts($fp, $content);
	
	    $this->puts($fp, "--".$bo."--\n");
	 
		$res =  $this->readResponse($fp);
	
	    fclose($fp);
	
	    return $res;
	}
	
	private function puts($fp, $text) 
	{
		fputs($fp, $text);
		if ($this->debug)
			print $text;
	}
	
	private function readResponse($fp)
	{
			
	    while(!feof($fp)) 
		{
	        $char = fread($fp, 1);
			if ($char == "\n")
			{
				$lines[] = $line;
				$line = "";
			}
			else if ($char != "\r")
			{
				$line .= $char;	
			}
	    }
		
		if ($line)
			$lines[] = $line;
		
		$body = array();
		$isbody = false;
		foreach ($lines as $line) {
			if (empty($line)) {
				$isbody = true;
			}
			else if ($isbody){
				$body[] = $line;	
			}
		}
				
		return implode("\n", $body);
	
	}
	
	private function putHeaders($fp) 
	{
		
		$this->puts($fp, "User-Agent: KnewTheNews-WordPress-Proxy\n");
	    $this->puts($fp, "Accept: text/html,application/xhtml+xml,application/xm, image/gif, image/x-xbitmap, image/jpeg, image/pjpeg, image/png, */*\n");
	    $this->puts($fp, "Accept-Charset: iso-8859-1,*,utf-8\n");
	    $this->puts($fp, "Cache-Control: no-cache\n");
	    $this->puts($fp, "Pragma: no-cache\n");
		if (!empty($this->auth_header))
			$this->puts($fp, "Authorization: " . $this->auth_header . "\n");
	   //puts($fp, "Referer: $referer\n");
	 
	}
	
	private function getdatalines($data) 
	{
		$result = array();
		foreach($data as $k => $v) {
			if (is_array($v)) {
				$array = $this->getarraydatalines($k, $v);
				$result = array_merge($result, $array);
			}
			else {
				$result[$k] = $v;
			}
		}
		return $result;
	}
	
	private function getarraydatalines($prefix, $array) 
	{
		$result = array();
		foreach($array as $k => $v) {
			if (is_array($v)) {
				$array = $this->getarraydatalines($prefix . "[" . $k . "]", $v);
				$result = array_merge($result, $array);
			}
			else {
				$result[$prefix . "[" . $k . "]"] = $v;
			}
		}	
		return $result;
	}

}