<?php 
  function render_head($css = null, $title = "BitHub - Share Your Ideas") {
    $specific_css = "";
    if($css) {
      foreach($css as $href) {
        $specific_css .= '<link href="src/css/'.$href.'.css" rel="stylesheet" type="text/css" />' . "\n";
      }
    }

    echo '<head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />

      <title>'.$title.'</title>

      <!--CSS-->
      <link href="src/css/resets.css" rel="stylesheet" type="text/css" />
      <link href="src/css/base.css" rel="stylesheet" type="text/css" />
      
      <!--SPECIFIC CSS-->
      '.$specific_css.'
    </head>';
  }
?>