<!--Register form-->
<form autocomplete="new-password" onkeyup="registerValueChecker(this)" onsubmit="register(this, event)">
    <div class="mb-3">
        <label for="register-email" class="form-label">User name<label id="register-email-label"></label></label>
        <input type="email" id="register-email" name="register-email" class="form-control" required="required">
    </div>
    <div class="mb-3">
        <label for="register-password" class="form-label">Password<label id="register-password-label"></label></label>
        <input type="password" id="register-password" name="register-password" class="form-control" required="required">
    </div>
    <div class="mb-3">
        <label for="register-confirm-password" class="form-label">Confirm Password <label id="register-confirm-password-label"></label></label>
        <input type="password" id="register-confirm-password" class="form-control" required="required">
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input">
        <label class="link-primary" onclick="callRenderedInMain('home/terms')">I Accept the Terms &amp; Conditions</label>
    </div>
    <button id="register-confirm-submit" type="submit" class="btn btn-primary">Submit</button>
</form>