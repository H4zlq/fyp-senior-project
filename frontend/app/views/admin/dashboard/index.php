<main>
  <div id="alertContainer" class="alert-container"></div>
  <?= Flasher::flash(true) ?>
  <section class="dashboard">
    <h2>Welcome, <?= $data['username']; ?></h2>

    <section class="features">
      <div class="container">
        <div class="row">
          <div class="feature col-md-4 w-235 flex-basis-40">
            <i class="fas fa-user"></i>
            <span><?= $data['userCount']; ?></span>
            <p>
              <a href="<?= ADMIN_BASE_URL ?>/user">Users</a>
            </p>
          </div>
          <div class="feature col-md-4 w-235 flex-basis-40">
            <i class="fas fa-shopping-cart"></i>
            <span><?= $data['subscriptionCount']; ?></span>
            <p>
              <a href="<?= BASE_URL ?>">Purchases</a>
            </p>
          </div>
          <div class="feature col-md-4 w-235 flex-basis-40">
            <i class="fas fa-question"></i>
            <span><?= $data['questionCount']; ?></span>
            <p>
              <a href="<?= BASE_URL ?>/forum">Asked questions</a>
            </p>
          </div>
          <div class="feature col-md-4 w-235 flex-basis-40">
            <i class="fas fa-comments"></i>
            <span><?= $data['answerCount']; ?></span>
            <p>
              <a href="<?= BASE_URL ?>/forum">Answered questions</a>
            </p>
          </div>
        </div>
      </div>
    </section>
  </section>
</main>