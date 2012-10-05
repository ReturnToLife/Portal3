<?php

include_once($def_nmsp_dir.'View.nmsp.php');
include_once($def_class_dir.'Page.class.php');
include_once($def_include_dir.'tools.php');
include_once($def_class_dir.'Login.class.php');

class		 	Portal
{
  var $login;

  public function	__construct()
  {
    \View\view('header_http');

    if (!isset($_SESSION['login']))
      $this->login = new Login;
    else
      $this->login = unserialize($_SESSION['login']);
    global $login;
    $login = $this->login;
  }

  public function	__destruct()
  {
    $_SESSION['login'] = serialize($this->login);
       \View\view('footer_http');
  }

  public function	run()
  {
    $err = ($this->login->isLog() ?
	    $this->login->logOutValidForm()
	    : $this->login->logInValidForm());
    if (!$this->login->isLog())
      return (\View\view('login_form', $err));
    // else
    //   \View\view('logout_form');
    $page = \View\getPage();
    $infos = \View\modelPage($page);
    if (isset($infos['rollback_page']))
      $page = $infos['rollback_page'];
    \View\viewPage($page, $infos);
    return (true);
  }


}

