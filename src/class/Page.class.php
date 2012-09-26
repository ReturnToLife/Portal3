<?php

namespace Page;

function	getPage()
{
  // todo: here you can put some url rewriting treatment
  return (empty($_GET['p']) ? 'home' : $_GET['p']);
}

function	view($page)
{
  \View\view('header');
  if (pageExists($page))
    \View\view('page_'.$page);
  else
    \View\view('error', 404);
  \View\view('footer');
}

function	pageExists($page)
{
  return \View\viewExists('page_'.$page);
}

function	getURL($params) // array string => string
{
  $args = array();
  foreach ($_GET as $key => $value)
    $args[$key] = $value;
  foreach ($params as $key => $value)
    $args[$key] = $value;
  $url = '?';
  foreach ($args as $key => $value)
    $url .= $key.'='.$value.'&';
  return ($url);
}
