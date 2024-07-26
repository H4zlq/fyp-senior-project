  <div id="myModal" class="modal">
    <div class="modal-content">
      <div class="modal-body">
        <h2>Are you sure you want to delete this account?</h2>
        <form action="<?= BASE_URL ?>/profile/delete/request" method="POST">
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

  <section class="profile">
    <div class="card">
      <h2>Your Profile</h2>
      <table align="center" border="2" cellpadding="2" cellspacing="2" class="account-table">
        <tr>
          <td width="30%">
            Name
          </td>
          <td>
            <?= $data['name']; ?>
          </td>
        </tr>
        <tr>
          <td width="30%">
            Username
          </td>
          <td>
            <?= $data['username']; ?>
          </td>
        </tr>
        <tr>
          <td width="30%">
            Email
          </td>
          <td>
            <?= $data['email']; ?>
          </td>
        </tr>
        <tr>
          <td width="30%">
            Account type
          </td>
          <td>
            <?php if (Session::get('role') === 'admin') : ?>
              Admin
            <?php else : ?>
              User
            <?php endif; ?>
          </td>
        </tr>
        <tr>
          <td width="30%">
            Purchased
          </td>
          <td style="text-align: center;">
            <?php if ($data['subscription']) : ?>
              <?= $data['subscription']->getPurchasePlan(); ?>
            <?php else : ?>
              No subscription
            <?php endif; ?>
            <hr>
            <button class="btn-delete mt-5" type="button" onclick="window.location.href='<?= BASE_URL ?>/subscription'">Upgrade subscription</button>
          </td>
        </tr>
        <tr>
          <td width="30%">
            Start date
          </td>
          <td>
            <?php if ($data['subscription']) : ?>
              <?= $data['start_date']; ?>
            <?php else : ?>
              No subscription
            <?php endif; ?>
          </td>
        </tr>
        <tr>
          <td width="30%">
            End date
          </td>
          <td>
            <?php if ($data['subscription']) : ?>
              <?= $data['end_date']; ?>
            <?php else : ?>
              No subscription
            <?php endif; ?>
          </td>
        </tr>
      </table>
    </div>

    <div align="center" class="btn-group" style="width:100%">
      <button type="button" onclick="window.location.href='<?= BASE_URL ?>/profile/edit'">Edit</button>
      <button type="button" onclick="window.location.href='../views/receipt.view.php'">Receipt</button>
      <button type="button" onclick="showModal()">Delete account</button>
    </div>
  </section>