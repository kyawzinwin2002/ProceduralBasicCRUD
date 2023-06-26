<?php

require_once("globals.php");

function dd(mixed $data,bool $type=false):void
{
    if($type){
        var_dump($data);
    }else{
        if(is_array($data)){
            print_r($data);
        }else{
            echo $data;
        }
    }
};

function url(string $path):string{
    $url = $_SERVER["HTTPS"] ? "https" : "http";
    $url .= "://";
    $url .= $_SERVER["HTTP_HOST"];
    if(!empty($path)){
        $url .= "/";
        $url .= $path;
    }
    return $url;
}

function response(mixed $response,int $status=200):string
{
    header("Content-type:Application/json");
    http_response_code($status);
    if(is_array($response)){
        return json_encode($response);
    };
    return json_encode(["message" => $response]);
};

function area(float $width,float $breadth):float
{
    return $width * $breadth;
};

function extension(string $fileName):string
{
    return pathinfo($fileName)["extension"];
};

function randomFileName(string $ext):string
{
    return md5(uniqid()).".".$ext;
};

function addRecord(array $data,string $dir):void
{
    $fileName = randomFileName("json");
    $data["fileName"] = $fileName;
    $json = json_encode($data);
    $stream = fopen($dir . "/" . $fileName,"w");
    fwrite($stream,$json);
    fclose($stream);
};

function upload(string $dir,string $key):string
{   
    $extension = extension($_FILES[$key]["name"]);
    $fileName = randomFileName($extension);
    $newFileName = $dir."/".$fileName;
    move_uploaded_file($_FILES[$key]["tmp_name"],$newFileName);
    return $newFileName; 
}

function scanFolder(string $dir):string
{   
    header("Content-type:Application/json");
    $response = [];
    $files = scandir($dir);
    foreach ($files as $file) {
        if ($file != "." && $file != "..") {            
            $data = json_decode(file_get_contents($dir . "/" . $file), true);
            $response[] = $data;
        }
    };

    if($response === []){
        http_response_code(404);
        return json_encode(["message" => "Folder is empty!"]);
    };

    return json_encode($response);    
};

function delete(string $dir,string $key):void
{   
    header("Content-type:Application/json");
    if(file_exists($dir."/".$_GET[$key])){
        unlink($dir."/".$_GET[$key]);
        echo response("Deleted Successfully");
    }else{
       echo response("File Not Found",404);
    }
};

function detail(string $dir, string $key): void
{
    header("Content-type:Application/json");
    if (file_exists($dir . "/" . $_GET[$key])) {
        echo file_get_contents($dir."/".$_GET[$key]);        
    } else {
        echo response("File Not Found", 404);
    }
};