<?php

global $def_class_dir;
include_once($def_class_dir.'CastManager.class.php');

function	model_admin_rights_view($args) {
  global $login;
  $my_casts = $args['casts']->getMemberCasts($login->login);
  if (!empty($my_casts))
    foreach ($my_casts as $cast)
      $info['rights'][$cast->getName()] = $args['rights']->getCastRights($cast);
  return $info;
}

function	model_admin_rights_add_1($args) {
  global $lang, $login;
  $arg = array('result' => false,
	       'msg' => '');
  if (isset($_POST['admin_right_add_1'])) {
    $_GET['right'] = 'add';
    $rights_details = $args['rights']->getRightDetailTypes($_SESSION['form']['right_type']);
    if (!empty($rights_details))
      foreach ($rights_details as $right_type) {
    	if (empty($_POST[$right_type])) {
    	  $arg['msg'] = $lang->msg('form_empty');
    	  return $arg;
    	}
    	$details[$right_type] = $_POST[$right_type];
      }
    if (!$args['rights']->addRight($login->login,
				   $_SESSION['form']['right_type'],
				   $_SESSION['form']['cast'],
				   $details)) {
      $arg['msg'] = $lang->msg('admin_right_addright_error');
      return $arg;
    }
    $arg['msg'] = $lang->msg('admin_right_addright_success');
    $arg['result'] = true;
  }
  else {
    $_GET['right'] = 'add';
    if (!isset($_POST['admin_right_add']))
      return ;
    if (empty($_POST['right_type']) || empty($_POST['cast'])) {
      $arg['msg'] = $lang->msg('form_empty');
      return $arg;
    }
    if (!$args['rights']->isRight($_POST['right_type'])
	|| !$args['casts']->isCast($_POST['cast']))
      {
	$arg['msg'] = $lang->msg('admin_right_invalidrightcast');
	return $arg;
      }
    $_SESSION['form']['right_type'] = $_POST['right_type'];
    $_SESSION['form']['cast'] = $_POST['cast'];
    $arg['result'] = true;
    $_GET['right'] = 'add_1';
  }
  return $arg;
}

function	aux_model_admin_rights_del_return($args, $arg) {
  global $login;
  $arg['deletable_rights'] = $args['rights']->getDeletableRights($login->login);
  return $arg;
}

function	model_admin_rights_del($args) {
  global $lang, $login;
  $arg['form'] = array('result' => false,
		       'msg' => '');
  if (!isset($_POST['admin_delete_right']))
    return aux_model_admin_rights_del_return($args, $arg);
  if (empty($_POST['id'])) {
    $arg['form']['msg'] = $lang->msg('form_empty');
    return aux_model_admin_rights_del_return($args, $arg);
  }
  if (!$args['rights']->deleteRight($login->login, intval($_POST['id']))) {
      $arg['form']['msg'] = $lang->msg('admin_right_delright_error');
      return aux_model_admin_rights_del_return($args, $arg);
  }
  $arg['form']['result'] = true;
  $arg['form']['msg'] = $lang->msg('admin_right_delright_success');

  return aux_model_admin_rights_del_return($args, $arg);
}

function	model_admin_rights() {
  global $bdd;
  if (!isset($_GET['right']))
    $_GET['right'] = 'view';
  $args['casts'] = new CastManager($bdd);
  $args['rights'] = new Rights($bdd, $args['casts']);
  $fun = 'model_admin_rights_'.$_GET['right'];
  if (function_exists($fun))
    $args['rights_'.$_GET['right']] = $fun($args);
  return ($args);
}
