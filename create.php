<?php

require_once("functions.php");

// print_r($_POST);

if($_SERVER["REQUEST_METHOD"] === "POST"){    
        $data = [
            "width" => $_POST["width"]."ft",
            "breadth" => $_POST["breadth"]."ft",
            "area" => area($_POST["width"],$_POST["breadth"])."sqft"
        ];
        if(!empty($_FILES) && $_FILES["photo"]["error"] === 0){           
                $data["pathInfo"] = url(upload(PHOTO_DIR, "photo"));            
        }
        addRecord($data,RECORD_DIR);    
        echo response($data);
}



