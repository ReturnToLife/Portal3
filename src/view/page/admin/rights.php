<?php

function	view_admin_rights_menu($title = '') {
  global	$lang;
  $buttons = array(
		   'view' => array('title' => $lang->msg('my').$lang->msg('rights'),
				   'url' => \Page\getUrl(array('right' => 'view'))),
		   'add' => array('title' => $lang->msg('add').' '.$lang->msg('right'),
				  'url' => \Page\getUrl(array('right' => 'add'))),
		   'del' => array('title' => $lang->msg('del').' '.$lang->msg('right'),
				  'url' => \Page\getUrl(array('right' => 'del'))),
		   );
  echo '<ul class="nav nav-tabs">';
  foreach ($buttons as $key => $button)
    echo '<li', ($key == $title ? ' class="active"' : ''),
    '><a href="', $button['url'],'">',$button['title'],'</a></li>';
  echo '</ul>';
  if (!empty($title))
    echo '<div class="page-header"><h1>', $buttons[$title]['title'],'</h1></div>';
}

// available options = my, delete
function	view_admin_rights_view_table($casts_rights, $option = 'my') {
  global $lang;
  if (empty($casts_rights)) {
    view_alert($lang->msg('you_no_right'), 'info');
    return ;
  }
  echo '<table class="table table-striped table-hover table-bordered">';
  echo '<tr>',
    '<th>';
  echo 'This cast';
  if ($option == 'my')
    echo ', in which you are,';
  echo '</th>',
    '<th>has the right of this type</th>',
    '<th>on these</th>';
  if ($option == 'delete')
    echo '<th>Delete this right?</th>';
  echo '</tr>';
  foreach ($casts_rights as $cast => $rights) {
    foreach ($rights as $right) {
      echo '<tr>',
	'<td>', $right['name'],'</td>',
	'<td>', $lang->msg('right_cast_'.$right['right_type']),'</td>',
	'<td>';
      foreach ($right['details'] as $detail_type => $detail) {
	echo '<strong>', $detail_type,':</strong> ';
	if ($detail_type == 'cast')
	  echo $detail->getName();
	elseif ($detail_type == 'right_type')
	  echo $lang->msg('right_cast_'.$detail);
	echo '<br />';
      }
      if ($option == 'delete') {
	echo '<td>';
	\View\view('mini_form',
		   array(
			 array('type' => 'hidden',
			       'name' => 'id',
			       'value' => $right['id']),
			 array('type' => 'submit',
			       'name' => 'admin_delete_right',
			       'value' => $lang->msg('del')),
			 ));
	echo '</td>';
      }
      echo '</td>',
	'</tr>';
    }
  }
  echo '</table>';
}

function	view_admin_rights_view($info) {
  view_admin_rights_view_table($info['rights_view']['rights']);
}

function	get_right_types_array($info, $with_give_right = true) {
  global	$lang;
  $right_types = $info['rights']->getRightTypes();
  if (!empty($right_types))
    foreach ($right_types as $right_type)
      if (!$with_give_right ||
	  ($with_give_right && $right_type != 'GIVE_RIGHT_TO_CAST'))
	$rights[$right_type] = $lang->msg('right_cast_'.$right_type);
  return $rights;
}

function	view_admin_rights_add($info) {
  global	$lang;
  \View\view('form_result', $info['rights_add_1']);
  \View\view('form', array(
			   array('type' => 'select',
				 'label' => 'Which cast will have this right?',
				 'name' => 'cast',
				 'value' => $info['casts']->getPrintableArray()),
			   array('type' => 'select',
				 'label' => $lang->msg('right_type'),
				 'value' => get_right_types_array($info, false),
				 'name' => 'right_type'),
			   array('type' => 'submit',
				 'value' => $lang->msg('next_form'),
				 'name' => 'admin_right_add'),
			   'action' => \Page\getUrl(array('right' => 'add_1'))));
}

function	view_admin_rights_add_1($info) {
  global	$lang;
  $form = array();
  $detailtypes = $info['rights']->getRightDetailTypes($_POST['right_type']);
  if ($detailtypes)
    foreach ($detailtypes as $detail) {
      if ($detail == 'cast')
	$form[] = array('type' => 'select',
			'label' => 'Which cast is concerned?',
			'name' => $detail,
			'value' => $info['casts']->getPrintableArray());
      elseif ($detail == 'right_type')
	$form[] = array('type' => 'select',
			'label' => 'Which right do you want to give?',
			'name' => $detail,
			'value' => get_right_types_array($info));
    }
  $form[] = array('type' => 'submit',
		  'value' => $lang->msg('add'),
		  'name' => 'admin_right_add_1');
  \View\view('form', $form);
}

function	view_admin_rights_del($info) {
  global $lang;
  \View\view('form_result', $info['rights_del']['form']);
  if (empty($info['rights_del']['deletable_rights'])) {
    view_alert($lang->msg('admin_right_delright_nodeletable'), 'error');
    return ;
  }
  view_admin_rights_view_table($info['rights_del']['deletable_rights'], 'delete');
}

function	view_admin_rights_error($info) {
  \View\view('error', 404);
}

function	view_admin_rights($info) {
  $fun = 'view_admin_rights_'.$_GET['right'];
  if (!function_exists($fun)) {
    $fun = 'view_admin_rights_error';
    view_admin_rights_menu();
  }
  else
    view_admin_rights_menu($_GET['right']);
  $fun($info);
}
