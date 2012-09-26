<?php

include_once('src/include/def.php');
include_once($def_include_dir.'iui.php');
include_once($def_include_dir.'bdd.php');
include_once($def_include_dir.'lang.php');
include_once($def_class_dir.'Portal.class.php');

session_start();

$portal = new Portal;
$portal->run();

