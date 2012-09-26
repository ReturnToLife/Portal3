<?php

function	view_error($error_number)
{
  global	$lang;
  echo '<h1 class="error">',$error_number,' ',$lang->msg($error_number),'</h1>';
}
