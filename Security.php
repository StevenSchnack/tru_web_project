<?php
  if (!isset($_SERVER['HTTPS'])) {
    $url = 'https://' . $_SERVER['HTTP_HOST'] .
           $_SERVER['REQUEST_URI'];  // starts with /...
    header("Location: " . $url);  // Redirect - 302
    exit;                         // should be before any output
  }                               // 
?>
