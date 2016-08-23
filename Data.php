
<?php
	class Data
	{
		function dirArr($path,&$arr)
		{
		    $dir = opendir($path);
		    while(($file=readdir($dir))!==FALSE)
		    {
		        if($file!='.'&&$file!='..')
		        {	           
		            if(!is_dir($path.'/'.$file))
		            {
		                $arr[] = $file;
		            }
		            else
		            {                 
		                $this->dirArr($path.'/'.$file, $arr[$file]);
		            }
		        }
		    }
		}

		function jsArr ($oldArray, $imgOpts, $resOpts, $path) {
			$n = 0;
			foreach ($oldArray as $key => $value) {
				$jsArr[$n]["id"] = "$key"; 
				foreach ($value as $key1 => $value1) {
					$ext = @end(explode(".", $value1));
					if (in_array($ext, $imgOpts)) {
						$jsArr[$n]["image"]= "$key/$key.$ext";
					} elseif (in_array($ext, $resOpts)) {
						$jsArr[$n]["resource"]= "$key/$key.$ext";
					} elseif ($ext == "txt") {
						$jsArr[$n]["name"]= file_get_contents($path . "$key/$key.$ext");
					} else {
                        $jsArr[$n]["priority"]= file_get_contents($path . "$key/priority");
                    }
				}
                if (empty($jsArr[$n]["priority"]) && (@$jsArr[$n]["priority"] != "0")) {
                    $jsArr[$n]["priority"]= "100";
                }
				$n++;
			}    

            for ($i = 0; $i < $n - 1; $i++) {
                for ($j = 0; $j < $n - 1 - $i; $j++) {
                   if($jsArr[$j]["priority"] > $jsArr[$j+1]["priority"])
                        {
                            $temp = $jsArr[$j];
                            $jsArr[$j] = $jsArr[$j+1];
                            $jsArr[$j+1] = $temp;
                        }                 
                }
            }
            
			return $jsArr;
		}

		function countArr ($oldArray) {
			foreach ($oldArray as $key => $value) {
				$countArr[$key]["id"] = $value["id"];
				$countArr[$key]["name"] = $value["name"];
				$countArr[$key]["count"] = 0;
			}

			return $countArr;
		}

		function tempojsJson ($array, $item) {
		    $jsonString = @json_encode($array, JSON_UNESCAPED_UNICODE);
		    $jsonString = str_replace("},", "},\n", $jsonString);
		    
		    return "var $item = { \n\"$item\": $jsonString \n};";      			
		}	

		function countJson ($array) {
			$jsonString = @json_encode($array, JSON_UNESCAPED_UNICODE);

			return str_replace("},", "}\n", substr($jsonString, 1, -1));
		}	

		function toFile ($file, $content) {
			file_put_contents($file, $content);
		}
        
        function build ($category, $countFile, $filter, $path) {
            $this -> dirArr("./resource/$category", $dirArr);
            $array = $this->jsArr($dirArr, $filter['image'],
            							 $filter['resource'], $path);
            $countArr = $this->countArr($array);
            
            $this -> toFile("resource/json/$category.json",
                            $this->tempojsJson($array, $category));
            $this -> toFile($countFile, $this -> countJson($countArr));  
            
        }
        
	}

?>
