    <div id="alertContainer" class="alert-container"></div>
    <?= Flasher::flash(true) ?>
    <section class="converter">
      <div class="instructions">
        <div></div>
        <div>
          <h2>How to subscribe</h2>
          <p>User can only make one subscription at a time</p>
          <ul>
            <li>Choose one subscription and click <strong>Subscribe Now</strong></li>
            <li>Enter your information and click <strong>Pay</strong> now</li>
          </ul>
        </div>
        <div></div>
      </div>
    </section>

    <section class="subscription">
      <div class="card card-weekly">
        <h2>Weekly</h2>
        <p>7 days</p>
        <p>RM5</p>
        <p>Add 50 line</p>
        <button type="button" class="btn-subscribe" onclick="handleSubscribe('Weekly', 5000)">Subscribe Now</button>
      </div>
      <div class="card card-monthly">
        <h2>Monthly</h2>
        <p>30 days</p>
        <p>RM20</p>
        <p>Add 150 line</p>
        <button type="button" class="btn-subscribe" onclick="handleSubscribe('Monthly', 2000)">Subscribe Now</button>
      </div>
      <div class="card card-yearly">
        <h2>Yearly</h2>
        <p>360 days</p>
        <p>RM60</p>
        <p>Unlimited line</p>
        <button type="button" class="btn-subscribe" onclick="handleSubscribe('Yearly', 6000)">Subscribe Now</button>
      </div>
    </section>
    <?php if (!Session::exists('loggedin') || !Session::get('loggedin')) : ?>
      <section class="hero">
        <div class="hero-content">
          <h1>Subscribe to A.I Converter</h1>
          <p>Convert your code to any language using our A.I Code Converter</p>
          <button style="margin-top: 5px;" onclick="handleGetStarted('signup.view.php')">Get Started</button>
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