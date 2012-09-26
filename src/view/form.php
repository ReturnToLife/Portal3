<?php

  // array of infos:
  // [input_name] = array('type' => string,
  //			  'label' => string,
  //			  'value' => mixed,
  //			  'name' => string);

function	view_form($infos)
{
  echo '<form method="post" class="well">';
  foreach ($infos as $info)
    {
      $function_name = 'view_form_'.$info[type];
      if (!function_exists($function_name))
	throw new Exception("invalid form type");
      echo '<div class="row-fluid">';
      view_form_label($info[label], $info[name]);
      echo '<div class="span9">';
      $function_name($info[name], $info[value]);
      echo '</div>';
      echo '</div>';
    }
  echo '</form>';
}

function	view_form_label($label, $name)
{
  echo '<div class="span3"><label for="',$name,'">', $label,
    '</label></div>';
}

function	view_form_text($name, $value)
{
  echo '<input type="text" name="', $name,
    '" value="', $value, '" />';
}

function	view_form_textarea($name, $value)
{
  echo '<textarea name="', $name,
    '">', $value, '</textarea>';  
}

function	view_form_single_check($name, $values)
{
  // value : boolean
  echo '<input type="checkbox" name="', $name,
    '" ', ($value ? 'checked' : ''),'/>';
}


function	view_form_check_list($name, $values)
{
  // // value : array of string (name) => bool (default checked or not)
  // foreach ($values as $value)
  //   echo '<input type="checkbox" name="', $name,
  //   '[]" ', ($value ? 'checked' : ''),'/>';
}

function	view_form_radio_list($name, $value)
{
  
}

function	view_form_select($name, $value)
{
  // value : array of string (name) => string (value)
  echo '<select name="', $name,'">';
  foreach ($value as $option_name => $option_value)
    echo '<option value="',$option_name,'">',$option_value,'</option>';
  echo '</select>';
}

function	view_form_submit($name, $value)
{
  echo '<input class="btn" type="submit" name="',$name,'" value="',$value,'">';
}

function	view_form_result($result)
{
  if (!empty($result[msg]))
    echo '<div class="alert alert-',
      ($result[result] ? 'success' : 'error'),
      '">',$result[msg],'</div>';
}
