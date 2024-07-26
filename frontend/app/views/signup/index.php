<div id="alertContainer" class="alert-container" style="display: none;"></div>
<?= Flasher::flash(true) ?>
<section class="signup">
  <div class="form-container">
    <form action="<?= BASE_URL ?>/signup/user" method="post">
      <h2>Sign Up</h2>
      <input type="email" placeholder="Email" name="email" required>
      <input type="text" placeholder="Username" name="username" required>
      <input type="password" placeholder="Password" name="password" required>
      <input type="password" placeholder="Confirm Password" name="confirm_password" required>
      <input type="submit" value="Sign Up">
    </form>
    <a href="<?= BASE_URL ?>/login">Already have an account? Login here</a>
  </div>
</section>