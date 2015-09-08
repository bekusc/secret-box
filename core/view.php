<?php namespace core;

class View
{
    public function __construct($path) {
        $this->path = $path;
    }

    public function display($name, $data = []) {

    	$path = $this->path . $name.'.php';

        if(file_exists($path)){
            extract($data);
            return require_once ($path);
        }
        
        throw new Exception("View does not exist: " . $path);
    }

}