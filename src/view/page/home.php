<?php

function	view_page_home($args)
{
  $args = array('general'	=> array('color' => 'grey',
					 'name'	 => 'G&eacute;n&eacute;ral',
					 'rumor' => array('content' => 'Le lab EIP va &ecirc;tre renomm&eacute; en lab PFE',
							  'mark' => -51),
					 ),
		'pedago'	=> array('color' => 'green',
					 'name'  => 'P&eacute;dago',
					 'rumor' => array('content' => 'Il va y avoir un module Python en tek3',
							  'mark' => 18),
					 ),
		'labo'		=> array('color' => 'blue',
					 'name'  => 'Labo',
					 'rumor' => array('content' => 'Un nouveau labo de web vient d\'&ecirc;tre cr&eacute;&eacute;',
							  'mark' => 55)),
		'asso'		=> array('color' => 'orange',
					 'name'  => 'Asso',
					 'rumor' => array('content' => 'L\'asso de jeu de r&ocirc;le Antre va &ecirc;tre dissoute',
							  'mark' => -89))
		);

  echo '
   <div id="home">
';

  foreach ($args as $categ)
    {
      echo '
    <div class="column">
      <div class="',$categ['color'],'">
	 <h2>',$categ['name'],'</h2>
	 <div class="body">
	   ';
      for ($i = 0; $i < 2; ++$i)
	{
	  echo '
	   <div class="preview_article">
	     <div class="title">Nulla vitae gravida</div>
	     <a href="#"><img src="img/articles/test.jpg" /></a>
	     <div class="content">
	       <div class="text">
		 Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce vitae varius turpis.
	       </div>
	       <a href="#"><div class="button">Lire l\'article</div></a>
	     </div>
	   </div>
';
	}
      echo '
	 </div>
	 <div class="foot">
	   <a href="#">+ Plus d\'articles</a><br />
	   <a href="#">+ Proposer un article</a>
	 </div>
       </div>';
      if ($categ['color'] == 'grey' || $categ['color'] == 'blue')
        echo '<div class="left">';
      else
        echo '<div class="right">';	
      echo '<div class="rumor">
	<div class="',($categ['rumor']['mark'] >= 0 ? 'true' : 'false'),'">
	  <div class="title">Il parrait que...</div>
	  <div class="content">',
	$categ['rumor']['content'],
	  '</div>
	  <div class="vote">
	    <span class="mark">',$categ['rumor']['mark'],'</span>
	    <a href="#"><span class="button_true">Vrai</span></a>
	    <a href="#"><span class="button_false">Faux</span></a>
	  </div>
          <div class="foot">
	    <a href="#">Proposer une rumeur</a> | 
	    <a href="#">Voir tout</a>
	  </div>
	</div>
	</div>
      </div>
    </div>';
    }
  echo '</div>';
}
