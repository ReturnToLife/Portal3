<?php

include_once('conf.php');

$bdd = new PDO('mysql:host='.$return_mysql_host.';dbname='.$return_mysql_dbname,
	       $return_mysql_login, $return_mysql_pass);
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
