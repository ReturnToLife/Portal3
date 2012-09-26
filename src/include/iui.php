<?php

include_once('conf.php');
include_once($iui_path);

$iui = new IonisInfo($iui_mysql_login,
                     $iui_mysql_pass,
                     $iui_mysql_dbname,
                     $iui_login,
                     $iui_unix_pass,
                     $iui_absolute_path_local_files,
                     $iui_afs,
                     $iui_ppp_pass);

