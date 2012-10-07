<?php

  // array of infos:
  // [input_name] = array('type' => string,
  //			  'label' => string,
  //			  'value' => mixed,
  //			  'selected' => mixed,
  //			  'name' => string);

function	view_form($infos, $mini = false)
{
  echo '<form method="post" class="', ($mini ? 'mini_form' : 'well'),'" ',
    (isset($infos['action']) ? 'action="'.$infos['action'].'"' : ''),'>';
  foreach ($infos as $key => $info)
    {
      if (!$key || $key != 'action') {
	$function_name = 'view_form_'.$info[type];
	if (!function_exists($function_name))
	  throw new Exception("invalid form type");
	if ($info['type'] != 'hidden')
	  echo '<div class="row-fluid">';
	view_form_label($info[label], $info[name]);
	if ($info['type'] != 'hidden')
	  echo '<div class="span9">';
	$function_name($info[name], $info[value], $info['selected']);
	if ($info['type'] != 'hidden') {
	  echo '</div>';
	  echo '</div>';
	}
      }
    }
  echo '</form>';
}

function	view_mini_form($infos) {
  view_form($infos, true);
}

function	view_form_label($label, $name)
{
  if (!empty($label))
    echo '<div class="span3"><label for="',$name,'">', $label,
      '</label></div>';
}

function	view_form_hidden($name, $value, $selected) {
  echo '<input type="hidden" name="', $name,
    '" value="', $value,'" />';
}

function	view_form_text($name, $value, $selected)
{
  echo '<input type="text" name="', $name,
    '" value="', $value, '" />';
}

function	view_form_textarea($name, $value, $selected)
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

function	view_form_radio_list($name, $value, $selected)
{
  
}

function	view_form_select($name, $value, $selected)
{
  // value : array of string (name) => string (value)
  echo '<select name="', $name,'">';
  foreach ($value as $option_name => $option_value)
    echo '<option value="',$option_name,'"',
    ($option_name == $selected ? ' selected' : ''),
    '>',$option_value,'</option>';
  echo '</select>';
}

function	view_form_submit($name, $value, $selected)
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
