<?php	
	
	include("Data.php");

    $data = new Data();
	$filter = array('image' => array("jpg", "png", "gif"),
					'resource' => array("mp4", "3gp", "avi", "rmvb", "flv", "apk"));

    $data -> build("movie", "resource/json/pvtotal-mac-time", $filter, "resource/movie/");
    $data -> build("app", "resource/json/app_pvtotal-mac-time", $filter, "resource/app/");
