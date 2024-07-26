  <div id="alert" class="alert status-info"></div>
  <?= Flasher::flash(false)  ?>
  <section class="converter">
    <div class="instructions">
      <div></div>
      <div>
        <h2>Instructions</h2>
        <p>How to use the converter:</p>
        <ul>
          <li>Enter your source code in the textarea</li>
          <li>Select the language you want to convert to</li>
          <li>Click the convert button</li>
        </ul>
      </div>
      <div class="border border-<?= $data['border'] ?>">
        <?php if (Session::exists('loggedin') && Session::get('loggedin')) : ?>
          <strong>Welcome</strong>
          <i><?= $data['username']; ?></i>
          <br>
          <strong>Subscription</strong>
          <?php if ($data['subscription']) : ?>
            <?php if ($data['subscription']->getPurchasePlan() === 'Yearly') : ?>
              <i style="color: red;"><?= $data['subscription']->getPurchasePlan(); ?></i>
            <?php elseif ($data['subscription']->getPurchasePlan() === 'Monthly') : ?>
              <i style="color: green;"><?= $data['subscription']->getPurchasePlan(); ?></i>
            <?php elseif ($data['subscription']->getPurchasePlan() === 'Weekly') : ?>
              <i style="color: blue;"><?= $data['subscription']->getPurchasePlan() ?></i>
            <?php else : ?>
              <i><?= $data->getPurchasePlan() ?></i>
            <?php endif; ?>
          <?php else : ?>
            <i>No subscription</i>
          <?php endif; ?>
        <?php else : ?>
          <i>Guest user</i>
          <br>
          <p>Limit of 50 lines per conversion for guest user<br><a href="/signup">Signup</a> and <a href="/subscription">Subscribe</a> to get unlimited lines.
          </p>
        <?php endif; ?>
      </div>
    </div>
  </section>
  <section class="converter flex-center">
    <div class="card">
      <h2>Source code</h2>
      <textarea name="python" id="python" cols="30" rows="30"></textarea>
      <p>Please select which language you want to convert: </p>
      <select name="language" id="language">
        <option value="#">Select language</option>
        <option value="java">Java</option>
        <option value="cpp">C++</option>
        <option value="python">Python</option>
        <option value="javascript">JavaScript</option>
        <option value="php">PHP</option>
      </select>
      <button id="btn-convert" onclick="handleApi()" data-id="<?= $data['id'] ?>">
        <span class="btn-text">Convert</span>
      </button>
    </div>

    <div class="card">
      <h2>Convert</h2>
      <pre class="pre-language"><code class="language"></code></pre>
    </div>

    <div class="card">
      <h2>Output:</h2>
      <pre class="pre-output"><code class="output"></code></pre>
    </div>
    </div>
  </section>

  <?php if (Session::exists('loggedin') && Session::get('loggedin')) : ?>
    <button class="chatbot-toggler">
      <span class="material-symbols-outlined">chat</span>
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