<?php
  function array_any($array, $fn) {
      foreach ($array as $value) {
          if($fn($value)) {
              return true;
          }
      }
      return false;
  }
?>