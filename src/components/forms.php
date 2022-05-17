<?php
  function render_submit_btn($label) {
    echo '<button type="submit" class="form__btn">'.$label.'</button>';
  }

  function render_field($name, $label, $value = "") {
    if($value != "") $value = 'value="'.$value.'"';

    echo '<div class="form__field">
        <input class="form__input" type="text" id="'.$name.'" name="'.$name.'" '.$value.'required>
        <label class="form__label" for="'.$name.'">'.$label.'</label>
      </div>';
  }

  function render_registration_form(
    $user = "",
    $email = "",
    $err = ""
  ) {
    
    $fields = array(
      "user" => array("Username", $user),
      "email" => array("Email", $email),
      "pass" => array("Password", ""),
      "confpass" => array("Confirm Password", "")
    );

    echo "<form class='reg__form' action='POST'>";
    foreach($fields as $name => $content) {
      echo "\n";
      render_field($name, $content[0], $content[1]);
    }
    echo $err = $err = "" ? "" : "\n".'<p class="form__error">'.$err.'</p>';
    echo "\n".render_submit_btn("Register");
    echo "\n</form>";
  }

  function render_login_form($user = "", $err = "") {
    $err = $err = "" ? "" : '<p class="text-danger">'.$err.'</p>';
    
    echo '<form method="POST">
      <div class="mb-3">
        <label for="user" class="form-label">Username</label>
        <input type="text" class="form-control" id="user" name="username" value="'.$user.'" required>
      </div>
      <div class="mb-3">
        <label for="pass" class="form-label">Password</label>
        <input type="password" class="form-control" id="pass" name="password" required>
      </div>
      '.$err.'
      <button type="submit" class="btn btn-primary w-100">Submit</button>
    </form>';
  }
?>