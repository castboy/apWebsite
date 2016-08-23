<?php
	include("./Client.php");

		function mylog($file, $content) {
                	// file_put_contents('resource/json/' . $file, $content . "\n", FILE_APPEND);
                }

                function cutCrlf($s) {
                	$len = strlen($s);

                	return substr($s, 0, $len-1);
                }

		function isAuthed ($ip) {
			$shell = "sudo /bin/bash isAuthed.sh $ip";

			$code = cutCrlf(shell_exec($shell));

			mylog('test.txt', 'beauth return ' . $code);
			mylog('test.txt', 'beauth begin');
			mylog('test.txt', strval('0' == $code));
			mylog('test.txt', 'beauth end');

			return '0' == $code;
		}

		function macFreeAuth ($ip) {
			$shell = "sudo /bin/bash umsc_sms.sh macfreeauth 1 $ip";

			$code = cutCrlf(shell_exec($shell));

			mylog('test.txt', 'macfreeauth return ' . $code);
			mylog('test.txt', 'macfreeauth begin');
			mylog('test.txt', strval('0' == $code));
			mylog('test.txt', 'macfreeauth end');
			return '0'==$code?0:1;
		}

		$detail = new Client();
		$ip = $detail->getIp();
		$mac = $detail->getMac($ip);

		if (isAuthed($ip) || 0==macFreeAuth($ip)) {
			mylog('test.txt', 'is authed or macfreeauth ok');
			echo "1";
		} else {
			mylog('test.txt', 'not authed and macfreeauth failed');
			echo "not-authed";
		}
