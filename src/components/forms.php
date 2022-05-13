<?php 
  function render_registration_form(
    string $user = "",
    string $fname = "",
    string $lname = "",
    string $gender = "",
    string $dob = "",
    string $err = ""
  ): void {
    $err = $err = "" ? "" : '<p class="text-danger">'.$err.'</p>';

    echo '<form class="w-100 container" method="POST" style="max-width: 768px;">
        <div class="mb-3">
          <label for="user" class="form-label">Username</label>
          <input type="text" class="form-control" id="user" name="username" value="'.$user.'" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
          <label for="confirm-password" class="form-label">Confirm Password</label>
          <input type="password" class="form-control" id="confirm-password" name="confirm-password" required>
        </div>
        
        <div class="row mb-3">
          <div class="col-6">
            <label for="fname" class="form-label">First Name</label>
            <input type="text" class="form-control" id="fname" name="firstname" value="'.$fname.'" required>
          </div>
          <div class="col-6">
            <label for="lname" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="lname" name="lastname" value="'.$lname.'" required>
          </div>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="row mb-3">
          <div class="col-6">
            <label for="gender" class="form-label">Gender</label>
            <select id="gender" name="gender" class="form-select" value="'.$gender.'" required>
              <option hidden>Select a Gender</option>
              <option value="M">Male</option>
              <option value="F">Female</option>
              <option value="X">Non-binary</option>
            </select>
          </div>
          <div class="col-6">
            <label for="dob" class="form-label">Date of Birth</label>
            <input type="date" class="form-control" id="dob" name="dob" value="'.$dob.'" required>
          </div>
        </div>

        '.$err.'
        <button type="submit" class="btn btn-primary w-100">Submit</button>
      </form>';
  }

  function render_login_form(string $user = "", string $err = ""): void {
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