<!DOCTYPE html>
<html>
  <head>
    <title>UPDATE PAGE DEMO</title>
    
    <!-- (A) JUST SOME COSMETICS -->
    <style>
    #pageForm {
      background: #f2f2f2;
      max-width: 500px;
      padding: 10px;
    }
    #pageForm input, #pageForm textarea { 
      box-sizing: border-box;
      width: 100%; 
      margin-top: 10px;
      padding: 10px;
    }
    </style>
  </head>
  <body>
    <!-- (B) PHP PROCESS  -->
    <?php
    // (B1)  CORE LIBRARY
    require "index.php";
    $id = 1; // FOR THE SAKE OF SIMPLICITY, THIS IS LIMITED TO A SINGLE PAGE
    
    // (B2) SAVE CONTENT WHEN FORM IS SUBMITTED
    if (isset($_POST['title'])) {
      echo $_CORE->save($_POST['title'], $_POST['text'], $id)
      ? "<div>CONTENT UPDATED</div>"
      : "<div>".$_CORE->error."</div>" ;
    }

    // (B3) LOAD PAGE
    $content = $_CORE->get($id);
    ?>
    
    <!-- (C) HTML FORM -->
    <form method="post" id="pageForm">
      <div>Title:</div>
      <input type="text" name="title" required value="<?=$content['content_title']?>"/>
      <div>Text:</div>
      <textarea name="text" required><?=$content['content_text']?></textarea>
      <input type="submit" value="Save"/>
    </form>
  </body>
</html>