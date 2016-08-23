<?php
	class Update
	{
		function updateLine ($id, $key, $fileName) {
	    	$oldString = file_get_contents($fileName);
	    	$oldArray = explode("\n", $oldString);

	    	$newString = '';
	    	foreach ($oldArray as $Key => $value) {
	    		if (strpos($value, $id)) {
	    			$updateLineOldArray = json_decode($value, true);
	    			$updateLineOldArray[$key]++;
	    			$updateLineNewString = @json_encode($updateLineOldArray, JSON_UNESCAPED_UNICODE);
	    			$newString = $newString . $updateLineNewString . "\n"; 
	    		} else {
	    			$newString = $newString . $value . "\n";
	    		}
	    	}
	    	$newString = substr($newString, 0, -1);
	    	return $newString;
		}
	}

