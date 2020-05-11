<?php
/*
Plugin Name: Hello World
Description: ecrit Hello World
Author: Martine
Version: 1.0
*/
class HelloWorld_Plugin{
public function __construct(){
include_once plugin_dir_path(__FILE__).'/helloClass.php';
new HelloClass();
}
}
new HelloWorld_Plugin();