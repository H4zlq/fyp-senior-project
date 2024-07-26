<div id="alert" class="alert"></div>
<main>
  <section>
    <?= Flasher::flash(false) ?>
    <h2>Welcome, <?= $data['username']; ?></h2>
    <form action="<?= ADMIN_BASE_URL ?>/user/search" method="POST">
      <input type="text" name="keyword" placeholder="Search user here (eg. keyword)">
      <button type="submit">Search</button>
      <button type="submit" formaction="<?= ADMIN_BASE_URL ?>/user">Refresh</button>
    </form>
    <table class="dashboard-table">
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Username</th>
        <th>Password</th>
        <th class="dashboard-action">Action</th>
      </tr>

      <?php foreach ($data['users'] as $user) : ?>
        <tr class="blocked-<?= $user->isBlocked($user->getRole()) ?>">
          <td><?= $user->getId() ?></td>
          <td><?= $user->getName() ?></td>
          <td><?= $user->getEmail() ?></td>
          <td>
            <span class="badge status-<?= $user->getRoleClass($user->getRole()) ?>">
              <?= $user->getRole(); ?>
            </span>
          </td>
          <td><?= $user->getUsername() ?></td>
          <td><?= $user->getPassword() ?></td>
          <td class="dashboard-action">
            <a href="<?= ADMIN_BASE_URL ?>/user/edit/<?= $user->getId() ?>">Edit</a>
            <a href="<?= ADMIN_BASE_URL ?>/user/delete/<?= $user->getId() ?>">Delete</a>
            <?php if ($user->getRole() === 'deleted') : ?>
              <a href="<?= ADMIN_BASE_URL ?>/user/undelete/<?= $user->getId() ?>">Undelete</a>
            <?php endif; ?>
            <?php if ($user->getRole() !== 'blocked') : ?>
              <a href="<?= ADMIN_BASE_URL ?>/user/block/<?= $user->getId() ?>">Block</a>
            <?php else : ?>
              <a href="<?= ADMIN_BASE_URL ?>/user/unblock/<?= $user->getId() ?>">Unblock</a>
            <?php endif; ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
  </section>
</main>