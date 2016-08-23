<?php
	class ToFile {

		function isExist ($directory, $strInName) {
			$files = scandir($directory);
			foreach ($files as $key => $value) {
				if (strpos($value, $strInName) !== false) return true;
			}

			return false;
		}

		function create ($directory, $name) {

			return fopen($directory . $name, "w+");
		}

		function file () {
			date_default_timezone_set('PRC'); 
			$date = date("y-m-d",time());

			if (! $this->isExist("resource/json/", $date)) {
				$this -> create("resource/json/", "pvlist-$mac-$date");
			}
		}

	}

