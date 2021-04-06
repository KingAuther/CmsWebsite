<?php
// (A) GET PAGE CONTENTS FROM DATABASE
require "index.php";
$id = 1; // FOR THE SAKE OF SIMPLICITY, THIS IS LIMITED TO A SINGLE PAGE
$content = $_CORE->get($id);

// (B) OUTPUT HTML ?>
<!DOCTYPE html>
<html>
  <head>
    <title><?=$content['content_title']?></title>
  </head>
  <body><?=$content['content_text']?></body>
</html>