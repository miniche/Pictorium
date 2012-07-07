<?php

//spl_autoload_extensions(".php");
spl_autoload_register();

use Adelina\Tools\Template;
use Adelina\Tools\Config;

$template = new Template("templates");

$config = new Config("config/config.ini");

// We load the main page.
$template->setFilenames(array("INDEX" => "index.tpl"));

$template->assignVar("PAGE_TITLE", $config->getValue("general", "name") ." - Loading...");
$template->assignVar("APPLICATION_NAME", $config->getValue("general", "name"));

$template->pparse("INDEX");

