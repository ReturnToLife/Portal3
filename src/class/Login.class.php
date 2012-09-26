<?php

class			Login
{
  var $login		= '';
  var $logged		= false;

  public function	__construct()
  {}

  public function	isLog()
  {
    return ($this->logged);
  }

  public function	LogIn($login, $password)
  {
    global		$iui;

    if (empty($login)
	|| !$iui->isLogin($login))
      return ('err_login');
    if (empty($password)
	|| !$iui->checkPass($login, $password))
      return ('err_pass');
    $this->login = $login;
    $this->logged = true;
    return ('');
  }

  public function	LogOut()
  {
    $this->login = '';
    $this->logged = false;
  }

  // --------------- Forms --------------- //

  public function	LogInValidForm()
  {
    if (!isset($_POST['return_login_form']))
      return (false);
    return ($this->LogIn($_POST['return_user_login'],
			 $_POST['return_user_pass']));
  }

  public function	LogOutValidForm()
  {
    if (isset($_POST['return_logout_form']))
      $this->LogOut();
    return ('');
  }
}
