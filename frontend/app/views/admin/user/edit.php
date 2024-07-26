    <section class="profile">
      <form action="<?= ADMIN_BASE_URL ?>/user/update" method="POST">
        <div class="card">
          <h2>Your Information</h2>
          <table align="center" border="2" cellpadding="2" cellspacing="2" class="account-table">
            <input type="hidden" name="id" value="<?= $data['id']; ?>">
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
                Email
              </td>
              <td>
                <input type="email" name="email" value="<?= $data['email']; ?>">
              </td>
            </tr>

            <tr>
              <td width="30%">
                Role
              </td>
              <td>
                <input type="text" name="role" value="<?= $data['role']; ?>">
              </td>
            </tr>
            <tr>
              <td width="30%">
                Username
              </td>
              <td>
                <input type="text" name="username" value="<?= $data['username']; ?>">
              </td>
            </tr>
            <tr>
              <td width="30%">
                Password
              </td>
              <td>
                <input type="text" name="password" value="<?= $data['password'] ?>">
              </td>
            </tr>
          </table>
        </div>

        <div align="center" class="btn-group" style="width:100%">
          <button type="submit">Save</button>
          <button type="button" onclick="window.location.href='<?= ADMIN_BASE_URL ?>/user'">Back</button>
        </div>

      </form>
    </section>