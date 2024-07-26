  <div id="myModal" class="modal">
    <div class="modal-content">
      <div class="modal-body">
        <h2>Are you sure you want to submit the request?</h2>
        <form action="<?= BASE_URL ?>/login/user/request" method="POST">
          <input type="hidden" name="user_id" value="<?= $data['id'] ?>">
          <input type="hidden" name="username" value="<?= $data['username'] ?>">
          <button type=" submit">Submit</button>
          <button type="button" onclick="closeModal()">Cancel</button>
        </form>
      </div>
      <!-- <div class="modal-footer">
        <h3>Modal Footer</h3>
      </div> -->
    </div>
  </div>

  <div id="alertContainer" class="alert-container" style="display: none;"></div>

  <?= Flasher::flash(true) ?>

  <section class="login">
    <div class="form-container">
      <form action="<?= BASE_URL ?>/login/user" method="POST">
        <h2>Login</h2>
        <input type="text" name="username" id="username" placeholder="Username" required>
        <input type="password" name="password" id="password" placeholder="Password" required>
        <input type="submit" value="Login">
      </form>
      <a href="<?= BASE_URL ?>/signup">Don't have an account? Signup here</a>
    </div>
  </section>