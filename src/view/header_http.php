<?php

function	view_header_http($args)
{
  global	$lang;
  echo '<!Doctype html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" > 
  <head> 
    <title>return (to_life); /* ',$lang->msg('slogan'),' */</title> 
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> 
    <meta http-equiv="Content-Language" content="fr" /> 
    <meta http-equiv="Content-Script-Type" content="text/javascript" /> 
    <meta http-equiv="Content-Style-Type" content="text/css" /> 
    <meta name="DC.Language" scheme="RFC3066" content="fr" /> 
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css" media="screen" title="Normal" /> 
    <link rel="stylesheet" href="bootstrap/css/bootstrap-responsive.min.css" type="text/css" media="screen" title="Normal" /> 
    <link rel="stylesheet" href="css/style.css" type="text/css" media="screen" title="Normal" />  
    <link rel="shortcut icon" href="fav.ico" /> 
  </head> 
  <body> 
    <div id="main">';
}
