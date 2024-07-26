// This is your test publishable API key.
const stripe = Stripe("pk_live_51PecT6RtDy4x4BoDW9c3N3ucFuJsFHaZ43DSbsiKbImfFV56byrUQ6tqITlcQ7ngWz3bPi58eeZwozvfY2jp3CXX00b3tRYwgP");

// The items the customer wants to buy
const product = {
  name: localStorage.getItem('product_name'),
  price: localStorage.getItem('product_price'),
};

let elements;

initialize();
checkStatus();

document
  .querySelector("#payment-form")
  .addEventListener("submit", handleSubmit);

// Fetches a payment intent and captures the client secret
async function initialize() {
  const response = await fetch("http://localhost:5000/api/payment/intent", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ product }),
  });
  const { clientSecret } = await response.json();

  const appearance = {
    theme: 'stripe',
  };
  elements = stripe.elements({ appearance, clientSecret });

  const paymentElementOptions = {
    layout: "tabs",
  };

  const paymentElement = elements.create("payment", paymentElementOptions);
  paymentElement.mount("#payment-element");
}

async function handleSubmit(e) {
  e.preventDefault();
  setLoading(true);

  const { error } = await stripe.confirmPayment({
    elements,
    confirmParams: {
      // Make sure to change this to your payment completion page
      return_url: "http://localhost/FYP%20Project/frontend/views/checkout.view.php",
    },
  });

  // This point will only be reached if there is an immediate error when
  // confirming the payment. Otherwise, your customer will be redirected to
  // your `return_url`. For some payment methods like iDEAL, your customer will
  // be redirected to an intermediate site first to authorize the payment, then
  // redirected to the `return_url`.
  if (error.type === "card_error" || error.type === "validation_error") {
    showMessage(error.message);
  } else {
    showMessage("An unexpected error occurred.");
  }

  setLoading(false);
}

// Fetches the payment intent status after payment submission
async function checkStatus() {
  const clientSecret = new URLSearchParams(window.location.search).get(
    "payment_intent_client_secret"
  );

  if (!clientSecret) {
    return;
  }

  const { paymentIntent } = await stripe.retrievePaymentIntent(clientSecret);

  switch (paymentIntent.status) {
    case "succeeded":
      saveData();
      showAlert("Your payment was successful.", "success");
      break;
    case "processing":
      showAlert("Your payment is processing.", "info");
      break;
    case "requires_payment_method":
    case "requires_confirmation":
      showAlert("Your payment has failed.", "danger");
      break;
    default:
      showAlert("Something went wrong.", "danger");
      break;
  }
}

function saveData() {
  const phone = $('#phone').val();

  $.ajax({
    url: 'http://localhost/FYP%20Project/frontend/includes/checkout.inc.php',
    type: 'POST',
    data: {
      plan: product.name,
      price: product.price,
      phone: phone
    },
    success: function (data) {
      console.log(data);
    }
  });
}

// ------- UI helpers -------

function showAlert(message, type) {
  $("#alert").text(message);
  $("#alert").show("slow");
  $(".alert").toggleClass(`status-${type}`);

  setTimeout(function () {
    $("#alert").hide("slow");
  }, 5000);
}

// Show a spinner on payment submission
function setLoading(isLoading) {
  if (isLoading) {
    // Disable the button and show a spinner
    document.querySelector("#submit").disabled = true;
    document.querySelector("#spinner").classList.remove("hidden");
    document.querySelector("#button-text").classList.add("hidden");
  } else {
    document.querySelector("#submit").disabled = false;
    document.querySelector("#spinner").classList.add("hidden");
    document.querySelector("#button-text").classList.remove("hidden");
  }
}