<?php

//spl_autoload_extensions(".php");
spl_autoload_register();

use Adelina\Tools\Template;
use Adelina\Tools\Config;

$template = new template();

$config = new Config("config/config.ini");