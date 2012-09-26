<?php

function	model_admin_getpage($menu)
{
  if (!isset($_GET['admin']))
    return ('home');
  if (!array_key_exists($_GET['admin'], $menu))
    return ('error');
  return ($_GET['admin']);
}

function	model_admin_getmenu()
{
  global	$lang;
  return (array(
		'home' => array('name' => $lang->msg('title_home'),
				'url' => \Page\getUrl(array('admin' => 'home'))),
		'casts' => array('name' => 'Casts',
				 'url' => \Page\getUrl(array('admin' => 'casts'))),
		));
}

function	model_admin_getpageinfo($page) // string
{
  global	$def_model_dir;
  $filename = $def_model_dir.'/admin/'.$page.'.php';
  if (!file_exists($filename))
    throw new Exception('model admin not found');
  include_once($filename);
  $fun  ='model_admin_'.$page;
  if (!function_exists($fun))
    throw new Exception('model admin function not found');
  return ($fun());
}

function	model_admin()
{
  $args[noheader] = true;
  $args[menu] = model_admin_getmenu();
  $args[page] = model_admin_getpage($args[menu]);
  $args[info] = model_admin_getpageinfo($args[page]);
  return ($args);
}

