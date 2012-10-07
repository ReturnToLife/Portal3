<?php

global $def_nmsp_dir;
include_once($def_nmsp_dir.'Portal.nmsp.php');

function	view_admin_casts_menu($title = '') {
  global	$lang;
  $buttons = array(
		   'view' => array('title' => $lang->msg('my').'Casts',
			       'url' => \Page\getUrl(array('cast' => 'view'))),
		   'browse_all' => array('title' => $lang->msg('browse_all'),
			       'url' => \Page\getUrl(array('cast' => 'browse_all'))),
		   'add' => array('title' => $lang->msg('add').' Cast',
			       'url' => \Page\getUrl(array('cast' => 'add'))),
		   'del' => array('title' => $lang->msg('del').' Cast',
			       'url' => \Page\getUrl(array('cast' => 'del'))),
		   'addmember' => array('title' => $lang->msg('add').' '.$lang->msg('member'),
			       'url' => \Page\getUrl(array('cast' => 'addmember'))),
		   'delmember' => array('title' => $lang->msg('del').' '.$lang->msg('member'),
			       'url' => \Page\getUrl(array('cast' => 'delmember'))),
		   );
  echo '<ul class="nav nav-tabs">';
  foreach ($buttons as $key => $button)
    echo '<li', ($key == $title ? ' class="active"' : ''),
    '><a href="', $button['url'],'">',$button['title'],'</a></li>';
  echo '</ul>';
  if (!empty($title))
    echo '<div class="page-header"><h1>', $buttons[$title]['title'],'</h1></div>';
  // echo '<div class="submenu">';
  // foreach ($buttons as $name => $url)
  //   echo '<a href="',$url,'"><span class="btn btn-large button">',$name,'</span></a>';
  // echo '</div>';
}

function	display_cast($cast /* object */) {
  $color = \Portal\getColorFromCateg($cast->getFirstParentName());
  echo '<div class="well cast bg_', $color,' border_', $color,'">';
  echo '<h3 class="color_', $color,'">', $cast->getName(), '</h3>';
  echo '<h6 class="color_', $color,'">', $cast->getParentsString(),'</h6>';
  print_members($cast->getMembers());
  echo '</div>';
}

function	view_admin_casts_view($info) {
  global $lang;
  if (empty($info['casts_view']['my_casts'])) {
    echo '<div class="alert alert-info">', $lang->msg('you_not_in_cast'),'</div>';
    return ;
  }
  foreach ($info['casts_view']['my_casts'] as $cast) {
    display_cast($cast, $info['casts']);
  }
}

function	aux_view_admin_casts_browse_all($cast) {
  $children = $cast->getChildren();
  if (!empty($children))
    foreach ($children as $cast) {
      $members = $cast->getMembers();
      $color = \Portal\getColorFromCateg($cast->getFirstParentName());
      echo '<button class="btn cent bottom color_', $color,' bg_', $color,'" onclick="show(\'cast_', $cast->getId(),
	'\'); return(false);">', $cast->getName(),'</button><br />';
      echo '<div class="dview" id="cast_', $cast->getId(),'">';
      $color = \Portal\getColorFromCateg($cast->getName());
      display_cast($cast);
      aux_view_admin_casts_browse_all($cast);
      echo '</div>';
    }
}

function	view_admin_casts_browse_all($info) {
  $cast = $info['casts']->getCast();
  aux_view_admin_casts_browse_all($cast);
}

function	print_members($members) {
  global $lang, $iui;
  if (empty($members)) {
    //    echo $lang->msg('emptycast');
    return ;
  }
  $by_line = count($members) > 12 ? 12 : 6;
  $i = 0;
  echo '<div class="row-fluid">';
  foreach ($members as $login) {
    if ($i && !($i % $by_line))
      echo '</div><div class="row-fluid">';
    echo '<div class="span', (12 / $by_line),' iui_thb">';
    //    echo '<img src="', $iui->getPhotoUrl($login, true), '" alt="', $login, '"/><br />';
    echo $iui->getName($login), '<br />';
    echo '(', $login, ')<br />';
    echo $iui->getPromo($login), ' - ', $iui->getCity($login), '<br />';
    echo '</div>';
    $i++;
  }
  echo '</div>';
}

function	view_admin_casts_add($info)
{
  global	$lang;
  \View\view('form_result', $info['casts_add']);
  \View\view('form', array(array('type' => 'select',
				 'label' => $lang->msg('admin_cast_addsublabel'),
				 'value' => $info['casts']->getPrintableArray(),
				 'selected' => intval($_POST['parent']),
				 'name' => 'parent'),
			   array('type' => 'text',
				 'label' => $lang->msg('name'),
				 'name' => 'name',
				 'value' => ''),
			   array('type' => 'submit',
				 'value' => $lang->msg('add'),
				 'name' => 'admin_cast_add')));
}

function	view_admin_casts_del($info)
{
  global	$lang;
  \View\view('form_result', $info['casts_del']);
  \View\view('form', array(array('type' => 'select',
				 'label' => $lang->msg('admin_cast_delsublabel'),
				 'value' => $info['casts']->getPrintableArray(),
				 'name' => 'cast'),
			   array('type' => 'single_check',
				 'label' => $lang->msg('confirm'),
				 'value' => true,
				 'name' => 'confirm'),
			   array('type' => 'submit',
				 'value' => $lang->msg('del'),
				 'name' => 'admin_cast_del')));
}

function	view_admin_casts_addmember($info)
{
  global	$lang;
  \View\view('form_result', $info['casts_addmember']);
  \View\view('form', array(array('type' => 'select',
				 'label' => $lang->msg('add').' '.$lang->msg('member'),
				 'value' => $info['casts']->getPrintableArray(),
				 'selected' => intval($_POST['cast']),
				 'name' => 'cast'),
			   array('type' => 'text',
				 'label' => 'Login',
				 'value' => '',
				 'name' => 'login'),
			   array('type' => 'submit',
				 'value' => $lang->msg('add'),
				 'name' => 'admin_cast_addmember')));  
}

function	view_admin_casts_delmember($info)
{
  global	$lang;
  \View\view('form_result', $info['casts_delmember']);
  \View\view('form', array(array('type' => 'select',
				 'label' => $lang->msg('del').' '.$lang->msg('member'),
				 'value' => $info['casts']->getPrintableArray(),
				 'selected' => intval($_POST['cast']),
				 'name' => 'cast'),
			   array('type' => 'text',
				 'label' => 'Login',
				 'value' => '',
				 'name' => 'login'),
			   array('type' => 'submit',
				 'value' => $lang->msg('del'),
				 'name' => 'admin_cast_delmember')));  
}

function	view_admin_casts_error($info)
{
  \View\view('error', 404);
}

function	view_admin_casts($info)
{
  $fun = 'view_admin_casts_'.$_GET['cast'];
  if (!function_exists($fun)) {
    $fun = 'view_admin_casts_error';
    view_admin_casts_menu();
  }
  else
    view_admin_casts_menu($_GET['cast']);
  $fun($info);
}
