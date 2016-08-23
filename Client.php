<?php
	class Client {
	    public function getOs () {

	   		if(!empty($_SERVER['HTTP_USER_AGENT'])){
				$OS = $_SERVER['HTTP_USER_AGENT'];
	      		if (preg_match('/win/i',$OS)) {
	     			$OS = 'Windows';
	    		}
	    		elseif (preg_match('/mac/i',$OS)) {
	     			$OS = 'MAC';
	    		}
	    		elseif (preg_match('/linux/i',$OS)) {
	     			$OS = 'Linux';
	    		}
	    		elseif (preg_match('/unix/i',$OS)) {
	     			$OS = 'Unix';
	    		}
	    		elseif (preg_match('/bsd/i',$OS)) {
	     			$OS = 'BSD';
	    		}
	    		else {
	     			$OS = 'Other';
	    		}
				return $OS;
	   		}
	   		else{
	   			return "unknow";
	   		}

	    }

	    public function getBrowser () {

			if(!empty($_SERVER['HTTP_USER_AGENT'])){
				$br = $_SERVER['HTTP_USER_AGENT'];
	    		if (preg_match('/MSIE/i',$br)) {
					$br = 'MSIE';
				}
				elseif (preg_match('/Firefox/i',$br)) {
	     			$br = 'Firefox';
	    		}
	    		elseif (preg_match('/Chrome/i',$br)) {
	     			$br = 'Chrome';
	       		}
	       		elseif (preg_match('/Safari/i',$br)) {
	     			$br = 'Safari';
	    		}
	    		elseif (preg_match('/Opera/i',$br)) {
					$br = 'Opera';
	    		}else {
					$br = 'Other';
	    		}
	    		return $br;
	   		}
	   		else{
	   			return "unknow";
	   		}

	    }

		function getIp () {

			$ip = $_SERVER["REMOTE_ADDR"];

			file_put_contents("resource/json/getip.txt", $ip, FILE_APPEND);

			return $ip;
		}


		function getMac ($ip) {

	        $mac = shell_exec("cat /proc/net/arp | grep " . $ip);
	        preg_match('/..:..:..:..:..:../',$mac , $matches);
	        @$mac = $matches[0];

	        file_put_contents("resource/json/getmac.txt", $ip . ':' . $mac, FILE_APPEND);

	        if (!isset($mac)) {
	                return;
	        }else {
	                return $mac;
	        }
		}

		function cliInfo () {

			$info = array('id' => $_REQUEST["id"],
						 'name' => urldecode($_REQUEST["name"]),
						 'resource' => $_REQUEST["resource"],
						 'os' => $this->getOs(),
						 'browser' => $this->getBrowser(),
						 'ip' => $this->getIp(),
						 'mac' => $this->getMac($this->getIp()));

			return $info;
		}

	}
