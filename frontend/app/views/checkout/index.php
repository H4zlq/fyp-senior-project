  <div id="alertContainer" class="alert-container"></div>
  <?= Flasher::flash(true) ?>
  <section class="checkout">
    <div class="container">
      <form id="payment-form" method="POST">
        <input type="hidden" name="plan" value="<?= $data['plan'] ?>">
        Username: <input class="input-form" type="text" name="username" value="<?= $data['username'] ?>" readonly><br>
        Email: <input class="input-form" type="email" name="email" value="<?= $data['email'] ?>" readonly><br>
    </div>
    <aside>
      <h3>Order Summary</h3>
      <div class="order-summary">
        <p>Subscription Plan:</p>
        <p><?= $data['plan'] ?></p>
      </div>
      <div id="payment-element">
        <!--Stripe.js injects the Payment Element-->
      </div>
      <!-- <div id="payment-message" class="hidden"></div> -->
      <button id="submit" class="btn-pay">
        <div class="spinner hidden" id="spinner"></div>
        <span id="button-text">Pay now</span>
      </button>
      </form>
      <a href="<?= BASE_URL ?>/subscription" style="margin-left: 5px;">Cancel</a>
    </aside>
  </section>