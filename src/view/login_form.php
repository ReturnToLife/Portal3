<?php

function	view_login_form($err)
{
  global	$lang;
  echo '<div id="main_login">
        <div id="login">
	<h1>return (to_life);</h1>
	<h3>/* ',$lang->msg('slogan'),' */</h3>
	<form method="post"> ';
  if ($err == 'err_login')
    {
      echo '  <div class="clearfix error">
            <label for="errorInput">Login Epitech</label>
            <div class="input">
              <input class="span2" id="errorInput" name="return_user_login" size="30" type="text" 
				      value="';
      echo protect($_POST['return_user_login']);
      echo '" />
              <span class="help-inline">Le login n&#039;existe pas !</span>
            </div>
          </div>';
    }
  else
    {
      echo ' <div class="clearfix">
            <label for="xlInput">Login Epitech</label>
            <div class="input"><input class="span2 id="" name="return_user_login" type="text"
		     value="';
            echo protect($_POST['return_user_login']);
      echo '"
		     placeholder="exempl_e" />
            </div>
          </div>';
    }
  if ($err == 'err_pass')
    {
      echo '<div class="clearfix error">
            <label for="errorInput">',$lang->msg('password'),' PPP</label>
            <div class="input">
              <input class="span2" id="errorInput" name="return_user_pass" size="30" type="password" />
              <span class="help-inline">',$lang->msg('wrong_password'),'</span>
            </div>
          </div>';
    }
  else
    {
      echo '<div class="clearfix">
            <label for="xlInput">',$lang->msg('password'),' PPP</label>
            <div class="input">
	      <input class="span2" id="" name="return_user_pass" type="password"
		     placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" />
            </div>
          </div>';
    }
  echo '<div class="small"><a href="https://github.com/db0company/Ionis-Users-Informations/"
          target="_blank">',$lang->msg('opensourceclass'),'</a></div>
	    <div class="actions">
            <input type="submit" name="return_login_form" class="btn primary" value="',
    $lang->msg('enter_site'),
    '">
          </div>
	</form>
       </div>
      <img src="img/interface/logo_home.png" />
      </div>';
  return (false);
}


