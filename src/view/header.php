<?php

function	view_header($args)
{
  global	$lang;
  $args = array('next_event' => array('id' => 0,
				      'date' => '10-02-2012',
				      'name' => 'Nocturne Epitanime'));

  echo '
     <div id="header">
       <a href=".">
	 <div class="logo"></div>
       </a>
       <div class="name">
	 <a href=".">
	   <h1>return (to_life);</h1>
	   <h3>/* ',$lang->msg('slogan'),' */</h3>
	 </a>
	 <div class="menu">
	   <a href="#"><img src="img/interface/calendar.png" /> 
	   ',$lang->msg('next_event'),' : 
	   [',$args['next_event']['date'],'] 
	   ',$args['next_event']['name'],'
	   </a>
	   <form class="search" method="post">
	     <input type="text" />
	     <input type="submit" class="btn info submit" value="',$lang->msg('search'),'" />
	   </form>
	 </div>
       </div>
     </div>
   </a>';
}
