<?php

	include("./Client.php");

	function mylog($file, $content) {
		// file_put_contents('resource/json/' . $file, $content . "\n", FILE_APPEND);
	}

	function Register ($ip, $phoneNo) {
	        $shell = "sudo /bin/bash /usr/sbin/umsc_sms.sh register 1 $ip $phoneNo";
		mylog('test.txt', $shell);
	        return shell_exec($shell);
	}

	function Auth ($ip, $phoneNo, $sms_code) {
		$shell = "sudo /bin/bash /usr/sbin/umsc_sms.sh auth 1 $ip $phoneNo $sms_code";
		mylog('test.txt', $shell);
		return shell_exec($shell);
	}

	$phoneNo = $_POST["phoneNo"];
	mylog('test.txt', 'phoneNo=' . $phoneNo);

	$checkCode = $_POST["checkCode"];
	mylog('test.txt', 'checkCode=' . $checkCode);

	$detail = new Client();
	$ip = $detail->getIp();
	mylog('test.txt', 'ip=' . $ip);

	if ($phoneNo && $checkCode) {
		$err = Auth($ip, $phoneNo, $checkCode);
		if ($err) {
			echo "1";
		}else {
			echo "0";
		}
		mylog('test.txt', 'auth_err=' . $err);
	} else if ($phoneNo) {
		$err = Register($ip, $phoneNo);
		if ($err) {
			echo "1";
		}else {
			echo "0";
		}
		mylog('test.txt', 'register_err=' . $err);
	} else {
		mylog('test.txt', 'empty phoneNo/checkCode');
	}
