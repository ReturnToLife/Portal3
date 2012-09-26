<?php

function	view_logout_form($args)
{
  global	$lang;
  echo '<form method="post">';
  echo '<input type="submit" value="',$lang->msg('title_disconnect'),'" name="return_logout_form" />';
  echo '</form>';
}
