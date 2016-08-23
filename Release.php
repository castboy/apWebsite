<?php
    include("./Client.php");

    function Free ($mac) {
        $shell = "sudo /bin/bash userauth 1 $mac";
        $code = cutCrlf(shell_exec($shell));

        return $code;
    }

    $detail = new Client();
    $ip = $detail->getIp();
    $mac = $detail->getMac($ip);

    Free($mac);
    echo '1';
