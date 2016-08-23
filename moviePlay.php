<?php
	@include("Update.php");
	@include("Client.php");
	@include("ToFile.php");
	@include("Count.php");

	$update = new Update();
	$client = new Client();
	$count = new Count();
    $tofile = new ToFile();

    $tofile -> file();
	$cliInfo = $client->cliInfo();
	$appendArray = array('id' => $cliInfo['id'],
						 'name' => $cliInfo['name'],
						 'count' => '1',
						 'os' => $cliInfo['os'],
						 'browser' => $cliInfo['browser']);

	$count-> append($appendArray, "resource/json/pvlist-mac-time");

    $count-> update(array($update, "updateLine"),
     							array($cliInfo['id'], "count", "resource/json/pvtotal-mac-time"));

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<title>Document</title>
</head>
<body>
<div style="width:96%; height:auto; margin:0 auto; margin-bottom:20px; margin-top:30px;">
    <video src="/resource/movie/amfy/amfy.mp4" autoplay controls style='width:100%;'></video>
</div>
</body>
</html>
