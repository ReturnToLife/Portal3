<?php

function	view_alert($text, $type = '') {
  // Available types:
  // - error
  // - success
  // - info
  // default = warning (empty)
  echo '<div class="alert', (empty($type) ? '' : ' alert-'.$type),'">', $text, '</div>';
  }
