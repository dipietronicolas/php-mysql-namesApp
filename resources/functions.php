<?php
function formatName($name, $style)
{
  if (isset($style) && (isset($name))) {
    for ($i = 0; $i < count($style); $i++) {
      switch ($style[$i]) {
        case 'bold':
          $name = "<b>$name</b>";
          break;
        case 'italic':
          $name = "<i>$name</i>";
          break;
        default:
          $name = "<u>$name</u>";
          break;
      }
    }
    return $name;
  } elseif (isset($name)) {
    return $name;
  }
}
?>