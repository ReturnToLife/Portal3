<?php

class		Lang
{
  var		$l;

  var $langs = array('fr', 'en');
  var $default = 'en';

  public function	__construct($lang = 'en')
  {
    if (!$this->change($lang))
      $this->change($this->default);
  }

  public function	change($lang)
  {
    if (!in_array($lang, $this->langs))
      return (false);
    $this->l = $lang;
    return (true);
  }

  public function	msg($id)
  {
    $filename = 'src/lang/'.$this->l.'/'.$id;
    if (!file_exists($filename))
      throw new Exception('Message not found');
    include($filename);
    return ($msg);
  }
}

