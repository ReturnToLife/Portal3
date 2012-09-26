<?php

function	view_admin_casts_menu()
{
  global	$lang;
  $buttons = array($lang->msg('view') => \Page\getUrl(array('cast' => 'view')),
		   $lang->msg('add') => \Page\getUrl(array('cast' => 'add')),
		   $lang->msg('del') => \Page\getUrl(array('cast' => 'del')),
		   $lang->msg('add').' '.$lang->msg('member') => \Page\getUrl(array('cast' => 'addmember')),
		   $lang->msg('del').' '.$lang->msg('member') => \Page\getUrl(array('cast' => 'delmember')),
		   );
  echo '<div class="submenu">';
  foreach ($buttons as $name => $url)
    echo '<a href="',$url,'"><span class="btn btn-large button">',$name,'</span></a>';
  echo '</div>';
}

function	view_admin_casts_view($info)
{
  $casts = $info[cast]->getPrintableArray();
  foreach ($casts as $id => $cast)
    {
      $members = $info[cast]->getCastMembers($id);
      echo '<button class="btn cent" onclick="show(\'cast_', $id,
	'\'); return(false);">', $cast,'</button><br />';
      echo '<div class="dview', (empty($members) ? ' alert' : ' well'),
	'" id="cast_', $id,'">';
      print_members($members);
      echo '</div>';
    }
}

function	print_members($members)
{
  global $lang, $iui;
  if (empty($members)) {
    echo $lang->msg('emptycast');
    return ;
  }
  $by_line = count($members) > 12 ? 12 : 6;
  $i = 0;
  echo '<div class="row-fluid">';
  foreach ($members as $login) {
    if ($i && !($i % $by_line))
      echo '</div><div class="row-fluid">';
    echo '<div class="span', (12 / $by_line),'">';
    echo '<img src="', $iui->getPhotoUrl($login, true), '" alt="', $login, '"/><br />';
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
  \View\view('form_result', $info[casts_add]);
  \View\view('form', array(array('type' => 'select',
				 'label' => $lang->msg('admin_cast_addsublabel'),
				 'value' => $info[cast]->getPrintableArray(),
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
  \View\view('form_result', $info[casts_del]);
  \View\view('form', array(array('type' => 'select',
				 'label' => $lang->msg('admin_cast_delsublabel'),
				 'value' => $info[cast]->getPrintableArray(),
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
  \View\view('form_result', $info[casts_addmember]);
  \View\view('form', array(array('type' => 'select',
				 'label' => $lang->msg('add').' '.$lang->msg('member'),
				 'value' => $info[cast]->getPrintableArray(),
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
  \View\view('form_result', $info[casts_delmember]);
  \View\view('form', array(array('type' => 'select',
				 'label' => $lang->msg('del').' '.$lang->msg('member'),
				 'value' => $info[cast]->getPrintableArray(),
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
  view_admin_casts_menu();
  if (!isset($_GET['cast']))
    $_GET['cast'] = 'view';
  $fun = 'view_admin_casts_'.$_GET['cast'];
  if (!function_exists($fun))
    $fun = 'view_admin_casts_error';
  $fun($info);
}
