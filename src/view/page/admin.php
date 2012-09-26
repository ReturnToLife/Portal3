<?php

function	view_admin_header()
{
  global	$lang;
  echo '<div class="header">';
  echo '  <div class="name"><h2>return (to_life);</h2>';
  echo '<h3>/* ',$lang->msg('slogan'),' */</h3>';
  echo '</div>';
  echo '<img src="img/interface/logo_mini.png" />';
  echo '  <h1>',$lang->msg('title_admin'),'</h1>';
  echo '</div>';
}

function	view_admin_menu($args)
{
  global	$lang;
  echo '<div class="menu">';

  foreach ($args['menu'] as $info)
    echo '<a href="',$info['url'],'"><div class="button">', $info['name'],'</div></a>';
  echo '</div>';
}

function	view_admin_page($args)
{
  global	$def_page_dir;
  $filename = $def_page_dir.'/admin/'.$args['page'].'.php';
  if (!file_exists($filename))
    throw new Exception('admin page not found');
  echo '<div class="page">';
  include_once($filename);
  $fun = 'view_admin_'.$args['page'];
  if (!function_exists($fun))
    throw new Exception('admin view function not found');
  $fun($args[info]);
  echo '</div>';
}

function	view_page_admin($args)
{
  echo '<div id="admin">';
  view_admin_header();
  view_admin_menu($args);
  view_admin_page($args);
  echo '</div>';
}
