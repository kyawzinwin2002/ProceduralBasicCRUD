<?php

require_once("functions.php");

if($_SERVER["REQUEST_METHOD"] === "DELETE"){
    delete(RECORD_DIR,"name");
}