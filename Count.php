<?php
	class Count
	{

	    function append ($array, $file) {

	    	$appendString = @json_encode($array, JSON_UNESCAPED_UNICODE) . "\n";
	    
	    	file_put_contents($file, $appendString, FILE_APPEND);

	    }

	    function update ($funcName, $funcParams) {

	    	$newString = call_user_func_array($funcName, $funcParams);

	    	file_put_contents($funcParams[2], $newString);

	    }

	}

?>
	
	