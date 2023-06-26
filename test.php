<?php

require("functions.php");

scanFolder(RECORD_DIR);

$data = ["a" => "aa","b" => "bb"];
$dataTwo = "hello";
dd($data,true);
dd($dataTwo);