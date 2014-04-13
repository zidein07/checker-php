<?php
require_once "../vendor/autoload.php";
require_once "Checker.php";

$code = new Checker(array(
    "url" => "http://code.tutsplus.com/",
    "tmpPath" => "tmp",
    "tmpName" => "code.txt",
    "htmlNode" => ".posts__post-title",
    "email" => array(
        "dev@vld.me",
        "zidein07@gmail.com",
    ),
));
