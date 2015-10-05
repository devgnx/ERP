<?php

function in_object($val, $obj) {
  if ($val == "") {
    trigger_error("in_object expects parameter 1 must not empty", E_USER_WARNING);
    return false;
  }

  if (!is_object($obj)) {
    $obj = (object) $obj;
  }

  foreach ($obj as $key => $value) {
    if (!is_object($value) && !is_array($value)) {
      if ($value == $val) {
        return true;
      }
    } else {
      return in_object($val, $value);
    }
  }

  return false;
}

function is_current_route($route)
{
  if (is_array($route)) {
    foreach ($route as $value) {
      if (strpos($value, Route::current()->getName()) !== false) {
        return true;
      }
    }
  } else{
    return strpos($route, Route::current()->getName()) !== false;
  }

  return false;
}