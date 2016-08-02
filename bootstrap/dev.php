<?php

use Illuminate\Support\Debug\Dumper;

/**
 * Custom function to dd() without dying
 */
function dpm($value, $name = '') {
  echo '<div style="padding: 5px; margin: 5px 0; border: solid 2px orange;">';
  if ($name) {
    echo '<pre>' . $name . ":</pre>\n\n";
  }
  (new Dumper)->dump($value);

  $trace = debug_backtrace();
  $file = $trace[0]['file'];
  if (strpos($file, base_path() . '/') === 0) {
    $file = substr($file, strlen(base_path()) + 1);
  }
  $line = $trace[0]['line'];
  echo '<pre>^ Called from ' . $file . ':' . $line . '</pre>';
  echo '</div>';
}

/**
 * Custom function to create a neater, simpler trace from debug_backtrace().
 */
function _debug_backtrace() {
  $trace = debug_backtrace();
  $trace = array_slice($trace, 1);
  $trace = array_map(function($item) {
    $type = @$item['object'] ? '->' : '::';
    $class = @$item['class'] ? $item['class'] . $type : '';
    $line = @$item['line'] ? ' (' . $item['line'] . ')' : '';
    return $class . @$item['function'] . $line;
  }, $trace);
  return array_reverse($trace);
}
