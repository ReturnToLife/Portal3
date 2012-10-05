<?php

namespace Portal;

function	getColorFromCateg($categ) {
  if ($categ == 'Pedago')
    return 'green';
  elseif ($categ == 'Labo')
    return 'blue';
  elseif ($categ == 'Asso')
    return 'orange';
  return 'grey'; /* color for Général */
}
