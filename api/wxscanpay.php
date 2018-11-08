<?php
$xml = file_get_contents("php://input",'r');
//file_put_contents('logs111.txt',$xml);
if($xml){
    //file_put_contents('logs.txt','Location: '.'../index.php?case=archive&act=notify&code=wxscanpay&xml='.base64_encode($xml));
    header('Location: '.'../index.php?case=archive&act=notify&code=wxscanpay');
    $data = array("xml" => base64_encode($xml));
    $data = http_build_query($data);
    $opts = array(
        'http'=>array(
            'method'=>"POST",
            'header'=>"Content-type: application/x-www-form-urlencoded\r\n".
                "Content-length:".strlen($data)."\r\n",
                //"Cookie: foo=bar\r\n" .
            'content' => $data,
        )
    );
    $cxContext = stream_context_create($opts);
    $sFile = file_get_contents("../index.php?case=archive&act=notify&code=wxscanpay", false, $cxContext);
    echo $sFile;
}