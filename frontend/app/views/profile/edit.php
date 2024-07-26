<div id="alertContainer" class="alert-container" style="display: none;"></div>

<?= Flasher::flash(true) ?>

<section class="profile">
  <form action="<?= BASE_URL ?>/profile/update" method="POST">
    <div class="card">
      <h2>Your Profile</h2>
      <table align="center" border="2" cellpadding="2" cellspacing="2" class="account-table">
        <tr>
          <td width="30%">
            Name
          </td>
          <td>
            <input type="text" name="name" value="<?= $data['name']; ?>">
          </td>
        </tr>

        <tr>
          <td width="30%">
            Username
          </td>
          <td>
            <input type="text" name="username" value="<?= $data['username']; ?>" readonly>
          </td>
        </tr>
        <tr>
          <td width="30%">
            Email
          </td>
          <td>
            <input type="text" name="email" value="<?= $data['email']; ?>">
          </td>
        </tr>
        <tr>
          <td width="30%">
            Purchased
          </td>
          <td>
            <input type="text" name="purchased" value="<?= $data['plan'] ?>" readonly>
          </td>
        </tr>
      </table>
    </div>

    <div align="center" class="btn-group" style="width:100%">
      <button type="submit">Save</button>
      <button type="button" onclick="window.location.href='<?= BASE_URL ?>/profile'">Back</button>
    </div>
  </form>
</section>