<?php

function	view_footer($args)
{
  global	$lang;
  $buttons = array($lang->msg('title_home') => '#',
		   $lang->msg('title_section') => '#',
		   $lang->msg('title_staff') => '#',
		   $lang->msg('title_forum') => '#',
		   'IRC'  => '#',
		   $lang->msg('title_contact') => '#',
		   $lang->msg('title_takepart') => '#',
		   $lang->msg('title_account') => '#',
		   $lang->msg('title_disconnect') => '#',
		   );
  
  $colors = array('grey', 'green', 'blue', 'orange');
 
  echo '<div id="footer">
   <div class="menu">';
  $i = 0;
  foreach ($buttons as $name => $link)
    {
      echo '<a href="',$link,'"><span class="button"><span class="',$colors[($i % count($colors))],
	'">', $name,'</span></span></a>';
      ++$i;
    }
  echo '</div>
</div>';
  
}
