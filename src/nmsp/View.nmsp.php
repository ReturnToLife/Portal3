<?php

namespace View;

foreach (glob($def_view_dir."*.php") as $filename)
  include_once $filename;

function	view($function_name, $args = 0)
{
  global	$views;

  $function_name = 'view_'.$function_name;
  if (!function_exists($function_name))
    throw new \Exception('View Function does not exists!');
  $function_name($args);
}

function	viewExists($function_name)
{
  return (function_exists('view_'.$function_name));
}

function	getPage()
{
  // todo: here you can put some url rewriting treatment
  return (empty($_GET['p']) ? 'home' : $_GET['p']);
}

function	viewPage($page, $arg = 0)
{
  if (!isset($arg[noheader]))
    \View\view('header');
  if (pageExists($page))
    \View\view('page_'.$page, $arg);
  else
    \View\view('error', 404);
  \View\view('footer');
}

function	pageExists($page)
{
  global	$def_page_dir;
  $path = $def_page_dir.$page.'.php';
  if (!file_exists($path))
    return (false);
  include_once($path);
  return \View\viewExists('page_'.$page);
}

function	modelPage($page)
{
  global	$def_model_dir;
  $filename = $def_model_dir.$page.'.php';
  if (!file_exists($filename))
    return (0);
  include_once($filename);
  $function = 'model_'.$page;
  if (!function_exists($function))
    return (0);
  return ($function());
}
