<?php

use view\View;
?>

<div class="accordion" id="<?php echo $accordionId; ?>">
  <div class="accordion-item">
    <h2 class="accordion-header" id="<?php echo $accordionId; ?>-one"><button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $accordionId; ?>-collapse-one" aria-expanded="true" aria-controls="<?php echo $accordionId; ?>-collapse-one">Login</button></h2>
    <div id="<?php echo $accordionId; ?>-collapse-one" class="accordion-collapse collapse show" aria-labelledby="<?php echo $accordionId; ?>-one" data-bs-parent="#<?php echo $accordionId; ?>">
      <div class="accordion-body">

        <!--Login form-->
        <form onsubmit="login(this, event)">
          <div class="mb-3">
            <label for="login-email" class="form-label">User name</label>
            <input type="email" id="login-email" name="email" class="form-control" required="required">
          </div>
          <div class="mb-3">
            <label for="login-password" class="form-label">Password</label>
            <input type="password" autocomplete="true" id="login-password" name="password" class="form-control" required="required">
          </div>
          <div class="mb-3 form-check">
            <input type="checkbox" name="remember" class="form-check-input" id="login-remember">
            <label class="form-check-label" for="login-remember">Remember me</label>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>

      </div>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header" id="<?php echo $accordionId; ?>-two"><button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $accordionId; ?>-collapse-two" aria-expanded="false" aria-controls="<?php echo $accordionId; ?>-collapse-two">Register</button></h2>
    <div id="<?php echo $accordionId; ?>-collapse-two" class="accordion-collapse collapse" aria-labelledby="<?php echo $accordionId; ?>-two" data-bs-parent="#<?php echo $accordionId; ?>">
      <div class="accordion-body">
        <?php echo View::render("navbar\\sign\\registerform"); ?>
      </div>
    </div>
  </div>
</div>