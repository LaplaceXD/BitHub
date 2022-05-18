<?php
  function render_header() {
    ob_start();
    include "src/img/icons/Bithub.svg";
    $logo = ob_get_clean();

    echo '<header>
      <div class="logo__area">
        <a href="index.php" class="logo">'.$logo.'</a>';
    render_theme_toggle();
    echo '</div>
      <button onclick="location.href = \'logout.php\'" class="logout">Logout</button>
    </header>';
  }
?>