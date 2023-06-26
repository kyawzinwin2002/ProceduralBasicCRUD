<?php

require_once("globals.php");

if(!is_dir(RECORD_DIR)){
    mkdir(RECORD_DIR);
};
if (!is_dir(PHOTO_DIR)) {
    mkdir(PHOTO_DIR);
};
die();