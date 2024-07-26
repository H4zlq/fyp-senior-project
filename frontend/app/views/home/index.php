  <div id="alertContainer" class="alert-container"></div>
  <?= Flasher::flash(true) ?>
  <?php if (!Session::exists('loggedin') || !Session::get('loggedin')) : ?>
    <section class="hero">
      <div class="hero-content">
        <h1>A.I Code Converter</h1>
        <p>Convert your code to any language using our A.I Code Converter</p>
        <button style="margin-top: 5px;" onclick="handleGetStarted('<?= BASE_URL ?>/signup')">Get Started</button>
      </div>
    </section>
  <?php else : ?>
    <section class="hero">
      <div class="hero-content">
        <h1>Welcome, <?= Session::get('username') ?></h1>
        <p>Convert your code to any language using our A.I Code Converter</p>
        <button style="margin-top: 5px;" onclick="handleGetStarted('<?= BASE_URL ?>/converter')">Get Started</button>
      </div>
    </section>
  <?php endif; ?>
  <section class="features">
    <div class="feature">
      <i class="fas fa-bolt fa-3x"></i>
      <h3>Objective</h3>
      <p>
        To develop an AI code converter capable of seamlessly translating between Python, Java, C++, JavaScript, and PHP, offering users the option to purchase subscriptions for enhanced features while providing a dedicated forum for community-driven support, fostering knowledge sharing through questions and answers.
      </p>
    </div>
    <div class="feature">
      <i class="fas fa-lock fa-3x"></i>
      <h3>Policy</h3>
      <p>
        Our policy ensures secure account management and subscription-based access to our AI code converter, incorporating robust authentication measures and clear guidelines for subscription management and user data protection.
      </p>
    </div>
    <div class="feature">
      <i class="fas fa-eye fa-3x"></i>
      <h3>Vision</h3>
      <p>
        Our vision is to create an advanced AI code converter that effortlessly translates code across Python, Java, C++, JavaScript, and PHP, empowering users with the flexibility to choose subscription-based access for premium features. Alongside this, we aim to establish a vibrant community forum where users can engage in collaborative problem-solving and knowledge sharing. Additionally, integrating a sophisticated chatbot AI will provide instant assistance, enhancing user experience and fostering continuous learning and improvement within the coding community.
      </p>
    </div>
  </section>