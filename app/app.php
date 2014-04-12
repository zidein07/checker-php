<?php
require_once "../vendor/autoload.php";
require_once "CheckWinning.php";

$code = new CheckWinning(array(
    "url" => "http://code.tutsplus.com/",
    "tmpName" => "code",
    "htmlNode" => ".posts__post-title",
    "email" => array(
        "dev@vld.me",
        "zidein07@gmail.com",
    ),
));