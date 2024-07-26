    <div id="alert" class="alert"></div>
    <main>
      <section>
        <?= Flasher::flash(false) ?>
        <h2>Welcome, <?= $data['username']; ?></h2>
        <h3>Questions</h3>
        <form action="<?= ADMIN_BASE_URL ?>/forum/search/question" method="POST">
          <input type="text" name="keyword" placeholder="Search question here (eg. keyword)">
          <button type="submit">Search</button>
          <button type="submit" formaction="<?= ADMIN_BASE_URL ?>/forum">Refresh</button>
        </form>
        <table align="center" border="2" cellpadding="2" cellspacing="2" class="dashboard-table">
          <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Question</th>
            <th>Submit Date</th>
            <th>Action</th>
          </tr>

          <?php foreach ($data['questions'] as $question) : ?>
            <tr>
              <td><?= $question->getId() ?></td>
              <td><?= $question->getUsername() ?></td>
              <td><?= $question->getQuestions() ?></td>
              <td><?= $question->getSubmitDate() ?></td>
              <td class="dashboard-action">
                <a href="<?= ADMIN_BASE_URL ?>/forum/delete/question/<?= $question->getId() ?>">Delete</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </table>
        <br>
        <hr>
        <br>
        <h3>Answers</h3>
        <form action="<?= ADMIN_BASE_URL ?>/forum/search/answer" method="POST">
          <input type="text" name="keyword" placeholder="Search answer here (eg. keyword)">
          <button type="submit">Search</button>
          <button type="submit" formaction="<?= ADMIN_BASE_URL ?>/forum">Refresh</button>
        </form>
        <table align="center" border="2" cellpadding="2" cellspacing="2" class="dashboard-table">
          <tr>
            <th>ID</th>
            <th>Question ID</th>
            <th>Username</th>
            <th>Answer</th>
            <th>Submit Date</th>
            <th class="dashboard-action">Action</th>
          </tr>

          <?php foreach ($data['answers'] as $question_id => $answers) : ?>
            <?php foreach ($answers as $answer) : ?>
              <tr>
                <td><?= $answer->getId() ?></td>
                <td><?= $answer->getQuestionId() ?></td>
                <td><?= $answer->getUsername() ?></td>
                <td><?= $answer->getAnswer() ?></td>
                <td><?= $answer->getSubmitDate() ?></td>
                <td class="dashboard-action">
                  <a href="<?= ADMIN_BASE_URL ?>/forum/delete/answer/<?= $answer->getId() ?>">Delete</a>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php endforeach; ?>
        </table>
      </section>
    </main>