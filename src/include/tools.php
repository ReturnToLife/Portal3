<?php

function protect($string)
{
  return (htmlspecialchars(stripslashes($string)));
}
