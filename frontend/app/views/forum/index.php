    <?php if (!Session::exists('loggedin') || !Session::get('loggedin')) : ?>
      <section class="hero">
        <div class="hero-content">
          <h1>Join Our Community</h1>
          <p>Get your questions answered by our community of developers.</p>
          <p>Sign up now to get started!</p>
          <br>
          <button style="margin-top: 5px;" onclick="handleGetStarted('/forum')">Get Started</button>
        </div>
      </section>
    <?php else : ?>
      <div id="alert" class="alert"></div>
      <section class="forum">
        <?= Flasher::flash(false); ?>
        <h1>Enter Your Question</h1>
        <br>
        <form id="search-form" action="<?= BASE_URL ?>/forum/search" method="POST">
          <input type="text" name="keyword" class="search-input" placeholder="Search your question here (eg. keyword)">
          <button type="submit">SEARCH</button>
          <button type="submit" formaction="<?= BASE_URL ?>/forum">REFRESH</button>
        </form>
        <br>
        <form id="question-form" action="<?= BASE_URL ?>/forum/submit/question" method="POST">
          <input type="text" name="question" class="question-input" placeholder="Type your question here">
          <button type="submit">SUBMIT</button>
        </form>

        <div class="container">
          <h1>Q&A Forum</h1>
          <div class="questions-container">
            <?php foreach ($data['questions'] as $question) : ?>
              <div class="question">
                <div class="user-info">
                  <span class="username">
                    <i class="fas fa-user"></i>
                    <?= $question->getUsername(); ?>
                  </span>
                  <?php if ($question->getUsername() == Session::get('username')) : ?>
                    <a class="delete-link" href="<?= BASE_URL ?>/forum/delete/question/<?= $question->getId(); ?>">Delete</a>
                  <?php endif; ?>
                  <span class=" time submit-time"><?= $question->getSubmitDate(); ?></span>
                </div>
                <p class="question-content"><?= $question->getQuestions(); ?></p>
                <div class="answers">
                  <?php if (isset($data['answers'][$question->getId()])) : ?>
                    <?php foreach ($data['answers'][$question->getId()] as $answer) : ?>
                      <p>
                        <b>
                          <?= $answer->getUsername(); ?>
                        </b>
                        <?= $answer->getAnswer(); ?>
                        <?php if ($answer->getUsername() == Session::get('username')) : ?>
                          <a class="delete-link" href="<?= BASE_URL ?>/forum/delete/answer/<?= $answer->getQuestionId(); ?>/<?= $answer->getId(); ?>">Delete</a>
                        <?php endif; ?>
                        <span class="time submit-time"><?= $answer->getSubmitDate(); ?></span>
                      </p>
                    <?php endforeach; ?>
                  <?php else : ?>
                    <p><em class="time">No replies yet.</em></p>
                  <?php endif; ?>
                  <form action="<?= BASE_URL ?>/forum/submit/answer" method="POST">
                    <input type="hidden" name="question_id" value="<?= $question->getId(); ?>">
                    <input type="text" name="answer" class="answer-input" placeholder="Type your answer here">
                    <br>
                    <p align="right">
                      <button type="submit">SUBMIT ANSWER</button>
                    </p>
                  </form>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
      </section>
    <?php endif; ?>

    <?php if (Session::exists('loggedin') && Session::get('loggedin')) : ?>
      <button class="chatbot-toggler">
        <span class="material-symbols-outlined">mode_comment</span>
        <span class="material-symbols-outlined">close</span>
      </button>
      <div class="chatbot">
        <header>
          <h2>ChatBot</h2>
          <span class="close-btn material-symbols-outlined">close</span>
        </header>
        <ul class="chatbox">
          <li class="chat incoming">
            <span class="material-symbols-outlined">smart_toy</span>
            <p>Hello there! 👋 It's nice to meet you! How can I help you today?</p><br>
          </li>
          <li class="chat outgoing">
          </li>
        </ul>
        <div class="chat-input">
          <textarea placeholder="Enter a message......." required></textarea>
          <span class="material-symbols-outlined">send</span>
        </div>
      </div>
    <?php endif; ?>