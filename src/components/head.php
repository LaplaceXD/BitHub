<?php 
  function render_head($title = "BitHub - Share Your Ideas") {
    echo '<head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />

      <title>'.$title.'</title>

      <!--CSS-->
      <link href="src/css/resets.css" rel="stylesheet" type="text/css" />
      <link href="src/css/base.css" rel="stylesheet" type="text/css" />
    </head>';
  }
?>